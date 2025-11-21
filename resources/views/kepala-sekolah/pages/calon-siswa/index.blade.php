@extends('kepala-sekolah.kepala-sekolah')

@section('title', 'Daftar Calon Siswa')

@section('content')
<!-- 4 KPI Cards -->
<div class="row mb-3">
    <div class="col-lg-3 col-6">
        <div class="card" style="border-left: 4px solid #4A70A9;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Pendaftar</h6>
                        <h3 class="mb-0">{{ $totalPendaftar }}</h3>
                    </div>
                    <div>
                        <i class="fas fa-users fa-2x" style="color: #4A70A9; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="card" style="border-left: 4px solid #28a745;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Diterima</h6>
                        <h3 class="mb-0 text-success">{{ $totalDiterima }}</h3>
                    </div>
                    <div>
                        <i class="fas fa-check-circle fa-2x text-success" style="opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="card" style="border-left: 4px solid #ffc107;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Menunggu</h6>
                        <h3 class="mb-0 text-warning">{{ $totalMenunggu }}</h3>
                    </div>
                    <div>
                        <i class="fas fa-clock fa-2x text-warning" style="opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="card" style="border-left: 4px solid #dc3545;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Ditolak</h6>
                        <h3 class="mb-0 text-danger">{{ $totalDitolak }}</h3>
                    </div>
                    <div>
                        <i class="fas fa-times-circle fa-2x text-danger" style="opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-users mr-2"></i>Daftar Calon Siswa</h3>
    </div>
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="DRAFT" {{ request('status') == 'DRAFT' ? 'selected' : '' }}>Draft</option>
                        <option value="SUBMIT" {{ request('status') == 'SUBMIT' ? 'selected' : '' }}>Submit</option>
                        <option value="ADM_PASS" {{ request('status') == 'ADM_PASS' ? 'selected' : '' }}>Diterima</option>
                        <option value="ADM_REJECT" {{ request('status') == 'ADM_REJECT' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="jurusan_id" class="form-control">
                        <option value="">Semua Jurusan</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ request('jurusan_id') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pendaftaran</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Status Verifikasi</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = ($calonSiswa->currentPage() - 1) * $calonSiswa->perPage() + 1; @endphp
                    @forelse($calonSiswa as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->no_pendaftaran }}</td>
                            <td>{{ $item->user->nama_lengkap }}</td>
                            <td>{{ $item->jurusan->nama }}</td>
                            <td>
                                @if($item->status == 'ADM_PASS')
                                    <span class="badge badge-success">Diterima</span>
                                @elseif($item->status == 'ADM_REJECT')
                                    <span class="badge badge-danger">Ditolak</span>
                                @elseif($item->status == 'SUBMIT')
                                    <span class="badge badge-info">Submit</span>
                                @else
                                    <span class="badge badge-secondary">Draft</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status_pembayaran == 'lunas')
                                    <span class="badge badge-success">Lunas</span>
                                @elseif($item->status_pembayaran == 'menunggu_verifikasi')
                                    <span class="badge badge-warning">Menunggu</span>
                                @else
                                    <span class="badge badge-secondary">Belum Bayar</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('kepala-sekolah.calon-siswa.show', $item->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $calonSiswa->links() }}
        </div>
    </div>
</div>
@endsection
