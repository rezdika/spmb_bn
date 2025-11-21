@extends('admin.admin')

@section('title', 'Peta Sebaran Pendaftar')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
<style>
    #map { height: 600px; border-radius: 8px; }
    .leaflet-popup-content { min-width: 200px; }
    .marker-cluster-small { background-color: rgba(27, 26, 85, 0.6); }
    .marker-cluster-small div { background-color: rgba(27, 26, 85, 0.8); }
    .marker-cluster-medium { background-color: rgba(146, 144, 195, 0.6); }
    .marker-cluster-medium div { background-color: rgba(146, 144, 195, 0.8); }
    .marker-cluster-large { background-color: rgba(220, 53, 69, 0.6); }
    .marker-cluster-large div { background-color: rgba(220, 53, 69, 0.8); }
</style>
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-map-marked-alt mr-2"></i>Filter Peta</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label>Jurusan</label>
                        <select id="filterJurusan" class="form-control">
                            <option value="">Semua Jurusan</option>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Gelombang</label>
                        <select id="filterGelombang" class="form-control">
                            <option value="">Semua Gelombang</option>
                            @foreach($gelombangs as $gelombang)
                                <option value="{{ $gelombang->id }}">{{ $gelombang->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Status</label>
                        <select id="filterStatus" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="SUBMIT">Menunggu</option>
                            <option value="ADM_PASS">Disetujui</option>
                            <option value="ADM_REJECT">Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-primary btn-block" onclick="loadMarkers()">
                            <i class="fas fa-sync"></i> Terapkan Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-globe mr-2"></i>Peta Sebaran Pendaftar</h3>
                <div class="card-tools">
                    <span class="badge badge-primary" id="totalMarkers">{{ $totalPendaftar }} Pendaftar</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="map"></div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-2"></i>Sebaran Per Jurusan</h3>
            </div>
            <div class="card-body">
                <canvas id="jurusanChart" height="200"></canvas>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-map-marker-alt mr-2"></i>Top 5 Provinsi</h3>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @foreach($sebaranPerProvinsi as $provinsi => $total)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $provinsi }}
                        <span class="badge badge-primary badge-pill">{{ $total }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let map, markers;

// Initialize map
map = L.map('map').setView([-6.2088, 106.8456], 5); // Indonesia center

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 18
}).addTo(map);

markers = L.markerClusterGroup();

// Marker colors by jurusan
const jurusanColors = {!! json_encode($jurusans->pluck('id')->mapWithKeys(function($id, $index) {
    $colors = ['#1B1A55', '#9290C3', '#535C91', '#070F2B', '#FF6B6B', '#4ECDC4'];
    return [$id => $colors[$index % count($colors)]];
})) !!};

function getMarkerIcon(jurusanId, status) {
    const color = jurusanColors[jurusanId] || '#1B1A55';
    const iconHtml = status === 'ADM_PASS' ? '✓' : (status === 'ADM_REJECT' ? '✗' : '●');
    
    return L.divIcon({
        className: 'custom-marker',
        html: `<div style="background-color: ${color}; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; border: 2px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);">${iconHtml}</div>`,
        iconSize: [30, 30],
        iconAnchor: [15, 15]
    });
}

function loadMarkers() {
    const jurusan = $('#filterJurusan').val();
    const gelombang = $('#filterGelombang').val();
    const status = $('#filterStatus').val();
    
    $.ajax({
        url: '{{ route('admin.peta-sebaran.data') }}',
        data: { jurusan_id: jurusan, gelombang_id: gelombang, status: status },
        success: function(data) {
            markers.clearLayers();
            
            data.forEach(item => {
                const marker = L.marker([item.lat, item.lng], {
                    icon: getMarkerIcon(item.jurusan_id, item.status)
                });
                
                const statusBadge = item.status === 'ADM_PASS' ? '<span class="badge badge-success">Disetujui</span>' :
                                   (item.status === 'ADM_REJECT' ? '<span class="badge badge-danger">Ditolak</span>' :
                                   '<span class="badge badge-warning">Menunggu</span>');
                
                marker.bindPopup(`
                    <div style="min-width: 200px;">
                        <h6 class="mb-2"><strong>${item.nama}</strong></h6>
                        <p class="mb-1"><small><strong>No:</strong> ${item.no_pendaftaran}</small></p>
                        <p class="mb-1"><small><strong>Jurusan:</strong> ${item.jurusan}</small></p>
                        <p class="mb-1"><small><strong>Gelombang:</strong> ${item.gelombang}</small></p>
                        <p class="mb-2"><small><strong>Status:</strong> ${statusBadge}</small></p>
                        <p class="mb-0"><small><i class="fas fa-map-marker-alt"></i> ${item.alamat}</small></p>
                    </div>
                `);
                
                markers.addLayer(marker);
            });
            
            map.addLayer(markers);
            $('#totalMarkers').text(data.length + ' Pendaftar');
            
            if (data.length > 0) {
                map.fitBounds(markers.getBounds());
            }
        }
    });
}

// Chart Jurusan
const jurusanCtx = document.getElementById('jurusanChart').getContext('2d');
new Chart(jurusanCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($sebaranPerJurusan->pluck('jurusan.nama')) !!},
        datasets: [{
            data: {!! json_encode($sebaranPerJurusan->pluck('total')) !!},
            backgroundColor: ['#1B1A55', '#9290C3', '#535C91', '#070F2B', '#FF6B6B', '#4ECDC4']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 10 } } }
        }
    }
});

// Load initial markers
loadMarkers();
</script>
@endpush
