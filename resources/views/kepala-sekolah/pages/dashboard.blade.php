@extends('kepala-sekolah.kepala-sekolah')

@section('title', 'Dashboard')

@push('styles')
<style>
    .wilayah-legend {
        width: 180px;
    }
    .wilayah-legend h6 {
        margin-bottom: .4rem;
        font-size: .95rem;
    }
    .wilayah-legend ul { padding: 0; margin: 0; }
    .wilayah-legend ul li {
        display: flex;
        align-items: center;
        gap: .5rem;
        margin-bottom: .35rem;
        font-size: .9rem;
        color: #212529;
    }
    .wilayah-legend .swatch {
        width: 14px;
        height: 14px;
        border-radius: 3px;
        border: 1px solid rgba(0,0,0,0.08);
        flex-shrink: 0;
    }
    .wilayah-legend .label-text { line-height: 1; }

    /* responsive: legend below chart on small screens */
    @media (max-width: 575.98px) {
        .wilayah-chart-wrap { flex-direction: column; align-items: stretch; }
        .wilayah-legend { width: 100%; margin-top: .75rem; }
    }
</style>
@endpush

@section('content')
<!-- 4 KPI Cards -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="card" style="border-top: 3px solid #1B1A55;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Siswa Diterima vs Kuota</h6>
                        <h3 class="mb-0">{{ $totalDiterima }} / {{ $totalKuota }}</h3>
                        <small class="text-muted">{{ $persenKuota }}% terisi</small>
                    </div>
                    <div class="text-right">
                        <i class="fas fa-users fa-2x" style="color: #1B1A55; opacity: 0.3;"></i>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 8px;">
                    <div class="progress-bar" style="width: {{ $persenKuota }}%; background: {{ $persenKuota >= 80 ? '#28a745' : ($persenKuota >= 50 ? '#ffc107' : '#dc3545') }};"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="card" style="border-top: 3px solid #28a745;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Rasio Terverifikasi</h6>
                        <h3 class="mb-0">{{ $persenVerifikasi }}%</h3>
                        <small class="text-muted">{{ $terverifikasi }} dari {{ $totalDiterima }}</small>
                    </div>
                    <div class="text-right">
                        <i class="fas fa-check-circle fa-2x text-success" style="opacity: 0.3;"></i>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 8px;">
                    <div class="progress-bar bg-success" style="width: {{ $persenVerifikasi }}%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="card" style="border-top: 3px solid {{ $trenSelisih >= 0 ? '#17a2b8' : '#dc3545' }};">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Tren Hari Ini</h6>
                        <h3 class="mb-0">{{ $pendaftarHariIni }}</h3>
                        <small class="{{ $trenSelisih >= 0 ? 'text-info' : 'text-danger' }}">
                            <i class="fas fa-{{ $trenSelisih >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                            {{ abs($trenSelisih) }} vs kemarin
                        </small>
                    </div>
                    <div class="text-right">
                        <i class="fas fa-chart-line fa-2x" style="color: {{ $trenSelisih >= 0 ? '#17a2b8' : '#dc3545' }}; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="card" style="border-top: 3px solid #ffc107;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Pembayaran Lunas</h6>
                        <h3 class="mb-0">{{ $persenLunas }}%</h3>
                        <small class="text-muted">{{ $lunas }} dari {{ $diterima }} diterima</small>
                    </div>
                    <div class="text-right">
                        <i class="fas fa-money-bill-wave fa-2x text-warning" style="opacity: 0.3;"></i>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 8px;">
                    <div class="progress-bar bg-warning" style="width: {{ $persenLunas }}%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- KPI Detail Section -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-line mr-2"></i>Tren 7 Hari Terakhir</h3>
            </div>
            <div class="card-body">
                <canvas id="chartTren7Hari" height="60"></canvas>
                <div class="text-center mt-2">
                    <small class="text-muted">Rata-rata: <strong>{{ $rataRataHarian }}</strong> pendaftar/hari</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-school mr-2"></i>Top 5 Asal Sekolah</h3>
            </div>
            <div class="card-body">
                <canvas id="chartAsalSekolah" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-map-marked-alt mr-2"></i>Top 5 Wilayah</h3>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center wilayah-chart-wrap" style="gap:1.5rem;">
                    <div style="flex:1;">
                        <canvas id="chartWilayah" height="200"></canvas>
                    </div>
                    @php
                        $wilayahColors = ['#1B1A55', '#28a745', '#ffc107', '#dc3545', '#17a2b8'];
                    @endphp
                    <div class="wilayah-legend">
                        <h6 class="mb-2">Keterangan</h6>
                        <ul class="list-unstyled mb-0">
                            @foreach($topWilayah as $i => $item)
                                <li>
                                    <span class="swatch" style="background: {{ $wilayahColors[$i] ?? '#cccccc' }};"></span>
                                    <small class="label-text">{{ $item->regency_name }} <span class="text-muted">({{ $item->total }})</span></small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail per Jurusan -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-table mr-2"></i>Detail per Jurusan</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead style="background: #f8f9fa;">
                        <tr>
                            <th>Jurusan</th>
                            <th class="text-center">Kuota</th>
                            <th class="text-center">Diterima</th>
                            <th class="text-center">%</th>
                            <th class="text-center">Sisa Kuota</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detailJurusan as $jurusan)
                            <tr>
                                <td><strong>{{ $jurusan->nama }}</strong></td>
                                <td class="text-center">{{ $jurusan->kuota }}</td>
                                <td class="text-center">{{ $jurusan->diterima_count }}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $jurusan->persen >= 80 ? 'success' : ($jurusan->persen >= 50 ? 'warning' : 'danger') }}">
                                        {{ $jurusan->persen }}%
                                    </span>
                                </td>
                                <td class="text-center">{{ $jurusan->sisa_kuota }}</td>
                                <td class="text-center">
                                    @if($jurusan->persen >= 80)
                                        <i class="fas fa-circle text-success"></i>
                                    @elseif($jurusan->persen >= 50)
                                        <i class="fas fa-circle text-warning"></i>
                                    @else
                                        <i class="fas fa-circle text-danger"></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Pendaftar Terbaru -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list mr-2"></i>10 Pendaftar Terbaru</h3>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No Pendaftaran</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswaTerbaru as $item)
                            <tr>
                                <td>{{ $item->no_pendaftaran }}</td>
                                <td>{{ $item->user->nama_lengkap }}</td>
                                <td>{{ $item->jurusan->nama }}</td>
                                <td>
                                    @if($item->status == 'ADM_PASS')
                                        <span class="badge badge-success">Diterima</span>
                                    @elseif($item->status == 'ADM_REJECT')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @else
                                        <span class="badge badge-secondary">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
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
// Chart Tren 7 Hari
const ctxTren = document.getElementById('chartTren7Hari').getContext('2d');
new Chart(ctxTren, {
    type: 'line',
    data: {
        labels: [@foreach($tren7Hari as $item)'{{ $item['tanggal'] }}',@endforeach],
        datasets: [{
            label: 'Pendaftar',
            data: [@foreach($tren7Hari as $item){{ $item['jumlah'] }},@endforeach],
            backgroundColor: 'rgba(27, 26, 85, 0.1)',
            borderColor: '#1B1A55',
            borderWidth: 2,
            tension: 0.4,
            fill: true,
            pointRadius: 4,
            pointBackgroundColor: '#1B1A55'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});

// Chart Asal Sekolah
const ctxSekolah = document.getElementById('chartAsalSekolah').getContext('2d');
new Chart(ctxSekolah, {
    type: 'bar',
    data: {
        labels: [@foreach($topAsalSekolah as $item)'{{ Str::limit($item->nama_sekolah, 20) }}',@endforeach],
        datasets: [{
            label: 'Jumlah',
            data: [@foreach($topAsalSekolah as $item){{ $item->total }},@endforeach],
            backgroundColor: '#17a2b8',
            borderRadius: 5
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            x: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});

// Chart Wilayah
const ctxWilayah = document.getElementById('chartWilayah').getContext('2d');
new Chart(ctxWilayah, {
    type: 'doughnut',
    data: {
        labels: [@foreach($topWilayah as $item)'{{ $item->regency_name }}',@endforeach],
        datasets: [{
            data: [@foreach($topWilayah as $item){{ $item->total }},@endforeach],
            backgroundColor: ['#1B1A55', '#28a745', '#ffc107', '#dc3545', '#17a2b8'],
            borderWidth: 2,
            borderColor: '#fff',
            cutout: '60%'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.parsed;
                    }
                }
            }
        }
    }
});
</script>
@endpush
