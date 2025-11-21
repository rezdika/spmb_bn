@extends('user.main')

@section('title', 'Prestasi Siswa - SMK Bakti Nusantara 666')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Prestasi Siswa</li>
        </ol>
    </div>
</nav>
@endsection

@section('hero')
<!-- Hero Section -->
<section class="hero-gradient text-white" style="background: url('{{ asset('assets/image/hero_section/sekolah1.png') }}') center/cover no-repeat; min-height: 60vh; position: relative; display: flex; align-items: center;">
    <div class="hero-overlay" style="position: absolute; inset: 0; "></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4"> Prestasi <span style="color: #F5E8C7;">Siswa</span></h1>
                <p class="lead mb-4 opacity-90">Berbagai pencapaian membanggakan siswa SMK Bakti Nusantara 666 yang telah mengharumkan nama sekolah di tingkat lokal, nasional, dan internasional</p>
                <div class="d-flex justify-content-center gap-4 text-sm">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-trophy me-2" style="color: #F5E8C7;"></i>
                        <span>100+ Prestasi</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-medal me-2" style="color: #F5E8C7;"></i>
                        <span>Tingkat Nasional</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-star me-2" style="color: #F5E8C7;"></i>
                        <span>Multi Kategori</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<section class="py-5">
    <div class="container">

        <!-- Filter & Search -->
        <div class="row mb-4">
            <div class="col-12">
                <form method="GET" action="{{ route('prestasi.index') }}" class="row g-3">
                    <!-- Search -->
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="search" placeholder="🔍 Cari prestasi..." value="{{ request('search') }}">
                    </div>
                    
                    <!-- Category Filter -->
                    <div class="col-md-2">
                        <select class="form-select" name="category">
                            <option value=""> Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Level Filter -->
                    <div class="col-md-2">
                        <select class="form-select" name="level">
                            <option value=""> Semua Tingkat</option>
                            @foreach($levels as $level)
                                <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>
                                    {{ $level }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Year Filter -->
                    <div class="col-md-2">
                        <select class="form-select" name="year">
                            <option value=""> Semua Tahun</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Sort -->
                    <div class="col-md-2">
                        <select class="form-select" name="sort">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}> Terlama</option>
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}> A-Z</option>
                        </select>
                    </div>
                    
                    <!-- Submit -->
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results Info -->
        <div class="row mb-4">
            <div class="col-12">
                <p class="text-muted mb-0">
                    Menampilkan {{ $prestasi->count() }} dari {{ $prestasi->total() }} prestasi
                    @if(request()->hasAny(['search', 'category', 'level', 'year']))
                        | <a href="{{ route('prestasi.index') }}" class="text-decoration-none">Reset Filter</a>
                    @endif
                </p>
            </div>
        </div>

        <!-- Prestasi Grid -->
        @if($prestasi->count() > 0)
            <div class="row g-4">
                @foreach($prestasi as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card h-100 shadow-sm border-0" style="border-radius: 0 !important;">
                            <!-- Image -->
                            <div class="position-relative" style="height: 250px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $item->image) }}" 
                                     alt="{{ $item->title }}" 
                                     class="card-img-top w-100 h-100" 
                                     style="object-fit: cover; border-radius: 0 !important;">
                                
                                <!-- Badges -->
                                <div class="position-absolute top-0 start-0 p-2">
                                    <span class="badge text-white me-1" style="background-color: #1B1A55;">
                                        {{ $item->category }}
                                    </span>
                                    <span class="badge bg-warning text-dark">
                                        {{ $item->level }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold mb-2" style="color: #1B1A55; line-height: 1.3;">
                                    {{ $item->title }}
                                </h5>
                                
                                <div class="mb-3">
                                    <p class="mb-1 text-muted small">
                                        <i class="fas fa-user"></i> {{ $item->student_name }}
                                    </p>
                                    <p class="mb-1 text-muted small">
                                        <i class="fas fa-graduation-cap"></i> {{ $item->class }}
                                    </p>
                                    <p class="mb-0 text-muted small">
                                        <i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($item->achievement_date)->format('d M Y') }}
                                    </p>
                                </div>
                                
                                <p class="card-text text-muted small mb-3 flex-grow-1">
                                    {{ Str::limit($item->description, 100) }}
                                </p>
                                
                                <div class="mt-auto">
                                    <a href="{{ route('prestasi.detail', $item->slug) }}" 
                                       class="btn btn-outline-primary w-100" 
                                       style="border-radius: 0 !important;">
                                        <i class="fas fa-eye"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $prestasi->links('vendor.pagination.compact') }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-search fa-4x text-muted"></i>
                </div>
                <h4 class="text-muted mb-3">Tidak ada prestasi ditemukan</h4>
                <p class="text-muted mb-4">Coba ubah filter atau kata kunci pencarian Anda</p>
                <a href="{{ route('prestasi.index') }}" class="btn btn-primary">
                    <i class="fas fa-refresh"></i> Reset Filter
                </a>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
// Auto submit form when filter changes
document.querySelectorAll('select[name="category"], select[name="level"], select[name="year"], select[name="sort"]').forEach(function(select) {
    select.addEventListener('change', function() {
        this.form.submit();
    });
});
</script>
@endpush