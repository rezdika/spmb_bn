<!-- Modern Admin Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('kepala-sekolah.dashboard') }}" class="brand-link text-center">
        <img src="{{ asset('assets/image/logo_sekolah.png') }}" alt="SMK BN 666" class="brand-image" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
        <span class="brand-text font-weight-bold">Kepala Sekolah</span>
    </a>
    
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama_lengkap) }}&background=9290C3&color=fff&size=40" 
                     class="img-circle elevation-2" alt="User Avatar" style="width: 40px; height: 40px;">
            </div>
            <div class="info ml-2">
                <a href="#" class="d-block text-white font-weight-medium" style="font-size: 14px;">{{ Str::limit(auth()->user()->nama_lengkap, 20) }}</a>
                <small class="text-light opacity-75">Kepala Sekolah</small>
            </div>
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('kepala-sekolah.dashboard') }}" class="nav-link {{ request()->routeIs('kepala-sekolah.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p class="font-weight-medium">Dashboard</p>
                    </a>
                </li>
                
                <!-- Divider -->
                <li class="nav-header text-uppercase font-weight-bold" style="font-size: 11px; letter-spacing: 1px; color: #9290C3;">Data Calon Siswa</li>
                
                <!-- Daftar Calon Siswa -->
                <li class="nav-item {{ request()->routeIs('kepala-sekolah.calon-siswa.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('kepala-sekolah.calon-siswa.index') }}" class="nav-link {{ request()->routeIs('kepala-sekolah.calon-siswa.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p class="font-weight-medium">
                            Daftar Calon Siswa
                        </p>
                    </a>
                </li>
                
                <!-- Divider -->
                <li class="nav-header text-uppercase font-weight-bold" style="font-size: 11px; letter-spacing: 1px; color: #9290C3;">Siswa Diterima</li>
                
                <!-- Rekap Pembayaran -->
                <li class="nav-item {{ request()->routeIs('kepala-sekolah.siswa-diterima.rekap-pembayaran') ? 'menu-open' : '' }}">
                    <a href="{{ route('kepala-sekolah.siswa-diterima.rekap-pembayaran') }}" class="nav-link {{ request()->routeIs('kepala-sekolah.siswa-diterima.rekap-pembayaran') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p class="font-weight-medium">
                            Rekap Pembayaran
                        </p>
                    </a>
                </li>
                
                <!-- Data Asal Sekolah -->
                <li class="nav-item {{ request()->routeIs('kepala-sekolah.siswa-diterima.asal-sekolah') ? 'menu-open' : '' }}">
                    <a href="{{ route('kepala-sekolah.siswa-diterima.asal-sekolah') }}" class="nav-link {{ request()->routeIs('kepala-sekolah.siswa-diterima.asal-sekolah') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-school"></i>
                        <p class="font-weight-medium">
                            Data Asal Sekolah
                        </p>
                    </a>
                </li>
                
                <!-- Sebaran Wilayah -->
                <li class="nav-item {{ request()->routeIs('kepala-sekolah.siswa-diterima.sebaran-wilayah') ? 'menu-open' : '' }}">
                    <a href="{{ route('kepala-sekolah.siswa-diterima.sebaran-wilayah') }}" class="nav-link {{ request()->routeIs('kepala-sekolah.siswa-diterima.sebaran-wilayah') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p class="font-weight-medium">
                            Sebaran Wilayah
                        </p>
                    </a>
                </li>
                
                <!-- Divider -->
                <li class="nav-header text-uppercase font-weight-bold" style="font-size: 11px; letter-spacing: 1px; color: #9290C3;">Akun</li>
                
                <!-- Profile -->
                <li class="nav-item {{ request()->routeIs('kepala-sekolah.profile.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('kepala-sekolah.profile.index') }}" class="nav-link {{ request()->routeIs('kepala-sekolah.profile.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p class="font-weight-medium">Profil Saya</p>
                    </a>
                </li>
                
                <!-- Logout -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link text-danger" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p class="font-weight-medium">Keluar</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                
            </ul>
        </nav>
    </div>
</aside>
