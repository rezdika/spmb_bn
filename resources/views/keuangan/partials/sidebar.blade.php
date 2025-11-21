<!-- Modern Keuangan Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('keuangan.dashboard') }}" class="brand-link text-center">
        <img src="{{ asset('assets/image/logo_sekolah.png') }}" alt="SMK BN 666" class="brand-image" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
        <span class="brand-text font-weight-bold">SPMB Keuangan</span>
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
                    <a href="{{ route('keuangan.dashboard') }}" class="nav-link {{ request()->routeIs('keuangan.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p class="font-weight-medium">Dashboard</p>
                    </a>
                </li>
                
                <!-- Divider -->
                <li class="nav-header text-uppercase font-weight-bold" style="font-size: 11px; letter-spacing: 1px; color: #9290C3;">Manajemen Pembayaran</li>
                
                <!-- Verifikasi Pembayaran -->
                <li class="nav-item {{ request()->routeIs('keuangan.pembayaran.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('keuangan.pembayaran.index') }}" class="nav-link {{ request()->routeIs('keuangan.pembayaran.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p class="font-weight-medium">
                            Verifikasi Pembayaran
                            @php
                                $pending = \App\Models\Pendaftaran::where('status_pembayaran', 'menunggu_verifikasi')->count();
                            @endphp
                            @if($pending > 0)
                                <span class="badge badge-warning right">{{ $pending }}</span>
                            @endif
                        </p>
                    </a>
                </li>
                <!-- Transaksi -->
                <li class="nav-item {{ request()->routeIs('keuangan.transaksi.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('keuangan.transaksi.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p class="font-weight-medium">
                            Transaksi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('keuangan.transaksi.riwayat') }}" class="nav-link {{ request()->routeIs('keuangan.transaksi.riwayat') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Riwayat Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('keuangan.transaksi.lunas') }}" class="nav-link {{ request()->routeIs('keuangan.transaksi.lunas') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pembayaran Lunas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Divider -->
                <li class="nav-header text-uppercase font-weight-bold" style="font-size: 11px; letter-spacing: 1px; color: #9290C3;">Laporan</li>
                
                <!-- Laporan Keuangan -->
                <li class="nav-item {{ request()->routeIs('keuangan.laporan.*') || request()->routeIs('keuangan.rekap.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('keuangan.laporan.*') || request()->routeIs('keuangan.rekap.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p class="font-weight-medium">
                            Laporan Keuangan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('keuangan.laporan.harian') }}" class="nav-link {{ request()->routeIs('keuangan.laporan.harian') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rekap Harian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('keuangan.laporan.bulanan') }}" class="nav-link {{ request()->routeIs('keuangan.laporan.bulanan') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rekap Bulanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('keuangan.laporan.jurusan') }}" class="nav-link {{ request()->routeIs('keuangan.laporan.jurusan') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rekap per Jurusan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('keuangan.rekap.index') }}" class="nav-link {{ request()->routeIs('keuangan.rekap.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Export Laporan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Divider -->
                <li class="nav-header text-uppercase font-weight-bold" style="font-size: 11px; letter-spacing: 1px; color: #9290C3;">Akun</li>
                
                <!-- Profile -->
                <li class="nav-item {{ request()->routeIs('keuangan.profile.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('keuangan.profile.index') }}" class="nav-link {{ request()->routeIs('keuangan.profile.*') ? 'active' : '' }}">
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
