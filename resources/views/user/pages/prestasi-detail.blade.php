@extends('user.main')

@section('title', $prestasi->title . ' - PPDB SMK Bakti Nusantara 666')

@section('content')
<!-- Breadcrumb -->
<section class="py-3" style="background-color: #F8F9FA;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #1B1A55;">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('prestasi.index') }}" style="color: #1B1A55;">Prestasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($prestasi->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Hero Image -->
<section class="py-5" style="background-color: white;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <img src="{{ asset('storage/' . $prestasi->image) }}" alt="{{ $prestasi->title }}" class="img-fluid rounded-3 shadow-lg mb-4" style="width: 100%; height: 500px; object-fit: cover;">
                
                <div class="mb-4">
                    <span class="badge px-3 py-2 me-2" style="background-color: #1B1A55; color: white; font-size: 14px;">{{ $prestasi->category }}</span>
                    <span class="badge px-3 py-2" style="background-color: #F5E8C7; color: #1B1A55; font-size: 14px;">{{ $prestasi->level }}</span>
                </div>
                
                <h1 class="fw-bold mb-4" style="color: #1B1A55;">{{ $prestasi->title }}</h1>
                
                <!-- Info Box -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background-color: #F8F9FA;">
                            <p class="mb-1 text-muted small">Nama Siswa</p>
                            <p class="mb-0 fw-bold" style="color: #1B1A55;"><i class="fas fa-user me-2" style="color: #647FBC;"></i>{{ $prestasi->student_name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background-color: #F8F9FA;">
                            <p class="mb-1 text-muted small">Kelas</p>
                            <p class="mb-0 fw-bold" style="color: #1B1A55;"><i class="fas fa-school me-2" style="color: #647FBC;"></i>{{ $prestasi->class }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background-color: #F8F9FA;">
                            <p class="mb-1 text-muted small">Tanggal Prestasi</p>
                            <p class="mb-0 fw-bold" style="color: #1B1A55;"><i class="fas fa-calendar me-2" style="color: #647FBC;"></i>{{ $prestasi->formatted_date }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background-color: #F8F9FA;">
                            <p class="mb-1 text-muted small">Penyelenggara</p>
                            <p class="mb-0 fw-bold" style="color: #1B1A55;"><i class="fas fa-building me-2" style="color: #647FBC;"></i>{{ $prestasi->organizer }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="mb-5">
                    <h4 class="fw-bold mb-3" style="color: #1B1A55;">Detail Prestasi</h4>
                    <div style="color: #495057; line-height: 1.8; text-align: justify;">
                        {!! nl2br(e($prestasi->full_description)) !!}
                    </div>
                </div>
                
                <!-- Back Button -->
                <div class="text-center">
                    <a href="{{ route('prestasi.index') }}" class="btn btn-lg px-5 py-3 me-3" style="background-color: #1B1A55; color: white; border: none; border-radius: 0 !important;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Prestasi
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg px-5 py-3" style="border-radius: 0 !important;">
                        <i class="fas fa-home me-2"></i>Ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
