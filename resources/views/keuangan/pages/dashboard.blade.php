@extends('keuangan.keuangan')

@section('title', 'Dashboard Keuangan')

@section('content')
<!-- 4 Card Statistik -->
<div class="row">
    <div class="col-lg-3 col-6 mb-3">
        <div class="small-box bg-primary-custom h-100 d-flex flex-column">
            <div class="inner flex-grow-1">
                <h3>{{ $totalPembayaran }}</h3>
                <p>Total Pendaftar Diterima</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="{{ route('keuangan.pembayaran.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-3">
        <div class="small-box bg-gold-custom h-100 d-flex flex-column">
            <div class="inner flex-grow-1">
                <h3>{{ $lunas }}</h3>
                <p>Pembayaran Lunas</p>
            </div>
            <div class="icon"><i class="fas fa-check-circle"></i></div>
            <a href="{{ route('keuangan.transaksi.lunas') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-3">
        <div class="small-box bg-warning h-100 d-flex flex-column">
            <div class="inner flex-grow-1">
                <h3>{{ $menungguVerifikasi }}</h3>
                <p>Menunggu Verifikasi</p>
            </div>
            <div class="icon"><i class="fas fa-clock"></i></div>
            <a href="{{ route('keuangan.pembayaran.index') }}?status_pembayaran=menunggu_verifikasi" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-3">
        <div class="small-box bg-danger h-100 d-flex flex-column">
            <div class="inner flex-grow-1">
                <h3>{{ $belumBayar }}</h3>
                <p>Belum Bayar</p>
            </div>
            <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
           
        </div>
    </div>
</div>

<!-- Total Nominal & Hari Ini -->
<div class="row">
    <div class="col-md-8 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-coins mr-2"></i>Total Nominal Pembayaran</h3>
            </div>
            <div class="card-body text-center d-flex flex-column justify-content-center">
                <h1 style="color: #112D4E; font-size: 3rem; font-weight: bold;">Rp {{ number_format($totalNominal, 0, ',', '.') }}</h1>
                <p class="text-muted">Total pembayaran yang sudah lunas tahun ini</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-calendar-day mr-2"></i>Transaksi Hari Ini</h3>
            </div>
            <div class="card-body text-center d-flex flex-column justify-content-center">
                <h2 style="color: #112D4E;">{{ $hariIni }}</h2>
                <p style="color: #3F72AF;">Transaksi</p>
                <hr>
                <h4 style="color: #112D4E;">Rp {{ number_format($nominalHariIni, 0, ',', '.') }}</h4>
                <small style="color: #3F72AF;">Total Nominal</small>
            </div>
        </div>
    </div>
</div>

<!-- Trend Pembayaran -->
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-area mr-2"></i>Trend Pembayaran Pendaftaran ({{ date('Y') }})</h3>
                <div class="card-tools">
                    <h5 class="mb-0">Total: <span class="text-success">Rp {{ number_format($totalNominal, 0, ',', '.') }}</span></h5>
                </div>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="chartTrendPembayaran"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart Pembayaran per Bulan & per Jurusan -->
<div class="row">
    <div class="col-md-8 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar mr-2"></i>Pembayaran per Bulan ({{ date('Y') }})</h3>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="chartPembayaran"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-2"></i>Pembayaran per Jurusan</h3>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center" style="height: 350px;">
                <canvas id="chartJurusan"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart Trend Pembayaran
const ctxTrend = document.getElementById('chartTrendPembayaran').getContext('2d');
new Chart(ctxTrend, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: 'Pembayaran Lunas',
            data: [
                @for($i = 1; $i <= 12; $i++)
                    {{ $pembayaranPerBulan->where('bulan', $i)->first()->total ?? 0 }},
                @endfor
            ],
            borderColor: '#4A70A9',
            backgroundColor: 'rgba(74, 112, 169, 0.1)',
            tension: 0.4,
            fill: true,
            borderWidth: 3,
            pointRadius: 5,
            pointHoverRadius: 7
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

// Chart Pembayaran per Bulan
const ctxPembayaran = document.getElementById('chartPembayaran').getContext('2d');
const chartPembayaran = new Chart(ctxPembayaran, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: 'Jumlah Transaksi',
            data: [
                @for($i = 1; $i <= 12; $i++)
                    {{ $pembayaranPerBulan->where('bulan', $i)->first()->total ?? 0 }},
                @endfor
            ],
            backgroundColor: '#4A70A9',
            borderColor: '#182233',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        }
    }
});

// Chart per Jurusan
const ctxJurusan = document.getElementById('chartJurusan').getContext('2d');
const chartJurusan = new Chart(ctxJurusan, {
    type: 'doughnut',
    data: {
        labels: [@foreach($pembayaranPerJurusan as $item)'{{ $item->jurusan->nama }}',@endforeach],
        datasets: [{
            data: [@foreach($pembayaranPerJurusan as $item){{ $item->total }},@endforeach],
            backgroundColor: [
                '#182233',
                '#4A70A9',
                '#C9D6DF',
                '#E8EEF2',
                '#3F72AF',
                '#112D4E'
            ],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endpush
