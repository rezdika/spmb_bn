@extends('user.main')

@section('title', 'Kontak - PPDB SMK Bakti Nusantara 666')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/kontak.css') }}">
@endsection

@section('hero')
<section class="text-white py-5 position-relative" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="position-absolute w-100 h-100" style="background: url('{{ asset('assets/image/hero_section/sekolah1.png') }}'); background-size: cover; background-position: center; filter: blur(3px); z-index: -1;"></div>
    <div class="container py-5 position-relative">
        <div class="row align-items-center hero-content">
            <div class="col-lg-8">
                <div class="badge mb-3 px-4 py-2" style="background-color: rgba(245,232,199,0.2); color: white; border: 1px solid rgba(245,232,199,0.3); border-radius: 50px;">
                    <i class="fas fa-phone me-2"></i>Hubungi Kami
                </div>
                <h1 class="display-4 fw-bold mb-4">Mari <span style="color: #F5E8C7;">Terhubung</span></h1>
                <p class="lead mb-4 opacity-90">Kami siap melayani Anda dengan sepenuh hati. Jangan ragu untuk menghubungi kami kapan saja untuk pertanyaan, saran, atau konsultasi pendaftaran.</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')


<!-- Contact Form & Info -->
<section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row g-5">
            <!-- Informasi Sekolah -->
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4" style="color: #1B1A55;">Informasi Kontak</h2>
                
                <div class="mb-4">
                    <div class="d-flex align-items-start mb-4">
                        <div class="contact-icon me-3">
                            <i class="fas fa-map-marker-alt fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2" style="color: #1B1A55;">Alamat Sekolah</h5>
                            <p class="text-muted mb-0">SMK Bakti Nusantara 666<br>Jl. Raya Percobaan No.65, Cileunyi Kulon<br>Kec. Cileunyi, Kabupaten Bandung, Jawa Barat 40622</p>
                            <a href="https://maps.google.com/search/SMK+Bakti+Nusantara+666+Bandung" target="_blank" class="text-decoration-none mt-2 d-inline-flex align-items-center" style="color: #1B1A55;">
                                <i class="fas fa-external-link-alt me-2"></i>Lihat di Maps
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex align-items-start mb-4">
                        <div class="contact-icon me-3">
                            <i class="fas fa-phone fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2" style="color: #1B1A55;">Telepon</h5>
                            <div class="mb-2">
                                <a href="tel:+622112345678" class="text-muted text-decoration-none">(021) 123-4567</a>
                                <span class="small text-muted ms-2">(Kantor Utama)</span>
                            </div>
                            <div>
                                <a href="tel:+622176543210" class="text-muted text-decoration-none">(021) 765-4321</a>
                                <span class="small text-muted ms-2">(PPDB)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex align-items-start mb-4">
                        <div class="contact-icon me-3">
                            <i class="fas fa-clock fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2" style="color: #1B1A55;">Jam Operasional</h5>
                            <div class="text-muted">
                                <div><strong>Senin - Jumat:</strong> 08.00 - 17.00 WIB</div>
                                <div><strong>Sabtu:</strong> 08.00 - 12.00 WIB</div>
                                <div><strong>Minggu:</strong> Tutup</div>
                            </div>
                            <div class="badge mt-2 px-3 py-2" style="background-color: #F5E8C7; color: #1B1A55;">
                                <i class="fas fa-circle text-success me-2" style="font-size: 8px;"></i>Buka Setiap Hari Kerja
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-3" style="color: #1B1A55;">Hubungi Langsung</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="https://wa.me/6281234567890?text=Halo, saya ingin bertanya tentang PPDB" target="_blank" class="btn w-100 text-center p-3" style="background-color: #25D366; color: white; border-radius: 12px;">
                                <i class="fab fa-whatsapp fa-2x mb-2 d-block"></i>
                                <div class="fw-bold">WhatsApp</div>
                                <div class="small">Chat Langsung</div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="tel:+622112345678" class="btn btn-primary w-100 text-center p-3">
                                <i class="fas fa-phone fa-2x mb-2 d-block"></i>
                                <div class="fw-bold">Telepon</div>
                                <div class="small">Panggil Sekarang</div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div>
                    <h5 class="fw-bold mb-3" style="color: #1B1A55;">Ikuti Media Sosial Kami</h5>
                    <div class="d-flex">
                        <a href="#" class="social-btn text-white me-2" style="background-color: #1877F2;">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-btn text-white me-2" style="background-color: #E4405F;">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-btn text-white me-2" style="background-color: #FF0000;">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="social-btn text-white" style="background-color: #000000;">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-6">
                <div class="card border-0 shadow" style="border-radius: 16px;">
                    <div class="card-header py-4" style="background-color: #F5E8C7; border-radius: 16px 16px 0 0;">
                        <h4 class="mb-0 fw-bold" style="color: #1B1A55;"><i class="fas fa-paper-plane me-2"></i>Kirim Pesan</h4>
                        <p class="mb-0 mt-2" style="color: #1B1A55; opacity: 0.8;">Sampaikan pertanyaan, saran, atau kritik Anda kepada kami.</p>
                    </div>
                    <div class="card-body p-4">
                        <!-- Success/Error Messages -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        @if($errors->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ $errors->first('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        @if($errors->any() && !$errors->has('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Periksa kembali:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <form action="{{ route('kontak.store') }}" method="POST" id="contact-form">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold" style="color: #1B1A55;">
                                        <i class="fas fa-user me-2"></i>Nama Lengkap
                                    </label>
                                    <input type="text" name="nama" class="form-control form-input" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold" style="color: #1B1A55;">
                                        <i class="fas fa-envelope me-2"></i>Email
                                    </label>
                                    <input type="email" name="email" class="form-control form-input" placeholder="nama@email.com" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold" style="color: #1B1A55;">
                                        <i class="fas fa-phone me-2"></i>Nomor Telepon
                                    </label>
                                    <input type="tel" name="hp" class="form-control form-input" placeholder="0812-3456-7890" value="{{ old('hp') }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold" style="color: #1B1A55;">
                                        <i class="fas fa-tag me-2"></i>Subjek
                                    </label>
                                    <select name="subjek" class="form-control form-input" required>
                                        <option value="">Pilih subjek pesan</option>
                                        <option value="Informasi Pendaftaran" {{ old('subjek') == 'Informasi Pendaftaran' ? 'selected' : '' }}>Informasi Pendaftaran</option>
                                        <option value="Informasi Jurusan" {{ old('subjek') == 'Informasi Jurusan' ? 'selected' : '' }}>Informasi Jurusan</option>
                                        <option value="Informasi Biaya" {{ old('subjek') == 'Informasi Biaya' ? 'selected' : '' }}>Informasi Biaya</option>
                                        <option value="Konsultasi Beasiswa" {{ old('subjek') == 'Konsultasi Beasiswa' ? 'selected' : '' }}>Konsultasi Beasiswa</option>
                                        <option value="Keluhan/Saran" {{ old('subjek') == 'Keluhan/Saran' ? 'selected' : '' }}>Keluhan/Saran</option>
                                        <option value="Lainnya" {{ old('subjek') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold" style="color: #1B1A55;">
                                        <i class="fas fa-comment me-2"></i>Pesan
                                    </label>
                                    <textarea name="pesan" rows="5" class="form-control form-input" placeholder="Tulis pesan Anda di sini..." required>{{ old('pesan') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        <span id="submit-text">Kirim Pesan</span>
                                        <div id="loading-spinner" class="spinner-border spinner-border-sm ms-2 d-none"></div>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="mt-4 p-3 rounded" style="background-color: #F5E8C7;">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-info-circle me-3 mt-1" style="color: #1B1A55;"></i>
                                <div style="color: #1B1A55;">
                                    <p class="fw-bold mb-1">Informasi Penting:</p>
                                    <ul class="small mb-0" style="color: #1B1A55; opacity: 0.8;">
                                        <li>Kami akan merespon dalam 24 jam</li>
                                        <li>Untuk konsultasi urgent, hubungi WhatsApp</li>
                                        <li>Semua data Anda akan dijaga kerahasiaannya</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5" id="maps-section" style="background-color: #F5E8C7;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3" style="color: #1B1A55;">Lokasi Sekolah Kami</h2>
            <p class="text-muted">Temukan kami di lokasi strategis di pusat kota. Mudah dijangkau dengan transportasi umum.</p>
        </div>
        
        <div class="card border-0 shadow" style="border-radius: 16px; overflow: hidden;">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.5744934336744!2d107.73772907356575!3d-6.941347667947826!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c3407e51c4a3%3A0x3e434e3f31a8c4b3!2sSMK%20Bakti%20Nusantara%20666!5e0!3m2!1sid!2sid!4v1763436865762!5m2!1sid!2sid" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            
            <div class="card-footer p-4" style="background-color: white;">
                <div class="row g-4 text-center">
                    <div class="col-md-3">
                        <div class="contact-icon mx-auto mb-2" style="width: 48px; height: 48px;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h6 class="fw-bold" style="color: #1B1A55;">Alamat</h6>
                        <p class="small text-muted mb-0">Jl. Raya Percobaan No.65, Cileunyi, Bandung</p>
                    </div>
                    <div class="col-md-3">
                        <div class="contact-icon mx-auto mb-2" style="width: 48px; height: 48px;">
                            <i class="fas fa-car"></i>
                        </div>
                        <h6 class="fw-bold" style="color: #1B1A55;">Parkir</h6>
                        <p class="small text-muted mb-0">Tersedia parkir luas</p>
                    </div>
                   
                    <div class="col-md-3">
                        <a href="https://maps.app.goo.gl/ECgBQq9TVBm4WoNN8" target="_blank" class="btn btn-primary">
                            <i class="fas fa-directions me-2"></i>Petunjuk Arah
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/kontak.js') }}"></script>
@endsection