@extends('panitia.panitia')

@section('title', 'Dashboard Panitia')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6 mb-3">
        <div class="small-box bg-primary-custom h-100 d-flex flex-column">
            <div class="inner flex-grow-1">
                <h3>{{ $totalPendaftar }}</h3>
                <p>Total Pendaftar</p>
                <small class="text-white-50">{{ $disetujui }} disetujui, {{ $ditolak }} ditolak</small>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('panitia.pendaftaran.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6 mb-3">
        <div class="small-box bg-warning h-100 d-flex flex-column">
            <div class="inner flex-grow-1">
                <h3>{{ $menungguVerifikasi }}</h3>
                <p>Menunggu Verifikasi</p>
                <small>Pendaftaran perlu diproses</small>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
            <a href="{{ route('panitia.pendaftaran.index', ['status' => 'SUBMIT']) }}" class="small-box-footer">
                Proses Sekarang <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6 mb-3">
        <div class="small-box bg-purple-custom h-100 d-flex flex-column">
            <div class="inner flex-grow-1">
                <h3>{{ $totalBerkas }}</h3>
                <p>Total Berkas</p>
                <small class="text-white-50">{{ $berkasValid }} disetujui, {{ $berkasTidakValid }} ditolak/revisi</small>
            </div>
            <div class="icon">
                <i class="fas fa-folder-open"></i>
            </div>
            <a href="{{ route('panitia.berkas.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6 mb-3">
        <div class="small-box bg-danger h-100 d-flex flex-column">
            <div class="inner flex-grow-1">
                <h3>{{ $berkasBelumVerifikasi }}</h3>
                <p>Berkas Belum Diverifikasi</p>
                <small>Perlu verifikasi segera</small>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <a href="{{ route('panitia.berkas.index', ['status_verifikasi' => 'belum']) }}" class="small-box-footer">
                Verifikasi Sekarang <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-line mr-2"></i>Trend Pendaftaran (7 Hari Terakhir)</h3>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="trendChart"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-2"></i>Berkas Per Jenis</h3>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center" style="height: 350px;">
                <canvas id="berkasChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar mr-2"></i>Pendaftaran Per Jurusan</h3>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="jurusanChart"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-layer-group mr-2"></i>Status Per Gelombang</h3>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="gelombangChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-history mr-2"></i>Verifikasi Terbaru</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Pendaftar</th>
                            <th>Jurusan</th>
                            <th>Jenis Berkas</th>
                            <th>Status</th>
                            <th>Verifikator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentVerifikasi as $verif)
                        <tr>
                            <td>{{ $verif->verified_at->diffForHumans() }}</td>
                            <td>{{ $verif->pendaftar->user->nama_lengkap }}</td>
                            <td>{{ $verif->pendaftar->jurusan->nama }}</td>
                            <td>{{ $verif->jenis }}</td>
                            <td>
                                @if($verif->status == 'approved')
                                    <span class="badge badge-success">Disetujui</span>
                                @elseif($verif->status == 'rejected')
                                    <span class="badge badge-danger">Ditolak</span>
                                @elseif($verif->status == 'revision')
                                    <span class="badge badge-warning">Perlu Revisi</span>
                                @endif
                            </td>
                            <td>{{ $verif->verifiedBy->nama_lengkap ?? 'Sistem' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-3">Belum ada verifikasi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Trend Pendaftaran Chart
const trendCtx = document.getElementById('trendChart').getContext('2d');
new Chart(trendCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($trendPendaftaran->pluck('tanggal')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M'))) !!},
        datasets: [{
            label: 'Pendaftar',
            data: {!! json_encode($trendPendaftaran->pluck('total')) !!},
            borderColor: '#4A6FA5',
            backgroundColor: 'rgba(74, 111, 165, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});

// Berkas Chart
const berkasCtx = document.getElementById('berkasChart').getContext('2d');
new Chart(berkasCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($berkasByJenis->pluck('jenis')) !!},
        datasets: [{
            data: {!! json_encode($berkasByJenis->pluck('total')) !!},
            backgroundColor: ['#182233', '#4A6FA5', '#C9D6DF', '#E8EEF2', '#fff']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});

// Jurusan Chart
const jurusanCtx = document.getElementById('jurusanChart').getContext('2d');
new Chart(jurusanCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($pendaftaranPerJurusan->pluck('jurusan.nama')) !!},
        datasets: [{
            label: 'Jumlah Pendaftar',
            data: {!! json_encode($pendaftaranPerJurusan->pluck('total')) !!},
            backgroundColor: '#4A6FA5',
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});

// Status Per Gelombang Chart
const gelombangData = {!! json_encode($statusPerGelombang) !!};
const gelombangLabels = [];
const submitData = [];
const passData = [];
const rejectData = [];

Object.keys(gelombangData).forEach(key => {
    const items = gelombangData[key];
    const gelombangNama = items[0].gelombang.nama;
    gelombangLabels.push(gelombangNama);
    
    submitData.push(items.find(i => i.status === 'SUBMIT')?.total || 0);
    passData.push(items.find(i => i.status === 'ADM_PASS')?.total || 0);
    rejectData.push(items.find(i => i.status === 'ADM_REJECT')?.total || 0);
});

const gelombangCtx = document.getElementById('gelombangChart').getContext('2d');
new Chart(gelombangCtx, {
    type: 'bar',
    data: {
        labels: gelombangLabels,
        datasets: [
            {
                label: 'Menunggu',
                data: submitData,
                backgroundColor: '#C9D6DF'
            },
            {
                label: 'Disetujui',
                data: passData,
                backgroundColor: '#4A6FA5'
            },
            {
                label: 'Ditolak',
                data: rejectData,
                backgroundColor: '#182233'
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: { stacked: true },
            y: { stacked: true, beginAtZero: true }
        }
    }
});
</script>
@endpush
