<section class="py-3" style="background: white; border-bottom: 2px solid #e9ecef;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        @php
                        $segments = request()->segments();
                        $url = '';
                        @endphp
                        
                        <!-- Home -->
                        <li class="breadcrumb-item {{ empty($segments) ? 'active' : '' }}">
                            @if(empty($segments))
                                <span style="color: #1B1A55; font-weight: 600;">
                                    <i class="fas fa-home me-1"></i>Beranda
                                </span>
                            @else
                                <a href="{{ route('home') }}" class="text-decoration-none" style="color: #1B1A55; font-weight: 500;">
                                    <i class="fas fa-home me-1"></i>Beranda
                                </a>
                            @endif
                        </li>
                        
                        @foreach($segments as $key => $segment)
                            @php
                            $url .= '/' . $segment;
                            $isLast = $key === count($segments) - 1;
                            
                            // Define breadcrumb mapping
                            $breadcrumbMap = [
                                'profile' => ['icon' => 'fas fa-user', 'name' => 'Profile'],
                                'data-pribadi' => ['icon' => 'fas fa-user-edit', 'name' => 'Data Pribadi'],
                                'data-orangtua' => ['icon' => 'fas fa-users', 'name' => 'Data Orang Tua'],
                                'asal-sekolah' => ['icon' => 'fas fa-school', 'name' => 'Asal Sekolah'],
                                'upload-berkas' => ['icon' => 'fas fa-file-upload', 'name' => 'Upload Berkas'],
                                'pendaftaran' => ['icon' => 'fas fa-clipboard-list', 'name' => 'Pendaftaran'],
                                'jurusan' => ['icon' => 'fas fa-graduation-cap', 'name' => 'Program Keahlian'],
                                'register' => ['icon' => 'fas fa-user-plus', 'name' => 'Daftar Akun'],
                                'login' => ['icon' => 'fas fa-sign-in-alt', 'name' => 'Masuk'],
                                'panduan' => ['icon' => 'fas fa-book-open', 'name' => 'Panduan PPDB'],
                                'kontak' => ['icon' => 'fas fa-phone', 'name' => 'Hubungi Kami'],
                                'tentang' => ['icon' => 'fas fa-info-circle', 'name' => 'Tentang Sekolah'],
                                'biaya' => ['icon' => 'fas fa-money-bill-wave', 'name' => 'Biaya Pendidikan'],
                                'jadwal' => ['icon' => 'fas fa-calendar', 'name' => 'Jadwal Pendaftaran'],
                                'pengumuman' => ['icon' => 'fas fa-bullhorn', 'name' => 'Pengumuman'],
                                'success' => ['icon' => 'fas fa-check-circle', 'name' => 'Berhasil'],
                            ];
                            
                            $breadcrumb = $breadcrumbMap[$segment] ?? [
                                'icon' => 'fas fa-file-alt',
                                'name' => ucwords(str_replace(['-', '_'], ' ', $segment))
                            ];
                            @endphp
                            
                            <li class="breadcrumb-item {{ $isLast ? 'active' : '' }}">
                                @if($isLast)
                                    <span style="color: #1B1A55; font-weight: 600;">
                                        <i class="{{ $breadcrumb['icon'] }} me-1"></i>{{ $breadcrumb['name'] }}
                                    </span>
                                @else
                                    @php
                                    // Generate route for intermediate segments
                                    $routeName = null;
                                    if ($segment === 'profile') $routeName = 'profile.index';
                                    elseif ($segment === 'pendaftaran') $routeName = 'pendaftaran.index';
                                    elseif ($segment === 'jurusan') $routeName = 'jurusan';
                                    @endphp
                                    
                                    @if($routeName && Route::has($routeName))
                                        <a href="{{ route($routeName) }}" class="text-decoration-none" style="color: #1B1A55; font-weight: 500;">
                                            <i class="{{ $breadcrumb['icon'] }} me-1"></i>{{ $breadcrumb['name'] }}
                                        </a>
                                    @else
                                        <span style="color: #1B1A55; font-weight: 500;">
                                            <i class="{{ $breadcrumb['icon'] }} me-1"></i>{{ $breadcrumb['name'] }}
                                        </span>
                                    @endif
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
            </div>
            <div class="col-md-4 text-end d-none d-md-block">
                <div class="d-flex align-items-center justify-content-end">
                    <div class="me-3 text-end">
                        <div class="small fw-bold" style="color: #1B1A55;">SMK Bakti Nusantara 666</div>
                        <div class="small" style="color: #1B1A55; opacity: 0.7;">Unggul dalam Prestasi</div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #1B1A55; border-radius: 8px; color: white;">
                        <i class="fas fa-school"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.breadcrumb-item + .breadcrumb-item::before {
    content: "/";
    color: #6c757d;
}

.breadcrumb-item a:hover {
    color: #2d2a6b !important;
}

@media (max-width: 768px) {
    .breadcrumb {
        font-size: 14px;
    }
}
</style>
