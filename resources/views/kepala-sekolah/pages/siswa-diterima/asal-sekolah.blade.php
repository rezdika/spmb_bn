@extends('kepala-sekolah.kepala-sekolah')

@section('title', 'Data Asal Sekolah')

@section('content')
<!-- 4 KPI Cards -->
<div class="row mb-3">
    <div class="col-lg-3 col-6">
        <div class="card" style="border-left: 4px solid #4A70A9;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Sekolah</h6>
                        <h3 class="mb-0">{{ $totalSekolah }}</h3>
                    </div>
                    <div>
                        <i class="fas fa-school fa-2x" style="color: #4A70A9; opacity: 0.3;"></i>
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
                        <h6 class="text-muted mb-2">Total Siswa</h6>
                        <h3 class="mb-0 text-success">{{ $totalSiswa }}</h3>
                    </div>
                    <div>
                        <i class="fas fa-users fa-2x text-success" style="opacity: 0.3;"></i>
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
                        <h6 class="text-muted mb-2">Rata-rata/Sekolah</h6>
                        <h3 class="mb-0 text-warning">{{ $rataRata }}</h3>
                    </div>
                    <div>
                        <i class="fas fa-chart-line fa-2x text-warning" style="opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="card" style="border-left: 4px solid #17a2b8;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Terbanyak</h6>
                        <h3 class="mb-0 text-info">{{ $sekolahTerbanyak ? $sekolahTerbanyak->total : 0 }}</h3>
                        <small class="text-muted">{{ $sekolahTerbanyak ? Str::limit($sekolahTerbanyak->asal_sekolah, 15) : '-' }}</small>
                    </div>
                    <div>
                        <i class="fas fa-trophy fa-2x text-info" style="opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar mr-2"></i>Top 10 Sekolah Asal</h3>
            </div>
            <div class="card-body">
                <canvas id="chartSekolah" height="80"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-school mr-2"></i>Data Asal Sekolah Siswa Diterima</h3>
    </div>
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-3">
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
                        <th>Nama Sekolah</th>
                        <th>Jumlah Pendaftar</th>
                        <th>Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $no = ($asalSekolah->currentPage() - 1) * $asalSekolah->perPage() + 1;
                        $totalAll = $asalSekolah->sum('total');
                    @endphp
                    @forelse($asalSekolah as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->asal_sekolah }}</td>
                            <td>{{ $item->total }} siswa</td>
                            <td>{{ $totalAll > 0 ? number_format(($item->total / $totalAll) * 100, 2) : 0 }}%</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $asalSekolah->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartSekolah').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [@foreach($topSekolah as $item)'{{ $item->asal_sekolah }}',@endforeach],
        datasets: [{
            label: 'Jumlah Siswa',
            data: [@foreach($topSekolah as $item){{ $item->total }},@endforeach],
            backgroundColor: '#1B1A55',
            borderColor: '#1B1A55',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});
</script>
@endpush
