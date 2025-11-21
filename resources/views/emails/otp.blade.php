<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kode Verifikasi OTP</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2c3e50;">Kode Verifikasi OTP</h2>
        
        <p>Halo {{ $name }},</p>
        
        <p>Gunakan kode OTP berikut untuk menyelesaikan registrasi Anda:</p>
        
        <div style="background: #f8f9fa; padding: 20px; text-align: center; margin: 20px 0; border-radius: 5px;">
            <h1 style="color: #007bff; font-size: 32px; margin: 0; letter-spacing: 5px;">{{ $otp }}</h1>
        </div>
        
        <p><strong>Kode ini akan kedaluwarsa dalam 5 menit.</strong></p>
        
        <p>Jika Anda tidak melakukan registrasi, abaikan email ini.</p>
        
        <hr style="margin: 30px 0;">
        <p style="font-size: 12px; color: #666;">
            Email ini dikirim otomatis, mohon tidak membalas email ini.
        </p>
    </div>
</body>
</html>