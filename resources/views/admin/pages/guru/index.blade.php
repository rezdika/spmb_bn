@extends('admin.admin')

@section('title', 'Kelola Data Guru')

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $totalGuru }}</h3>
                <p style="color: #1B1A55;">Total Guru</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ App\Models\Guru::distinct('mata_pelajaran')->count() }}</h3>
                <p style="color: #1B1A55;">Mata Pelajaran</p>
            </div>
            <div class="icon">
                <i class="fas fa-book" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $gurus->currentPage() }}</h3>
                <p style="color: #1B1A55;">Halaman Saat Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $gurus->lastPage() }}</h3>
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
                <h3 class="card-title">Daftar Tenaga Pendidik</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.guru.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Guru
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

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Guru</th>
                            <th>Mata Pelajaran</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gurus as $index => $guru)
                        <tr>
                            <td>{{ $gurus->firstItem() + $index }}</td>
                            <td>{{ $guru->nama_guru }}</td>
                            <td>{{ $guru->mata_pelajaran }}</td>
                            <td>
                                <a href="{{ route('admin.guru.edit', $guru) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.guru.destroy', $guru) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data guru</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
            {{ $gurus->links('vendor.pagination.compact') }}
        </div>
        </div>
    </div>
</div>
@endsection
