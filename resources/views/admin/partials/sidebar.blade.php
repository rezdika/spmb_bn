<!-- Modern Admin Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
        <img src="{{ asset('assets/image/logo_sekolah.png') }}" alt="SMK BN 666" class="brand-image" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
        <span class="brand-text font-weight-bold">SPMB Admin</span>
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
                <small class="text-light opacity-75">{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</small>
            </div>
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p class="font-weight-medium">Dashboard</p>
                    </a>
                </li>
                
                <!-- Divider -->
                <li class="nav-header text-uppercase font-weight-bold" style="font-size: 11px; letter-spacing: 1px; color: #9290C3;">Manajemen Data</li>
                
                <!-- Jurusan -->
                <li class="nav-item {{ request()->routeIs('admin.jurusan.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.jurusan.index') }}" class="nav-link {{ request()->routeIs('admin.jurusan.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p class="font-weight-medium">
                            Jurusan
                        </p>
                    </a>
                </li>
                
                <!-- Gelombang -->
                <li class="nav-item {{ request()->routeIs('admin.gelombang.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.gelombang.index') }}" class="nav-link {{ request()->routeIs('admin.gelombang.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p class="font-weight-medium">
                            Gelombang
                        </p>
                    </a>
                </li>
                
                <!-- Prestasi -->
                <li class="nav-item {{ request()->routeIs('admin.prestasi.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.prestasi.index') }}" class="nav-link {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p class="font-weight-medium">
                            Prestasi
                        </p>
                    </a>
                </li>
                
                <!-- Data Guru -->
                <li class="nav-item {{ request()->routeIs('admin.guru.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.guru.index') }}" class="nav-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p class="font-weight-medium">
                            Data Guru
                        </p>
                    </a>
                </li>
                
                <!-- Divider -->
                <li class="nav-header text-uppercase font-weight-bold" style="font-size: 11px; letter-spacing: 1px; color: #9290C3;">Monitoring</li>
                
                <!-- Monitoring Berkas -->
                <li class="nav-item {{ request()->routeIs('admin.monitoring-berkas.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.monitoring-berkas.index') }}" class="nav-link {{ request()->routeIs('admin.monitoring-berkas.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p class="font-weight-medium">
                            Monitoring Berkas
                        </p>
                    </a>
                </li>
                
                <!-- Peta Sebaran -->
                <li class="nav-item {{ request()->routeIs('admin.peta-sebaran.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.peta-sebaran.index') }}" class="nav-link {{ request()->routeIs('admin.peta-sebaran.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p class="font-weight-medium">
                            Peta Sebaran
                        </p>
                    </a>
                </li>
                
                <!-- Divider -->
                <li class="nav-header text-uppercase font-weight-bold" style="font-size: 11px; letter-spacing: 1px; color: #9290C3;">Sistem</li>
                
                <!-- Wilayah -->
                <li class="nav-item {{ request()->routeIs('admin.provinces.*') || request()->routeIs('admin.regencies.*') || request()->routeIs('admin.districts.*') || request()->routeIs('admin.villages.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.provinces.*') || request()->routeIs('admin.regencies.*') || request()->routeIs('admin.districts.*') || request()->routeIs('admin.villages.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p class="font-weight-medium">
                            Data Wilayah
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.provinces.index') }}" class="nav-link {{ request()->routeIs('admin.provinces.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Provinsi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.regencies.index') }}" class="nav-link {{ request()->routeIs('admin.regencies.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kabupaten/Kota</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.districts.index') }}" class="nav-link {{ request()->routeIs('admin.districts.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kecamatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.villages.index') }}" class="nav-link {{ request()->routeIs('admin.villages.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kelurahan/Desa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Users -->
                <li class="nav-item {{ request()->routeIs('admin.user.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p class="font-weight-medium">
                            Pengguna
                        </p>
                    </a>
                </li>
                
                <!-- Divider -->
                <li class="nav-header text-uppercase font-weight-bold" style="font-size: 11px; letter-spacing: 1px; color: #9290C3;">Akun</li>
                
                <!-- Profile -->
                <li class="nav-item {{ request()->routeIs('admin.profile.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.profile.index') }}" class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
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