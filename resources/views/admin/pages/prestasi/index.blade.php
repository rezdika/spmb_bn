@extends('admin.admin')

@section('title', 'Kelola Prestasi')

@push('styles')
<style>
.table th {
    background-color: #f8f9fa;
    font-weight: 600;
    border-top: none;
    vertical-align: middle;
}

.table td {
    vertical-align: middle;
    padding: 12px 8px;
}

.text-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.btn-group .btn {
    margin: 0 1px;
}

.table-responsive {
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.badge {
    font-size: 0.75em;
    padding: 4px 8px;
}
</style>
@endpush

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $totalPrestasi }}</h3>
                <p style="color: #1B1A55;">Total Prestasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-trophy" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $prestasiAktif }}</h3>
                <p style="color: #1B1A55;">Prestasi Aktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $totalPrestasi - $prestasiAktif }}</h3>
                <p style="color: #1B1A55;">Prestasi Nonaktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-times-circle" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $prestasis->lastPage() }}</h3>
                <p style="color: #1B1A55;">Total Halaman</p>
            </div>
            <div class="icon">
                <i class="fas fa-copy" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Prestasi Siswa</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Prestasi
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="25%">Judul</th>
                                <th width="20%">Siswa</th>
                                <th width="15%">Kategori</th>
                                <th width="10%">Level</th>
                                <th width="10%">Tanggal</th>
                                <th width="8%">Status</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prestasis as $index => $prestasi)
                            <tr>
                                <td class="text-center">{{ $prestasis->firstItem() + $index }}</td>
                                <td>
                                    <div class="text-truncate" style="max-width: 200px;" title="{{ $prestasi->title }}">
                                        {{ $prestasi->title }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 150px;" title="{{ $prestasi->student_name }}">
                                        <strong>{{ $prestasi->student_name }}</strong>
                                    </div>
                                    <small class="text-muted">{{ $prestasi->class }}</small>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 120px;" title="{{ $prestasi->category }}">
                                        {{ $prestasi->category }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-info">{{ $prestasi->level }}</span>
                                </td>
                                <td class="text-center">
                                    <small>{{ $prestasi->achievement_date->format('d/m/Y') }}</small>
                                </td>
                                <td class="text-center">
                                    @if($prestasi->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.prestasi.show', $prestasi) }}" class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.prestasi.edit', $prestasi) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.prestasi.destroy', $prestasi) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Tidak ada data prestasi</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
            {{ $prestasis->links('vendor.pagination.compact') }}
        </div>
        </div>
    </div>
</div>
@endsection
