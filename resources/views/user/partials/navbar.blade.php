<nav class="navbar navbar-expand-lg sticky-top" style="background: #ffff; backdrop-filter: blur(10px); transition: all 0.3s ease;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center text-decoration-none" href="{{ route('home') }}">
            <img src="{{ asset('assets/image/logo_sekolah.png') }}" alt="Logo SMK" height="100" class="me-3">
            <div class="brand-text">
                <div class="brand-main text-white">SMK BAKTI NUSANTARA 666</div>
                <div class="brand-sub text-white-50">Sekolah Menengah Kejuruan</div>
                <div class="brand-slogan text-white-50">SAJUTA - Santun, Jujur, Taat</div>
            </div>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                  <li class="nav-item">
                    <a class="nav-link text-muted" href="{{ route('home') }}">Beranda</a>
                </li>
              
                   <li class="nav-item dropdown mega-dropdown">
                    <a class="nav-link dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown">Profil</a>
                    <div class="dropdown-menu">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-black mb-3">Profil Sekolah</h6>

                                     <a class="dropdown-item" href="{{ route('sambutan') }}">
                                        Sambutan Kepala Sekolah
                                    </a>
                                   
                                     <a class="dropdown-item" href="{{ route('sejarah') }}">
                                        sejarah
                                    </a>
                                     <a class="dropdown-item" href="{{ route('visi-misi') }}">
                                        visi & misi
                                    </a>
                                     <a class="dropdown-item" href="{{ route('tenaga-pendidik') }}">
                                        Tenaga pendidik
                                    </a>
                                      <a class="dropdown-item" href="{{ route('prestasi.index') }}">
                                        Prestasi Siswa
                                    </a>

                                </div>
                                
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted" href="{{ route('panduan') }}">Panduan</a>
                </li>
               
                <li class="nav-item dropdown mega-dropdown">
                    <a class="nav-link dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown">Informasi</a>
                    <div class="dropdown-menu">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-black mb-3">Informasi PPDB</h6>
                                    <a class="dropdown-item" href="{{ route('jadwal') }}">
                                        Jadwal & Gelombang
                                    </a>
                                    <a class="dropdown-item" href="{{ route('biaya') }}">
                                        Biaya Pendaftaran
                                    </a>
                                    <a class="dropdown-item" href="{{ route('pengumuman') }}">
                                        Pengumuman
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted" href="{{ route('jurusan') }}">Jurusan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted" href="{{ route('kontak') }}">Kontak</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-muted" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn text-dark ms-2 px-3" style="background-color: #F5E8C7;" href="{{ route('register') }}">Daftar</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>{{ explode(' ', Auth::user()->nama_lengkap)[0] }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="fas fa-user-edit me-2"></i>Profile</a></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('monitoring.index') }}">
                                    <span><i class="fas fa-chart-line me-2"></i>Monitoring Progress</span>
                                    @if($berkasNotificationCount > 0)
                                        <span class="badge bg-danger rounded-pill ms-2">{{ $berkasNotificationCount }}</span>
                                    @endif
                                </a>
                            </li>
                            @if(Auth::user()->isAdmin())
                                <li><a class="dropdown-item text-modern" href="{{ route('admin.dashboard') }}"><i class="fas fa-cogs me-2" style="color: #1B1A55;"></i>Admin Panel</a></li>
                            @endif
                            @if(Auth::user()->role === 'keuangan')
                                <li><a class="dropdown-item text-modern" href="{{ route('keuangan.dashboard') }}"><i class="fas fa-money-bill-wave me-2" style="color: #1B1A55;"></i>Keuangan Panel</a></li>
                            @endif
                            @if(Auth::user()->role === 'panitia')
                                <li><a class="dropdown-item text-modern" href="{{ route('panitia.dashboard') }}"><i class="fas fa-clipboard-check me-2" style="color: #1B1A55;"></i>Panitia Panel</a></li>
                            @endif
                            @if(Auth::user()->role === 'kepala_sekolah')
                                <li><a class="dropdown-item text-modern" href="{{ route('kepala-sekolah.dashboard') }}"><i class="fas fa-chart-bar me-2" style="color: #1B1A55;"></i>Kepala Sekolah Panel</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>