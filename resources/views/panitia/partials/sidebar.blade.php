<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('panitia.dashboard') }}" class="brand-link text-center">
        <img src="{{ asset('assets/image/logo_sekolah.png') }}" alt="SMK BN 666" class="brand-image" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
        <span class="brand-text font-weight-bold">SPMB Panitia</span>
    </a>
    
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama_lengkap) }}&background=9290C3&color=fff&size=40" 
                     class="img-circle elevation-2" alt="User Avatar" style="width: 40px; height: 40px;">
            </div>
            <div class="info ml-2">
                <a href="#" class="d-block text-white font-weight-medium" style="font-size: 14px;">{{ Str::limit(auth()->user()->nama_lengkap, 20) }}</a>
                <small class="text-light opacity-75">Panitia</small>
            </div>
        </div>
        
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ route('panitia.dashboard') }}" class="nav-link {{ request()->routeIs('panitia.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <li class="nav-header text-uppercase" style="font-size: 11px; letter-spacing: 1px; color: #9290C3;">Verifikasi</li>
                
                <li class="nav-item">
                    <a href="{{ route('panitia.pendaftaran.index') }}" class="nav-link {{ request()->routeIs('panitia.pendaftaran.*') && !request()->routeIs('panitia.berkas.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Pendaftaran
                            @php
                                $menunggu = \App\Models\Pendaftaran::where('status', 'SUBMIT')->count();
                            @endphp
                            @if($menunggu > 0)
                                <span class="badge badge-warning right">{{ $menunggu }}</span>
                            @endif
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('panitia.berkas.index') }}" class="nav-link {{ request()->routeIs('panitia.berkas.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                            Verifikasi Berkas
                            @php
                                $berkasMenunggu = \App\Models\PendaftarBerkas::where('status', 'pending')->count();
                            @endphp
                            @if($berkasMenunggu > 0)
                                <span class="badge badge-danger right">{{ $berkasMenunggu }}</span>
                            @endif
                        </p>
                    </a>
                </li>
                
                <li class="nav-header text-uppercase" style="font-size: 11px; letter-spacing: 1px; color: #9290C3;">Laporan</li>
                
                <li class="nav-item">
                    <a href="{{ route('panitia.riwayat.index') }}" class="nav-link {{ request()->routeIs('panitia.riwayat.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Riwayat Verifikasi</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('panitia.laporan.index') }}" class="nav-link {{ request()->routeIs('panitia.laporan.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                
                <li class="nav-header text-uppercase" style="font-size: 11px; letter-spacing: 1px; color: #9290C3;">Akun</li>
                
                <li class="nav-item">
                    <a href="{{ route('panitia.profile.index') }}" class="nav-link {{ request()->routeIs('panitia.profile.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>Profil Saya</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link text-danger" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Keluar</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
