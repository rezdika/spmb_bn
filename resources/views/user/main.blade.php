<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PPDB Online - SMK Negeri 1')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Lato:wght@300;400;700&family=Raleway:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/typography.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            font-weight: 400;
            line-height: 1.6;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            line-height: 1.3;
        }
        .display-1, .display-2, .display-3, .display-4 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            line-height: 1.2;
        }
        .display-5, .display-6 {
            font-family: 'Raleway', sans-serif;
            font-weight: 500;
        }
        .navbar-brand {
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
        }
        .brand-text {
            line-height: 1.2;
        }
        .brand-main {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1B1A55 !important;
            letter-spacing: 0.5px;
        }
        .brand-sub {
            font-size: 0.75rem;
            color: #6c757d !important;
            font-weight: 400;
            margin-top: -2px;
        }
        .brand-slogan {
            font-size: 0.65rem;
            color: #0d6efd !important;
            font-weight: 500;
            letter-spacing: 1px;
            margin-top: -1px;
        }
        .navbar-nav .nav-link {
            font-family: 'Montserrat', sans-serif;
            font-weight: 500 !important;
            font-size: 1rem;
            margin-left: 1rem;
            margin-right: 1rem;
            letter-spacing: 0.3px;
        }
        .lead {
            font-family: 'Lato', sans-serif;
            font-weight: 300;
            font-size: 1.1rem;
            line-height: 1.7;
        }
        .btn {
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        .card-title {
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
        }
        .badge {
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        .mega-dropdown {
            position: static !important;
        }
        .mega-dropdown .dropdown-menu {
            width: 100%;
            left: 0;
            right: 0;
            border: none;
            border-radius: 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-top: 0;
        }
        .mega-dropdown .dropdown-item {
            padding: 0.75rem 0;
            font-weight: 500;
            border-bottom: 1px solid #f8f9fa;
        }
        .mega-dropdown .dropdown-item:last-child {
            border-bottom: none;
        }
        .mega-dropdown .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #1B1A55;
        }
    </style>
    @yield('styles')
</head>
<body>
    @include('user.partials.navbar')
    
    <main>
        @yield('hero')
        @yield('breadcrumb', view('user.partials.breadcrumb'))
        @yield('content')
    </main>
    
    @include('user.partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>