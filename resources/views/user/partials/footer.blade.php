<!-- Professional Footer -->
<footer class="text-light" style="background: linear-gradient(135deg, #1B1A55 0%, #0f0e3d 50%, #0a0928 100%); margin-top: 5rem;">
    <!-- Main Footer Content -->
    <div class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Column 1: School Branding -->
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('assets/image/logo_sekolah.png') }}" alt="Logo SMK" height="50" class="me-3">
                        <div>
                            <h5 class="mb-0 fw-bold" style="color: white; font-size: 1.2rem; line-height: 1.2;">SMK BAKTI NUSANTARA 666</h5>
                            <small style="color: #B8C5D6; font-size: 0.85rem;">Sekolah Menengah Kejuruan</small>
                            <div style="color: #87CEEB; font-size: 0.75rem; font-weight: 600; letter-spacing: 1px; margin-top: 3px;">SAJUTA - Santun, Jujur, Taat</div>
                        </div>
                    </div>
                    <p class="mb-4" style="color: #B8C5D6; font-size: 0.95rem; line-height: 1.6;">Membangun generasi unggul dengan pendidikan berkualitas dan karakter yang kuat untuk masa depan Indonesia.</p>
                    
                    <!-- Social Media -->
                    <div class="d-flex gap-3">
                        <a href="#" class="social-link" style="color: #B8C5D6; font-size: 1.4rem; transition: all 0.3s ease;" onmouseover="this.style.color='#4267B2'" onmouseout="this.style.color='#B8C5D6'">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="social-link" style="color: #B8C5D6; font-size: 1.4rem; transition: all 0.3s ease;" onmouseover="this.style.color='#E4405F'" onmouseout="this.style.color='#B8C5D6'">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" style="color: #B8C5D6; font-size: 1.4rem; transition: all 0.3s ease;" onmouseover="this.style.color='#FF0000'" onmouseout="this.style.color='#B8C5D6'">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="social-link" style="color: #B8C5D6; font-size: 1.4rem; transition: all 0.3s ease;" onmouseover="this.style.color='#25D366'" onmouseout="this.style.color='#B8C5D6'">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Column 2: Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-4" style="color: white; font-size: 1.1rem;">Menu Utama</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="footer-link" style="color: #B8C5D6; text-decoration: none; font-size: 0.95rem; transition: all 0.3s ease;" onmouseover="this.style.color='white'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#B8C5D6'; this.style.paddingLeft='0'"><i class="fas fa-home me-2" style="width: 16px;"></i>Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('jurusan') }}" class="footer-link" style="color: #B8C5D6; text-decoration: none; font-size: 0.95rem; transition: all 0.3s ease;" onmouseover="this.style.color='white'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#B8C5D6'; this.style.paddingLeft='0'"><i class="fas fa-graduation-cap me-2" style="width: 16px;"></i>Jurusan</a></li>
                        <li class="mb-2"><a href="{{ route('prestasi.index') }}" class="footer-link" style="color: #B8C5D6; text-decoration: none; font-size: 0.95rem; transition: all 0.3s ease;" onmouseover="this.style.color='white'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#B8C5D6'; this.style.paddingLeft='0'"><i class="fas fa-trophy me-2" style="width: 16px;"></i>Prestasi</a></li>
                        <li class="mb-2"><a href="{{ route('tenaga-pendidik') }}" class="footer-link" style="color: #B8C5D6; text-decoration: none; font-size: 0.95rem; transition: all 0.3s ease;" onmouseover="this.style.color='white'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#B8C5D6'; this.style.paddingLeft='0'"><i class="fas fa-users me-2" style="width: 16px;"></i>Guru & Staff</a></li>
                        <li class="mb-2"><a href="{{ route('visi-misi') }}" class="footer-link" style="color: #B8C5D6; text-decoration: none; font-size: 0.95rem; transition: all 0.3s ease;" onmouseover="this.style.color='white'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#B8C5D6'; this.style.paddingLeft='0'"><i class="fas fa-eye me-2" style="width: 16px;"></i>Visi & Misi</a></li>
                        <li class="mb-2"><a href="{{ route('kontak') }}" class="footer-link" style="color: #B8C5D6; text-decoration: none; font-size: 0.95rem; transition: all 0.3s ease;" onmouseover="this.style.color='white'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#B8C5D6'; this.style.paddingLeft='0'"><i class="fas fa-envelope me-2" style="width: 16px;"></i>Kontak</a></li>
                    </ul>
                </div>
                
                <!-- Column 3: PPDB Information -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-4" style="color: white; font-size: 1.1rem;">Informasi PPDB</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('panduan') }}" class="footer-link" style="color: #B8C5D6; text-decoration: none; font-size: 0.95rem; transition: all 0.3s ease;" onmouseover="this.style.color='white'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#B8C5D6'; this.style.paddingLeft='0'"><i class="fas fa-book me-2" style="width: 16px;"></i>Panduan Pendaftaran</a></li>
                        <li class="mb-2"><a href="{{ route('jadwal') }}" class="footer-link" style="color: #B8C5D6; text-decoration: none; font-size: 0.95rem; transition: all 0.3s ease;" onmouseover="this.style.color='white'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#B8C5D6'; this.style.paddingLeft='0'"><i class="fas fa-calendar me-2" style="width: 16px;"></i>Jadwal Pendaftaran</a></li>
                        <li class="mb-2"><a href="{{ route('biaya') }}" class="footer-link" style="color: #B8C5D6; text-decoration: none; font-size: 0.95rem; transition: all 0.3s ease;" onmouseover="this.style.color='white'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#B8C5D6'; this.style.paddingLeft='0'"><i class="fas fa-money-bill me-2" style="width: 16px;"></i>Biaya Pendidikan</a></li>
                        <li class="mb-2"><a href="{{ route('pengumuman') }}" class="footer-link" style="color: #B8C5D6; text-decoration: none; font-size: 0.95rem; transition: all 0.3s ease;" onmouseover="this.style.color='white'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#B8C5D6'; this.style.paddingLeft='0'"><i class="fas fa-bullhorn me-2" style="width: 16px;"></i>Pengumuman</a></li>
                        <li class="mb-2"><a href="{{ route('login') }}" class="footer-link" style="color: #87CEEB; text-decoration: none; font-size: 0.95rem; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.color='white'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#87CEEB'; this.style.paddingLeft='0'"><i class="fas fa-sign-in-alt me-2" style="width: 16px;"></i>Login PPDB</a></li>
                        <li class="mb-2"><a href="{{ route('register') }}" class="footer-link" style="color: #87CEEB; text-decoration: none; font-size: 0.95rem; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.color='white'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#87CEEB'; this.style.paddingLeft='0'"><i class="fas fa-user-plus me-2" style="width: 16px;"></i>Daftar Akun</a></li>
                    </ul>
                </div>
                
                <!-- Column 4: Contact Information -->
                <div class="col-lg-4 col-md-6">
                    <h6 class="fw-bold mb-4" style="color: white; font-size: 1.1rem;">Hubungi Kami</h6>
                    
                    <!-- Address -->
                    <div class="mb-3 d-flex align-items-start">
                        <i class="fas fa-map-marker-alt me-3 mt-1" style="color: #87CEEB; font-size: 1.1rem; width: 20px;"></i>
                        <div>
                            <p class="mb-1" style="color: white; font-weight: 600; font-size: 0.95rem;">Alamat Sekolah</p>
                            <p class="mb-0" style="color: #B8C5D6; font-size: 0.9rem; line-height: 1.5;">Jl. Raya Pendidikan No. 666<br>Kecamatan Bakti Nusantara<br>Kabupaten Pendidikan, Jawa Barat 12345</p>
                        </div>
                    </div>
                    
                    <!-- Phone -->
                    <div class="mb-3 d-flex align-items-center">
                        <i class="fas fa-phone me-3" style="color: #87CEEB; font-size: 1.1rem; width: 20px;"></i>
                        <div>
                            <p class="mb-1" style="color: white; font-weight: 600; font-size: 0.95rem;">Telepon</p>
                            <p class="mb-0" style="color: #B8C5D6; font-size: 0.9rem;">(021) 666-7777</p>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="mb-3 d-flex align-items-center">
                        <i class="fas fa-envelope me-3" style="color: #87CEEB; font-size: 1.1rem; width: 20px;"></i>
                        <div>
                            <p class="mb-1" style="color: white; font-weight: 600; font-size: 0.95rem;">Email</p>
                            <p class="mb-0" style="color: #B8C5D6; font-size: 0.9rem;">info@smkbaktinusantara666.sch.id</p>
                        </div>
                    </div>
                    
                    <!-- Operating Hours -->
                    <div class="mb-3 d-flex align-items-start">
                        <i class="fas fa-clock me-3 mt-1" style="color: #87CEEB; font-size: 1.1rem; width: 20px;"></i>
                        <div>
                            <p class="mb-1" style="color: white; font-weight: 600; font-size: 0.95rem;">Jam Operasional</p>
                            <p class="mb-0" style="color: #B8C5D6; font-size: 0.9rem; line-height: 1.5;">Senin - Jumat: 07:00 - 16:00<br>Sabtu: 07:00 - 12:00<br>Minggu: Tutup</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bottom Bar -->
    <div class="py-3" style="background-color: rgba(0,0,0,0.2); border-top: 1px solid rgba(255,255,255,0.1);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0" style="color: #B8C5D6; font-size: 0.9rem;">
                        &copy; {{ date('Y') }} SMK Bakti Nusantara 666. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex justify-content-md-end justify-content-start gap-3 mt-2 mt-md-0">
                        <a href="#" style="color: #B8C5D6; text-decoration: none; font-size: 0.85rem; transition: color 0.3s ease;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#B8C5D6'">Privacy Policy</a>
                        <span style="color: #647FBC;">|</span>
                        <a href="#" style="color: #B8C5D6; text-decoration: none; font-size: 0.85rem; transition: color 0.3s ease;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#B8C5D6'">Terms of Service</a>
                        <span style="color: #647FBC;">|</span>
                        <a href="#" style="color: #B8C5D6; text-decoration: none; font-size: 0.85rem; transition: color 0.3s ease;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#B8C5D6'">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>