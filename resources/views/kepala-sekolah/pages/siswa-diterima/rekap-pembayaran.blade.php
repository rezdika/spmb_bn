@extends('kepala-sekolah.kepala-sekolah')

@section('title', 'Rekap Pembayaran')

@section('content')
<!-- 4 KPI Cards -->
<div class="row mb-3">
    <div class="col-lg-3 col-6">
        <div class="card" style="border-left: 4px solid #4A70A9;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Diterima</h6>
                        <h3 class="mb-0">{{ $totalDiterima }}</h3>
                    </div>
                    <div>
                        <i class="fas fa-user-graduate fa-2x" style="color: #4A70A9; opacity: 0.3;"></i>
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
                        <h6 class="text-muted mb-2">Lunas</h6>
                        <h3 class="mb-0 text-success">{{ $totalLunas }}</h3>
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
                        <h6 class="text-muted mb-2">Belum Bayar</h6>
                        <h3 class="mb-0 text-danger">{{ $totalBelumBayar }}</h3>
                    </div>
                    <div>
                        <i class="fas fa-exclamation-circle fa-2x text-danger" style="opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-money-bill-wave mr-2"></i>Rekap Pembayaran Siswa Diterima</h3>
    </div>
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-2">
                    <select name="status_pembayaran" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="lunas" {{ request('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="menunggu_verifikasi" {{ request('status_pembayaran') == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu</option>
                        <option value="belum_bayar" {{ request('status_pembayaran') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
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
                    <input type="date" name="tanggal_dari" class="form-control" value="{{ request('tanggal_dari') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" name="tanggal_sampai" class="form-control" value="{{ request('tanggal_sampai') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                </div>
            </div>
        </form>

        <div class="alert alert-info">
            <strong>Total Nominal Lunas:</strong> Rp {{ number_format($totalNominal, 0, ',', '.') }}
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pendaftaran</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tgl Verifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = ($pembayarans->currentPage() - 1) * $pembayarans->perPage() + 1; @endphp
                    @forelse($pembayarans as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->no_pendaftaran }}</td>
                            <td>{{ $item->user->nama_lengkap }}</td>
                            <td>{{ $item->jurusan->nama }}</td>
                            <td>Rp {{ number_format($item->jumlah_pembayaran, 0, ',', '.') }}</td>
                            <td>
                                @if($item->status_pembayaran == 'lunas')
                                    <span class="badge badge-success">Lunas</span>
                                @elseif($item->status_pembayaran == 'menunggu_verifikasi')
                                    <span class="badge badge-warning">Menunggu</span>
                                @else
                                    <span class="badge badge-secondary">Belum Bayar</span>
                                @endif
                            </td>
                            <td>{{ $item->tgl_verifikasi_payment ? $item->tgl_verifikasi_payment->format('d/m/Y') : '-' }}</td>
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
            {{ $pembayarans->links() }}
        </div>
    </div>
</div>
@endsection
