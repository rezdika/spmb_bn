@extends('panitia.panitia')

@section('title', 'Riwayat Verifikasi')

@section('content')
<div class="row mb-3">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary-custom">
            <div class="inner">
                <h3>{{ $totalVerifikasi }}</h3>
                <p>Total Verifikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $disetujui }}</h3>
                <p>Disetujui</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $ditolak }}</h3>
                <p>Ditolak</p>
            </div>
            <div class="icon">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $revisi }}</h3>
                <p>Perlu Revisi</p>
            </div>
            <div class="icon">
                <i class="fas fa-edit"></i>
            </div>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $hariIni }}</h3>
                <p>Verifikasi Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-day"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-history mr-2"></i>Riwayat Verifikasi</h3>
    </div>
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari pendaftar/verifikator..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        <option value="revision" {{ request('status') == 'revision' ? 'selected' : '' }}>Perlu Revisi</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="tanggal_dari" class="form-control" value="{{ request('tanggal_dari') }}" placeholder="Dari Tanggal">
                </div>
                <div class="col-md-2">
                    <input type="date" name="tanggal_sampai" class="form-control" value="{{ request('tanggal_sampai') }}" placeholder="Sampai Tanggal">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('panitia.riwayat.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <div class="timeline">
            @forelse($riwayat as $item)
            <div>
                <i class="fas 
                    @if($item->status == 'approved') fa-check-circle bg-success
                    @elseif($item->status == 'rejected') fa-times-circle bg-danger
                    @elseif($item->status == 'revision') fa-edit bg-warning
                    @else fa-clock bg-secondary
                    @endif"></i>
                <div class="timeline-item">
                    <span class="time">
                        <i class="fas fa-clock"></i> {{ $item->verified_at->diffForHumans() }}
                        <small class="text-muted">({{ $item->verified_at->format('d/m/Y H:i') }})</small>
                    </span>
                    <h3 class="timeline-header">
                        @if($item->status == 'approved')
                            <span class="badge badge-success">DISETUJUI</span>
                        @elseif($item->status == 'rejected')
                            <span class="badge badge-danger">DITOLAK</span>
                        @elseif($item->status == 'revision')
                            <span class="badge badge-warning">PERLU REVISI</span>
                        @endif
                        <strong>{{ $item->pendaftar->user->nama_lengkap }}</strong>
                        <small class="text-muted">- {{ $item->jenis }}</small>
                    </h3>
                    <div class="timeline-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>No Pendaftaran:</strong> {{ $item->pendaftar->no_pendaftaran }}</p>
                                <p class="mb-1"><strong>Jurusan:</strong> {{ $item->pendaftar->jurusan->nama }}</p>
                                <p class="mb-1"><strong>Gelombang:</strong> {{ $item->pendaftar->gelombang->nama }}</p>
                                <p class="mb-1"><strong>Jenis Berkas:</strong> {{ $item->jenis }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Diverifikasi oleh:</strong> {{ $item->verifiedBy->nama_lengkap ?? 'Sistem' }}</p>
                                @if($item->catatan_panitia)
                                <p class="mb-1"><strong>Catatan:</strong></p>
                                <div class="alert alert-info mb-0">{{ $item->catatan_panitia }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="timeline-footer">
                        <a href="{{ route('panitia.pendaftaran.show', $item->pendaftar->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div>
                <i class="fas fa-info-circle bg-secondary"></i>
                <div class="timeline-item">
                    <div class="timeline-body">
                        <p class="text-center mb-0">Belum ada riwayat verifikasi</p>
                    </div>
                </div>
            </div>
            @endforelse
            
            <div>
                <i class="fas fa-clock bg-gray"></i>
            </div>
        </div>

        <div class="mt-3">
            {{ $riwayat->links() }}
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    margin: 0 0 30px 0;
    padding: 0;
    list-style: none;
}
.timeline:before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    width: 4px;
    background: #ddd;
    left: 31px;
    margin: 0;
}
.timeline > div {
    margin-bottom: 15px;
    position: relative;
}
.timeline > div > .timeline-item {
    margin-left: 60px;
    margin-right: 15px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 0;
    position: relative;
}
.timeline > div > .fas {
    width: 30px;
    height: 30px;
    font-size: 15px;
    line-height: 30px;
    position: absolute;
    color: #fff;
    background: #999;
    border-radius: 50%;
    text-align: center;
    left: 18px;
    top: 0;
}
.timeline-header {
    margin: 0;
    padding: 10px 15px;
    font-size: 16px;
    border-bottom: 1px solid #ddd;
}
.timeline-body {
    padding: 15px;
}
.timeline-footer {
    padding: 10px 15px;
    background: #f8f9fa;
    border-top: 1px solid #ddd;
}
.time {
    display: block;
    padding: 5px 15px;
    font-size: 13px;
    color: #999;
}
</style>
@endpush
