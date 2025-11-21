@extends('admin.admin')

@section('title', 'Detail Jurusan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Jurusan</h3>
        <div class="card-tools">
            <a href="{{ route('admin.jurusan.edit', $jurusan) }}" class="btn btn-sm" style="background-color: #F5E8C7; color: #1B1A55; border-color: #F5E8C7;">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-sm" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Kode Jurusan</th>
                        <td>: {{ $jurusan->kode }}</td>
                    </tr>
                    <tr>
                        <th>Nama Jurusan</th>
                        <td>: {{ $jurusan->nama }}</td>
                    </tr>
                    <tr>
                        <th>Kuota</th>
                        <td>: {{ $jurusan->kuota }} siswa</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: 
                            <span class="badge" style="background-color: {{ $jurusan->is_active ? '#1B1A55' : '#F5E8C7' }}; color: {{ $jurusan->is_active ? 'white' : '#1B1A55' }};">
                                {{ $jurusan->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Dibuat</th>
                        <td>: {{ $jurusan->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Diperbarui</th>
                        <td>: {{ $jurusan->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        @if($jurusan->deskripsi)
        <div class="row mt-3">
            <div class="col-12">
                <h5>Deskripsi</h5>
                <p class="text-muted">{{ $jurusan->deskripsi }}</p>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Statistics Card -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Statistik Jurusan</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon" style="background-color: #1B1A55; color: white;">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pendaftar</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon" style="background-color: #F5E8C7; color: #1B1A55;">
                        <i class="fas fa-percentage"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Persentase Terisi</span>
                        <span class="info-box-number">0%</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon" style="background-color: #1B1A55; color: white;">
                        <i class="fas fa-chair"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sisa Kuota</span>
                        <span class="info-box-number">{{ $jurusan->kuota }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection