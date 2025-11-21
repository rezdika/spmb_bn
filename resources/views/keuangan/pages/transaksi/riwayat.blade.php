@extends('keuangan.keuangan')

@section('title', 'Riwayat Transaksi')

@section('content')
<!-- 4 Card Statistik -->
<div class="row mb-3">
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background: linear-gradient(135deg, #1B1A55 0%, #2a2970 100%); color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #F5E8C7;">{{ $stats['total'] ?? 0 }}</h3>
                <p>Total Transaksi</p>
            </div>
            <div class="icon"><i class="fas fa-exchange-alt"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['lunas'] ?? 0 }}</h3>
                <p>Lunas</p>
            </div>
            <div class="icon"><i class="fas fa-check-circle"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $stats['menunggu'] ?? 0 }}</h3>
                <p>Menunggu Verifikasi</p>
            </div>
            <div class="icon"><i class="fas fa-clock"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $stats['belum_bayar'] ?? 0 }}</h3>
                <p>Belum Bayar</p>
            </div>
            <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-history mr-2"></i>Riwayat Transaksi Pembayaran</h3>
    </div>
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama/no pendaftaran..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">Cari</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>No Pendaftaran</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Verifikator</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = ($transaksis->currentPage() - 1) * $transaksis->perPage() + 1; @endphp
                    @forelse($transaksis as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->tgl_verifikasi_payment->format('d/m/Y H:i') }}</td>
                            <td>{{ $item->no_pendaftaran }}</td>
                            <td>{{ $item->user->nama_lengkap }}</td>
                            <td>{{ $item->jurusan->nama }}</td>
                            <td>Rp {{ number_format($item->jumlah_pembayaran, 0, ',', '.') }}</td>
                            <td>
                                @if($item->status_pembayaran == 'lunas')
                                    <span class="badge badge-success">Lunas</span>
                                @else
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>{{ $item->user_verifikasi_payment }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $transaksis->links() }}
        </div>
    </div>
</div>
@endsection
