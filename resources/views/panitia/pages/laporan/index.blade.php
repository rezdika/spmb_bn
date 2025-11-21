@extends('panitia.panitia')

@section('title', 'Laporan Verifikasi')

@section('content')
<div class="row mb-3">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalVerifikasi }}</h3>
                <p>Total Verifikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-double"></i>
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
                <h3>{{ $berkasVerifikasi }}</h3>
                <p>Perlu Revisi</p>
            </div>
            <div class="icon">
                <i class="fas fa-edit"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-chart-bar mr-2"></i>Laporan Verifikasi</h3>
    </div>
    <div class="card-body">
        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Periode</label>
                    <select name="periode" class="form-control">
                        <option value="harian" {{ $periode == 'harian' ? 'selected' : '' }}>Harian</option>
                        <option value="mingguan" {{ $periode == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                        <option value="bulanan" {{ $periode == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}">
                </div>
                <div class="col-md-3">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block">Tampilkan</button>
                </div>
                <div class="col-md-3">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-success btn-block" onclick="exportExcel()">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Verifikasi Per Hari</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chartPerHari" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Verifikasi Per Verifikator</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chartPerVerifikator" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Verifikasi</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Pendaftar</th>
                            <th>Jurusan</th>
                            <th>Jenis Berkas</th>
                            <th>Status</th>
                            <th>Verifikator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($detailVerifikasi as $item)
                        <tr>
                            <td>{{ $item->verified_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $item->pendaftar->user->nama_lengkap }}</td>
                            <td>{{ $item->pendaftar->jurusan->nama }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>
                                @if($item->status == 'approved')
                                    <span class="badge badge-success">Disetujui</span>
                                @elseif($item->status == 'rejected')
                                    <span class="badge badge-danger">Ditolak</span>
                                @elseif($item->status == 'revision')
                                    <span class="badge badge-warning">Perlu Revisi</span>
                                @endif
                            </td>
                            <td>{{ $item->verifiedBy->nama_lengkap ?? 'Sistem' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
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
function exportExcel() {
    const periode = document.querySelector('select[name="periode"]').value;
    const tanggal = document.querySelector('input[name="tanggal"]').value;
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route('panitia.laporan.export') }}';
    
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = '{{ csrf_token() }}';
    form.appendChild(csrfInput);
    
    const periodeInput = document.createElement('input');
    periodeInput.type = 'hidden';
    periodeInput.name = 'periode';
    periodeInput.value = periode;
    form.appendChild(periodeInput);
    
    const tanggalInput = document.createElement('input');
    tanggalInput.type = 'hidden';
    tanggalInput.name = 'tanggal';
    tanggalInput.value = tanggal;
    form.appendChild(tanggalInput);
    
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}

// Chart Per Hari
const ctxHari = document.getElementById('chartPerHari').getContext('2d');
new Chart(ctxHari, {
    type: 'line',
    data: {
        labels: {!! json_encode($verifikasiPerHari->pluck('tanggal')) !!},
        datasets: [{
            label: 'Jumlah Verifikasi',
            data: {!! json_encode($verifikasiPerHari->pluck('total')) !!},
            borderColor: '#1B1A55',
            backgroundColor: 'rgba(27, 26, 85, 0.1)',
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Chart Per Verifikator
const ctxVerifikator = document.getElementById('chartPerVerifikator').getContext('2d');
new Chart(ctxVerifikator, {
    type: 'bar',
    data: {
        labels: {!! json_encode($verifikasiPerVerifikator->pluck('verifikator')) !!},
        datasets: [{
            label: 'Jumlah Verifikasi',
            data: {!! json_encode($verifikasiPerVerifikator->pluck('total')) !!},
            backgroundColor: '#9290C3'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endpush
