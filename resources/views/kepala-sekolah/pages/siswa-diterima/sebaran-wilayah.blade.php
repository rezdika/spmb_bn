@extends('kepala-sekolah.kepala-sekolah')

@section('title', 'Sebaran Wilayah')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map { height: 500px; border-radius: 12px; }
    .leaflet-popup-content { font-family: 'Lato', sans-serif; }
    .provinsi-chart-wrap { display: flex; gap: 1rem; align-items: center; }
    .provinsi-chart { flex: 1 1 auto; min-width: 0; }
    .provinsi-legend { flex: 0 0 120px; max-width: 120px; }
    .provinsi-legend ul { list-style: none; padding: 0; margin: 0; }
    .provinsi-legend li { display:flex; align-items:center; gap:.5rem; margin-bottom:.35rem; font-size:.9rem; }
    .provinsi-legend .swatch { width:12px; height:12px; border-radius:3px; border:1px solid rgba(0,0,0,0.06); flex-shrink:0 }
    .provinsi-legend .label-text { display:inline-block; max-width:100px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .card-body { box-sizing: border-box; }
</style>
@endsection

@section('content')
<!-- 4 KPI Cards -->
<div class="row mb-3">
    <div class="col-lg-3 col-6">
        <div class="card" style="border-left: 4px solid #4A70A9;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Provinsi</h6>
                        <h3 class="mb-0">{{ $totalProvinsi }}</h3>
                    </div>
                    <div>
                        <i class="fas fa-map fa-2x" style="color: #4A70A9; opacity: 0.3;"></i>
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
                        <h6 class="text-muted mb-2">Total Kab/Kota</h6>
                        <h3 class="mb-0 text-success">{{ $totalKabupaten }}</h3>
                    </div>
                    <div>
                        <i class="fas fa-map-marked-alt fa-2x text-success" style="opacity: 0.3;"></i>
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
                        <h6 class="text-muted mb-2">Total Siswa</h6>
                        <h3 class="mb-0 text-warning">{{ $totalSiswa }}</h3>
                    </div>
                    <div>
                        <i class="fas fa-users fa-2x text-warning" style="opacity: 0.3;"></i>
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
                        <h6 class="text-muted mb-2">Wilayah Terbanyak</h6>
                        <h3 class="mb-0 text-info">{{ $wilayahTerbanyak ?? 0 }}</h3>
                        <small class="text-muted">{{ $sebaranKabupaten->keys()->first() ? Str::limit($sebaranKabupaten->keys()->first(), 15) : '-' }}</small>
                    </div>
                    <div>
                        <i class="fas fa-trophy fa-2x text-info" style="opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Peta Interaktif -->
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-map-marked-alt mr-2"></i>Peta Sebaran Siswa</h3>
            </div>
            <div class="card-body">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar mr-2"></i>Top 10 Kabupaten/Kota</h3>
            </div>
            <div class="card-body">
                <canvas id="chartKabupaten" height="220"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-2"></i>Sebaran per Provinsi</h3>
            </div>
            <div class="card-body">
                <div class="provinsi-chart-wrap">
                    <div class="provinsi-chart">
                        <canvas id="chartProvinsi" height="220" style="width:100%; display:block;"></canvas>
                    </div>
                    @php $provColors = ['#1B1A55', '#2a2970', '#F5E8C7', '#637AB9', '#9290C3']; @endphp
                    <div class="provinsi-legend">
                        <h6 class="mb-2">Keterangan</h6>
                        <ul>
                            @foreach($sebaranProvinsi as $nama => $total)
                                <li>
                                    <span class="swatch" style="background: {{ $provColors[$loop->index] ?? '#cccccc' }}"></span>
                                    <span class="label-text">{{ Str::limit($nama, 18) }}</span>
                                    <small class="text-muted">({{ $total }})</small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-map-marked-alt mr-2"></i>Data Sebaran Wilayah</h3>
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
                        <th>Provinsi</th>
                        <th>Kabupaten/Kota</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan/desa</th>
                        <th>Nama Siswa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sebaran as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->dataSiswa->village->district->regency->province->name ?? '-' }}</td>
                            <td>{{ $item->dataSiswa->village->district->regency->name ?? '-' }}</td>
                            <td>{{ $item->dataSiswa->village->district->name ?? '-' }}</td>
                            <td>{{ $item->dataSiswa->village->name }}</td>
                            <td>{{ $item->user->nama_lengkap }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Inisialisasi Peta
const map = L.map('map').setView([-2.5, 118], 5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 18
}).addTo(map);

// Data Sebaran untuk Peta
const sebaranData = [
    @foreach($sebaranKabupaten as $nama => $total)
    { name: '{{ $nama }}', count: {{ $total }} },
    @endforeach
];

