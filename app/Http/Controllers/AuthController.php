<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\LogAktivitas;
use App\Mail\OtpMail;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        try {
            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();
                
                LogAktivitas::log('LOGIN', 'User', ['email' => $request->email]);
                
                return $this->redirectUserByRole();
            }

            LogAktivitas::log('LOGIN_FAILED', 'User', ['email' => $request->email]);
            
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
            
        } catch (\Exception $e) {
            \Log::error('Login error: ' . $e->getMessage());
            return back()->withErrors([
                'email' => 'Terjadi kesalahan sistem. Silakan coba lagi.',
            ])->onlyInput('email');
        }
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no_hp' => 'required|string|max:15|regex:/^[0-9+\-\s]+$/',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ], [
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, dan angka.',
            'no_hp.regex' => 'Format nomor HP tidak valid.'
        ]);

        try {
            // Generate OTP 6 digit
            $otp = rand(100000, 999999);
            
            // Simpan data registrasi dan OTP di cache (5 menit)
            Cache::put('register_data_' . $request->email, [
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'password' => $request->password,
            ], now()->addMinutes(5));
            
            Cache::put('otp_' . $request->email, $otp, now()->addMinutes(5));
            
            // Kirim email OTP
            Mail::to($request->email)->send(new OtpMail($otp, $request->nama_lengkap));
            
            return redirect()->route('verify.otp.form', ['email' => $request->email])
                ->with('success', 'Kode OTP telah dikirim ke email Anda.');
            
        } catch (\Exception $e) {
            \Log::error('Send OTP error: ' . $e->getMessage());
            return back()->withErrors([
                'email' => 'Gagal mengirim OTP. Silakan coba lagi.',
            ])->withInput();
        }
    }

    public function showVerifyOtp(Request $request)
    {
        $email = $request->get('email');
        
        if (!Cache::has('otp_' . $email)) {
            return redirect()->route('register')->withErrors([
                'email' => 'Kode OTP sudah kedaluwarsa. Silakan registrasi ulang.'
            ]);
        }
        
        return view('auth.verify-otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        try {
            $storedOtp = Cache::get('otp_' . $request->email);
            $registerData = Cache::get('register_data_' . $request->email);
            
            if (!$storedOtp || !$registerData) {
                return back()->withErrors([
                    'otp' => 'Kode OTP sudah kedaluwarsa. Silakan registrasi ulang.'
                ]);
            }
            
            if ($storedOtp != $request->otp) {
                return back()->withErrors([
                    'otp' => 'Kode OTP tidak valid.'
                ]);
            }
            
            // Buat user setelah OTP valid
            $user = User::create([
                'nama_lengkap' => $registerData['nama_lengkap'],
                'email' => $registerData['email'],
                'no_hp' => $registerData['no_hp'],
                'password' => Hash::make($registerData['password']),
                'role' => 'calon_siswa',
                'email_verified_at' => now(),
            ]);
            
            // Hapus cache
            Cache::forget('otp_' . $request->email);
            Cache::forget('register_data_' . $request->email);
            
            LogAktivitas::log('REGISTER', 'User', [
                'nama_lengkap' => $registerData['nama_lengkap'],
                'email' => $registerData['email']
            ], $user->id);

            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
            
        } catch (\Exception $e) {
            \Log::error('Verify OTP error: ' . $e->getMessage());
            return back()->withErrors([
                'otp' => 'Terjadi kesalahan sistem. Silakan coba lagi.',
            ]);
        }
    }

    public function resendOtp(Request $request)
    {
        $email = $request->get('email');
        $registerData = Cache::get('register_data_' . $email);
        
        if (!$registerData) {
            return redirect()->route('register')->withErrors([
                'email' => 'Data registrasi sudah kedaluwarsa. Silakan registrasi ulang.'
            ]);
        }
        
        try {
            $otp = rand(100000, 999999);
            Cache::put('otp_' . $email, $otp, now()->addMinutes(5));
            
            Mail::to($email)->send(new OtpMail($otp, $registerData['nama_lengkap']));
            
            return back()->with('success', 'Kode OTP baru telah dikirim.');
            
        } catch (\Exception $e) {
            \Log::error('Resend OTP error: ' . $e->getMessage());
            return back()->withErrors([
                'email' => 'Gagal mengirim ulang OTP. Silakan coba lagi.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        LogAktivitas::log('LOGOUT', 'User');
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function dashboard()
    {
        return view('user.pages.dashboard');
    }
    
    private function redirectUserByRole()
    {
        $user = auth()->user();
        
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
            case 'panitia':
                return redirect()->route('panitia.dashboard')->with('success', 'Login berhasil!');
            case 'keuangan':
                return redirect()->route('keuangan.dashboard')->with('success', 'Login berhasil!');
            case 'kepala_sekolah':
                return redirect()->route('kepala-sekolah.dashboard')->with('success', 'Login berhasil!');
            default:
                return redirect()->route('home')->with('success', 'Login berhasil!');
        }
    }
}