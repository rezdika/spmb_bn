<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Kepala Sekolah SPMB</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Lato:wght@300;400;700&family=Raleway:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/typography.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/admin-typography.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <style>
        /* Admin Typography */
        body {
            font-family: 'Lato', sans-serif;
            font-weight: 400;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }
        .card-title {
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
        }
        .btn {
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        .nav-link {
            font-family: 'Lato', sans-serif;
            font-weight: 400;
        }
        .table th {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }
        .brand-text {
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
        }
        
        /* Modern Sidebar Theme */
        .main-sidebar {
            background: #4A70A9 !important;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .brand-link {
            background-color: rgba(255,255,255,0.05) !important;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding: 15px;
            transition: all 0.3s ease;
        }
        
        .brand-link:hover {
            background-color: rgba(255,255,255,0.1) !important;
        }
        
        .brand-text {
            font-size: 18px;
            letter-spacing: 0.5px;
        }
        
        .user-panel {
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link {
            color: #C9D6DF;
            padding: 12px 15px;
            margin: 2px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link:hover {
            background-color: #182233;
            color: #fff;
            transform: translateX(5px);
        }
        
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
            background: #182233 !important;
            color: #fff;
            box-shadow: 0 2px 8px rgba(24, 34, 51, 0.3);
            transform: translateX(5px);
        }
        
        .nav-header {
            padding: 15px 15px 8px 15px;
            margin-top: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 10px;
        }
        
        .nav-icon {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }
        
        .badge {
            font-size: 10px;
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
        }

        .content-wrapper {
            background-color: #E8EEF2;
        }
        /* Modern Minimalist Table */
        .table {
            background: transparent;
            color: #333;
            border: none;
        }
        .table th {
            background: transparent;
            border: none;
            border-bottom: 2px solid #112D4E;
            color: #112D4E;
            font-weight: 600;
            padding: 15px 10px;
            font-size: 14px;
        }
        .table td {
            border: none;
            border-bottom: 1px solid #e9ecef;
            padding: 15px 10px;
            vertical-align: middle;
            color: #333;
        }
        .table tbody tr {
            transition: all 0.3s ease;
        }
        .table tbody tr:hover {
            background-color: #E8EEF2;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .card {
            background: #fff;
            color: #333;
            border: none;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            border-radius: 12px;
        }
        .card-header {
            background: transparent;
            border-bottom: 1px solid #e9ecef;
            color: #333;
            padding: 20px;
        }
        .card-body {
            padding: 20px;
        }
        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .badge {
            border-radius: 20px;
            padding: 6px 12px;
            font-weight: 500;
        }
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }
    </style>
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('kepala-sekolah.partials.navbar')
    @include('kepala-sekolah.partials.sidebar')
    
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div>
                </div>
            </div>
        </div>
        
        <section class="content">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </section>
    </div>
    
    @include('kepala-sekolah.partials.footer')
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
@stack('scripts')
</body>
</html>
