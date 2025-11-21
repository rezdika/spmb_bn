<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verifikasi OTP - PPDB SMK Bakti Nusantara 666</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet">
</head>
<body>
    <div class="register-container">
        <!-- Left Panel - Branding -->
        <div class="left-panel">
            <div style="position: absolute; top: 30px; left: 30px; display: flex; align-items: center; gap: 12px;">
                <img src="{{ asset('assets/image/logo_sekolah.png') }}" alt="SMK BN 666" style="width: 50px; height: 50px;">
                <div style="color: white;">
                    <h6 style="margin: 0; font-weight: 700; font-size: 14px; line-height: 1.2;">SMK BAKTI NUSANTARA 666</h6>
                </div>
            </div>
            
            <a href="{{ route('register') }}" style="position: absolute; top: 30px; right: 30px; color: white; text-decoration: none; font-size: 14px; opacity: 0.8; transition: opacity 0.3s;">
                <i class="fas fa-arrow-left me-2"></i>Back to Register
            </a>
            
            <div class="branding-content">
                <h1 class="fw-bold mb-3" style="font-size: 2.5rem; line-height: 1.2;">Bergabung Bersama Kami. Raih Masa Depan Cerah.</h1>
                <p class="mb-4" style="font-size: 1rem; opacity: 0.9; max-width: 400px;">SMK Bakti Nusantara 666 menghadirkan pendidikan berkualitas dengan fasilitas modern untuk mempersiapkan generasi unggul.</p>
            </div>
        </div>
        
        <!-- Right Panel - OTP Form -->
        <div class="right-panel">
            <div class="register-form">
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <i class="fas fa-envelope-open-text" style="font-size: 3rem; color: #1B1A55;"></i>
                    </div>
                    <h2 class="fw-bold" style="color: #1B1A55;">Verifikasi OTP</h2>
                    <p class="text-muted">Masukkan kode 6 digit yang dikirim ke:</p>
                    <p class="fw-bold" style="color: #1B1A55;">{{ $email }}</p>
                </div>
                
                @if(session('error'))
                    <div class="alert alert-danger mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success mb-4">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('verify.otp') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    
                    <div class="mb-4">
                        <label for="otp" class="form-label text-center d-block">Kode OTP</label>
                        <div class="otp-input-container">
                            <input type="text" class="form-control text-center @error('otp') is-invalid @enderror" 
                                   id="otp" name="otp" maxlength="6" 
                                   placeholder="000000" 
                                   style="font-size: 1.5rem; letter-spacing: 0.5rem; font-weight: bold;"
                                   required>
                        </div>
                        @error('otp')
                            <small class="text-danger d-block text-center mt-2">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-register mb-3">
                        <i class="fas fa-check me-2"></i>VERIFIKASI OTP
                    </button>
                </form>

                <div class="text-center">
                    <p class="mb-3">Tidak menerima kode?</p>
                    <form method="POST" action="{{ route('resend.otp') }}" class="d-inline">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fas fa-redo me-2"></i>Kirim Ulang OTP
                        </button>
                    </form>
                </div>
                
                <hr class="my-4">

                <div class="text-center">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Butuh bantuan? 
                        <a href="https://wa.me/6282126099407" target="_blank" style="color: #1B1A55;">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto format OTP input
        document.getElementById('otp').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Only numbers
            e.target.value = value;
        });

        // Auto submit when 6 digits entered
        document.getElementById('otp').addEventListener('input', function(e) {
            if (e.target.value.length === 6) {
                // Optional: auto submit form
                // e.target.form.submit();
            }
        });

        // Countdown timer for resend button (optional)
        let resendButton = document.querySelector('button[type="submit"]:last-of-type');
        let countdown = 60;
        
        function startCountdown() {
            resendButton.disabled = true;
            let interval = setInterval(function() {
                resendButton.innerHTML = `<i class="fas fa-clock me-2"></i>Kirim Ulang (${countdown}s)`;
                countdown--;
                
                if (countdown < 0) {
                    clearInterval(interval);
                    resendButton.disabled = false;
                    resendButton.innerHTML = '<i class="fas fa-redo me-2"></i>Kirim Ulang OTP';
                    countdown = 60;
                }
            }, 1000);
        }

        // Start countdown on page load
        // startCountdown();
    </script>
</body>
</html>