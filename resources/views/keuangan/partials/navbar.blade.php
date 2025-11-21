<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="border-bottom: 1px solid #dee2e6;">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars" style="color: #1B1A55;"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('keuangan.dashboard') }}" class="nav-link" style="color: #495057;">
                <i class="fas fa-home mr-1" style="color: #1B1A55;"></i> Home
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" style="color: #495057;">
                <i class="far fa-user mr-1" style="color: #1B1A55;"></i>
                <span class="d-none d-md-inline">{{ Auth::user()->nama_lengkap }}</span>
                <i class="fas fa-caret-down ml-1"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow-sm" style="border-radius: 8px; border: none;">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user mr-2" style="color: #1B1A55;"></i>Profile
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
