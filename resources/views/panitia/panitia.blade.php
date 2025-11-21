<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Panitia SPMB</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Lato:wght@300;400;700&family=Raleway:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #E8EEF2;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            color: #182233;
        }
        .main-sidebar {
            background: #4A70A9 !important;
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link {
            color: #C9D6DF;
            padding: 12px 15px;
            margin: 2px 10px;
            border-radius: 8px;
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link:hover {
            background-color: #182233;
            color: #fff;
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
            background: #182233 !important;
            color: #fff;
        }
        .card {
            border: none;
            box-shadow: 0 2px 15px rgba(24, 34, 51, 0.08);
            border-radius: 12px;
            background: #fff;
        }
        .card-header {
            background: #fff;
            color: #182233;
            border-radius: 12px 12px 0 0 !important;
            border-bottom: 2px solid #E8EEF2;
        }
        .card-header .card-title {
            color: #182233;
            font-weight: 600;
        }
        .table tbody tr:hover {
            background-color: #E8EEF2;
        }
        .btn-primary {
            background: #4A6FA5;
            border: none;
            color: #fff;
        }
        .btn-primary:hover {
            background: #182233;
            color: #fff;
        }
        .small-box.bg-primary-custom {
            background: #EFECE3 !important;
            color: #112D4E;
        }
        .small-box.bg-primary-custom .inner h3,
        .small-box.bg-primary-custom .inner p {
            color: #112D4E !important;
        }
        .small-box.bg-primary-custom .inner small {
            color: #3F72AF !important;
        }
        .small-box.bg-primary-custom .icon i {
            color: #3F72AF !important;
        }
        .small-box.bg-primary-custom .small-box-footer {
            background: rgba(63, 114, 175, 0.1) !important;
            color: #3F72AF !important;
        }
        .small-box.bg-purple-custom {
            background: #EFECE3 !important;
            color: #112D4E;
        }
        .small-box.bg-purple-custom .inner h3,
        .small-box.bg-purple-custom .inner p {
            color: #112D4E !important;
        }
        .small-box.bg-purple-custom .inner small {
            color: #3F72AF !important;
        }
        .small-box.bg-purple-custom .icon i {
            color: #3F72AF !important;
        }
        .small-box.bg-purple-custom .small-box-footer {
            background: rgba(63, 114, 175, 0.1) !important;
            color: #3F72AF !important;
        }
        .small-box.bg-warning {
            background: #EFECE3 !important;
            color: #112D4E;
        }
        .small-box.bg-warning .inner h3,
        .small-box.bg-warning .inner p {
            color: #112D4E !important;
        }
        .small-box.bg-warning .inner small {
            color: #3F72AF !important;
        }
        .small-box.bg-warning .icon i {
            color: #3F72AF !important;
        }
        .small-box.bg-warning .small-box-footer {
            background: rgba(63, 114, 175, 0.1) !important;
            color: #3F72AF !important;
        }
        .small-box.bg-danger {
            background: #EFECE3 !important;
            color: #112D4E;
        }
        .small-box.bg-danger .inner h3,
        .small-box.bg-danger .inner p {
            color: #112D4E !important;
        }
        .small-box.bg-danger .inner small {
            color: #3F72AF !important;
        }
        .small-box.bg-danger .icon i {
            color: #3F72AF !important;
        }
        .small-box.bg-danger .small-box-footer {
            background: rgba(63, 114, 175, 0.1) !important;
            color: #3F72AF !important;
        }
        .badge-primary {
            background-color: #182233 !important;
            color: #fff !important;
        }
        .badge-success {
            background-color: #4A6FA5 !important;
            color: #fff !important;
        }
        .badge-danger {
            background-color: #C9D6DF !important;
            color: #182233 !important;
        }
        .text-primary {
            color: #182233 !important;
        }
        .bg-primary {
            background-color: #182233 !important;
        }
        .content-wrapper {
            background-color: #E8EEF2;
        }
        .main-header {
            background: #fff !important;
            border-bottom: 1px solid #C9D6DF;
        }
        .alert-success {
            background-color: #C9D6DF;
            border-color: #4A6FA5;
            color: #182233;
        }
        .alert-danger {
            background-color: #E8EEF2;
            border-color: #C9D6DF;
            color: #182233;
        }
        .btn-success {
            background-color: #4A6FA5 !important;
            border-color: #4A6FA5 !important;
            color: #fff !important;
        }
        .btn-success:hover {
            background-color: #182233 !important;
            color: #fff !important;
        }
        .btn-danger {
            background-color: #C9D6DF !important;
            border-color: #C9D6DF !important;
            color: #182233 !important;
        }
        .btn-danger:hover {
            background-color: #4A6FA5 !important;
            color: #fff !important;
        }
    </style>
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('panitia.partials.navbar')
    @include('panitia.partials.sidebar')
    
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
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </section>
    </div>
    
    @include('panitia.partials.footer')
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
@stack('scripts')
</body>
</html>
