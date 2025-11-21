<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - PPDB SMK Bakti Nusantara 666</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <!-- Left Panel - Branding -->
        <div class="left-panel">
            <div style="position: absolute; top: 30px; left: 30px; display: flex; align-items: center; gap: 12px;">
                <img src="{{ asset('assets/image/logo_sekolah.png') }}" alt="SMK BN 666" style="width: 50px; height: 50px;">
                <div style="color: white;">
                    <h6 style="margin: 0; font-weight: 700; font-size: 14px; line-height: 1.2;">SMK BAKTI NUSANTARA 666</h6>
                </div>
            </div>
            <a href="{{ route('home') }}" style="position: absolute; top: 30px; right: 30px; color: white; text-decoration: none; font-size: 14px; opacity: 0.8; transition: opacity 0.3s;">
                <i class="fas fa-arrow-left me-2"></i>Back to Website
            </a>
            
            <div class="branding-content">
                <h1 class="fw-bold mb-3" style="font-size: 2.5rem; line-height: 1.2;">Bergabung Bersama Kami. Raih Masa Depan Cerah.</h1>
                <p class="mb-4" style="font-size: 1rem; opacity: 0.9; max-width: 400px;">SMK Bakti Nusantara 666 menghadirkan pendidikan berkualitas dengan fasilitas modern untuk mempersiapkan generasi unggul.</p>
            </div>
        </div>
        
        <!-- Right Panel - Login Form -->
        <div class="right-panel">
            <div class="login-form">
                <div class="text-center mb-4">
                    <h2 class="fw-bold" style="color: #1B1A55;">Masuk ke Akun Anda</h2>
                    <p class="text-muted">Silakan masuk untuk melanjutkan pendaftaran</p>
                </div>
                
                <!-- Auth Tabs -->
                <div class="auth-tabs">
                    <a href="{{ route('login') }}" class="auth-tab active">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                    </a>
                    <a href="{{ route('register') }}" class="auth-tab">
                        <i class="fas fa-user-plus me-2"></i>Daftar
                    </a>
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

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email / Username</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #f8f9fa; border: 2px solid #dee2e6; border-right: none;">
                                <i class="fas fa-user" style="color: #1B1A55;"></i>
                            </span>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="Masukkan email atau username" required>
                        </div>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #f8f9fa; border: 2px solid #dee2e6; border-right: none;">
                                <i class="fas fa-lock" style="color: #1B1A55;"></i>
                            </span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="Masukkan password" required>
                            <button type="button" class="input-group-text" style="background-color: #f8f9fa; border: 2px solid #dee2e6; border-left: none; cursor: pointer;" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggleIcon" style="color: #1B1A55;"></i>
                            </button>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login mb-4">
                        <i class="fas fa-sign-in-alt me-2"></i>MASUK
                    </button>
                </form>

                <div class="text-center">
                    <p class="mb-3">Belum punya akun? <a href="{{ route('register') }}" style="color: #1B1A55; text-decoration: none;">Daftar di sini</a></p>
                </div>

                <hr class="my-4">

                <div class="text-center">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Butuh bantuan? 
                        <a href="https://wa.me/6281234567890" target="_blank" style="color: #1B1A55;">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/auth.js') }}"></script>
    <script>
        // Auto refresh CSRF token every 10 minutes
        setInterval(function() {
            fetch('/csrf-token')
                .then(response => response.json())
                .then(data => {
                    document.querySelector('input[name="_token"]').value = data.csrf_token;
                    document.querySelector('meta[name="csrf-token"]').content = data.csrf_token;
                });
        }, 600000); // 10 minutes
    </script>
</body>
</html>