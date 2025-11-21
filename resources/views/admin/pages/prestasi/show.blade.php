@extends('admin.admin')

@section('title', 'Detail Prestasi')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Prestasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.prestasi.index') }}">Prestasi</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $prestasi->title }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.prestasi.edit', $prestasi) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($prestasi->image)
                            <img src="{{ Storage::url($prestasi->image) }}" alt="{{ $prestasi->title }}" class="img-fluid rounded">
                        @else
                            <div class="bg-light p-5 text-center rounded">
                                <i class="fas fa-image fa-3x text-muted"></i>
                                <p class="mt-2 text-muted">Tidak ada gambar</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Kategori</th>
                                <td>{{ $prestasi->category }}</td>
                            </tr>
                            <tr>
                                <th>Nama Siswa</th>
                                <td>{{ $prestasi->student_name }}</td>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <td>{{ $prestasi->class }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Prestasi</th>
                                <td>{{ $prestasi->achievement_date->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Penyelenggara</th>
                                <td>{{ $prestasi->organizer }}</td>
                            </tr>
                            <tr>
                                <th>Level</th>
                                <td><span class="badge badge-info">{{ $prestasi->level }}</span></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($prestasi->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <h5>Deskripsi Singkat</h5>
                        <p>{{ $prestasi->description }}</p>
                    </div>
                </div>

                @if($prestasi->full_description)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Deskripsi Lengkap</h5>
                        <p>{{ $prestasi->full_description }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