// Koordinat Kabupaten/Kota di Indonesia (sample)
const koordinat = {
    'Brunei Darussalam': [-4.5353, 114.7277],
    'Bandar Seri Begawan': [-4.9031, 114.9398],
    'Tutong': [-4.8078, 114.6594],
    'Belait': [-4.5833, 114.1833],
    'Temburong': [-4.6167, 115.1667],
    'Jakarta': [-6.2088, 106.8456],
    'Bandung': [-6.9175, 107.6191],
    'Surabaya': [-7.2575, 112.7521],
    'Medan': [3.5952, 98.6722],
    'Semarang': [-6.9667, 110.4167],
    'Makassar': [-5.1477, 119.4327],
    'Palembang': [-2.9761, 104.7754],
    'Tangerang': [-6.1783, 106.6319],
    'Depok': [-6.4025, 106.7942],
    'Bekasi': [-6.2383, 106.9756],
    'Bogor': [-6.5950, 106.7887],
    'Yogyakarta': [-7.7956, 110.3695],
    'Malang': [-7.9797, 112.6304],
    'Denpasar': [-8.6705, 115.2126],
    'Balikpapan': [-1.2379, 116.8529],
    'Pontianak': [-0.0263, 109.3425],
    'Manado': [1.4748, 124.8421],
    'Pekanbaru': [0.5071, 101.4478],
    'Banjarmasin': [-3.3194, 114.5906],
    'Samarinda': [-0.5022, 117.1536],
    'Jambi': [-1.6101, 103.6131],
    'Padang': [-0.9471, 100.4172],
    'Batam': [1.0456, 104.0305],
    'Mataram': [-8.5833, 116.1167],
    'Kupang': [-10.1718, 123.6075]
};

// Tambahkan marker untuk setiap wilayah (circle besar)
sebaranData.forEach(item => {
    const coords = koordinat[item.name];
    if (coords) {
        const marker = L.circleMarker(coords, {
            radius: Math.min(item.count * 3 + 5, 30),
            fillColor: '#4A70A9',
            color: '#fff',
            weight: 2,
            opacity: 1,
            fillOpacity: 0.5
        }).addTo(map);
        
        marker.bindPopup(`<b>${item.name}</b><br>Jumlah Siswa: ${item.count}`);
    }
});

// Data pendaftar individual
const pendaftarData = {!! json_encode($pendaftarData) !!};

// Tambahkan marker untuk setiap pendaftar (titik kecil)
pendaftarData.forEach(pendaftar => {
    // Preferensi: gunakan lat/lng yang tersimpan di dataSiswa (jika tersedia),
    // fallback ke koordinat berdasarkan nama kabupaten apabila tidak ada.
    let coords = null;
    if (pendaftar.lat && pendaftar.lng) {
        coords = [parseFloat(pendaftar.lat), parseFloat(pendaftar.lng)];
    } else {
        coords = koordinat[pendaftar.kabupaten] || null;
    }

    if (coords) {
        // Tambahkan random offset kecil hanya jika menggunakan fallback koordinat kabupaten
        let lat = coords[0];
        let lng = coords[1];
        if (!pendaftar.lat || !pendaftar.lng) {
            const offsetLat = (Math.random() - 0.5) * 0.05;
            const offsetLng = (Math.random() - 0.5) * 0.05;
            lat = lat + offsetLat;
            lng = lng + offsetLng;
        }

        const marker = L.circleMarker([lat, lng], {
            radius: 5,
            fillColor: '#28a745',
            color: '#fff',
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
        }).addTo(map);

        marker.bindPopup(`
            <div style="min-width: 150px;">
                <b>${pendaftar.nama}</b><br>
                <small>Jurusan: ${pendaftar.jurusan}</small><br>
                <small>Asal: ${pendaftar.kabupaten}, ${pendaftar.provinsi}</small>
            </div>
        `);
    }
});


// Chart Kabupaten
const ctxKab = document.getElementById('chartKabupaten').getContext('2d');
new Chart(ctxKab, {
    type: 'bar',
    data: {
        labels: [@foreach($sebaranKabupaten as $nama => $total)'{{ $nama }}',@endforeach],
        datasets: [{
            label: 'Jumlah Siswa',
            data: [@foreach($sebaranKabupaten as $total){{ $total }},@endforeach],
            backgroundColor: '#1B1A55',
            borderColor: '#1B1A55',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});

// Chart Provinsi
const ctxProv = document.getElementById('chartProvinsi').getContext('2d');
new Chart(ctxProv, {
    type: 'doughnut',
    data: {
        labels: [@foreach($sebaranProvinsi as $nama => $total)'{{ $nama }}',@endforeach],
        datasets: [{
            data: [@foreach($sebaranProvinsi as $total){{ $total }},@endforeach],
            backgroundColor: ['#1B1A55', '#2a2970', '#F5E8C7', '#637AB9', '#9290C3'],
            borderWidth: 2,
            borderColor: '#fff'
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
