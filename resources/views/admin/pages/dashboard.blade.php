@extends('admin.admin')

@section('title', 'Dashboard Admin')

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7; color: white;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $stats['total_users'] }}</h3>
                <p style="color: #1B1A55;">Total Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users" style="color: #1B1A55;"></i>
            </div>
            <a href="{{ route('admin.user.index') }}" class="small-box-footer" style="background-color: #1B1A55; color: white;">Kelola Users <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7; color: white;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $stats['total_jurusan'] }}</h3>
                <p style="color: #1B1A55;">Total Jurusan</p>
            </div>
            <div class="icon">
                <i class="fas fa-graduation-cap" style="color: #1B1A55;"></i>
            </div>
            <a href="{{ route('admin.jurusan.index') }}" class="small-box-footer" style="background-color: #1B1A55; color: white;">Kelola Jurusan <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7; color: white;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $stats['total_gelombang'] }}</h3>
                <p style="color: #1B1A55;">Total Gelombang</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt" style="color: #1B1A55;"></i>
            </div>
            <a href="{{ route('admin.gelombang.index') }}" class="small-box-footer" style="background-color: #1B1A55; color: white;">Kelola Gelombang <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7; color: white;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $stats['total_pendaftaran'] }}</h3>
                <p style="color: #1B1A55;">Total Pendaftaran</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt" style="color: #1B1A55;"></i>
            </div>
            <a href="#" class="small-box-footer" style="background-color: #1B1A55; color: white;">Lihat Pendaftaran <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="row mb-4">
    <!-- User Role Distribution Chart -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-2"></i>Distribusi Role User</h3>
            </div>
            <div class="card-body">
                <canvas id="userRoleChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Jurusan Status Chart -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar mr-2"></i>Status Jurusan</h3>
            </div>
            <div class="card-body">
                <canvas id="jurusanStatusChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <!-- Gelombang Timeline Chart -->
    <div class="col-lg-8 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-line mr-2"></i>Timeline Gelombang Pendaftaran</h3>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="gelombangTimelineChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Data Master Summary -->
    <div class="col-lg-4 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-database mr-2"></i>Ringkasan Data Master</h3>
            </div>
            <div class="card-body">
                <div class="progress-group">
                    <span class="progress-text">Users Aktif</span>
                    <span class="float-right"><b>{{ App\Models\User::count() }}</b>/1000</span>
                    <div class="progress progress-sm">
                        <div class="progress-bar" style="background-color: #1B1A55; width: {{ (App\Models\User::count()/1000)*100 }}%"></div>
                    </div>
                </div>
                <div class="progress-group">
                    <span class="progress-text">Jurusan Aktif</span>
                    <span class="float-right"><b>{{ App\Models\Jurusan::where('is_active', true)->count() }}</b>/{{ App\Models\Jurusan::count() }}</span>
                    <div class="progress progress-sm">
                        <div class="progress-bar" style="background-color: #1B1A55; width: {{ App\Models\Jurusan::count() > 0 ? (App\Models\Jurusan::where('is_active', true)->count()/App\Models\Jurusan::count())*100 : 0 }}%"></div>
                    </div>
                </div>
                <div class="progress-group">
                    <span class="progress-text">Gelombang Aktif</span>
                    <span class="float-right"><b>{{ App\Models\Gelombang::where('status', 'aktif')->count() }}</b>/{{ App\Models\Gelombang::count() }}</span>
                    <div class="progress progress-sm">
                        <div class="progress-bar" style="background-color: #1B1A55; width: {{ App\Models\Gelombang::count() > 0 ? (App\Models\Gelombang::where('status', 'aktif')->count()/App\Models\Gelombang::count())*100 : 0 }}%"></div>
                    </div>
                </div>
                <div class="progress-group">
                    <span class="progress-text">Provinsi Terdaftar</span>
                    <span class="float-right"><b>{{ App\Models\Province::count() }}</b></span>
                    <div class="progress progress-sm">
                        <div class="progress-bar" style="background-color: #1B1A55; width: 85%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Real-time Notifications -->
@php
    $todayUsers = App\Models\User::whereDate('created_at', today())->count();
    $inactiveJurusan = App\Models\Jurusan::where('is_active', false)->count();
    $expiredGelombang = App\Models\Gelombang::where('tgl_selesai', '<', now())->where('status', 'aktif')->count();
    $pendingPendaftaran = App\Models\Pendaftaran::where('status', 'pending')->count();
@endphp

@if($todayUsers > 0 || $inactiveJurusan > 0 || $expiredGelombang > 0 || $pendingPendaftaran > 0)
<div class="row mb-4">
    <div class="col-12">
        <div class="alert" style="background-color: #F5E8C7; border-color: #1B1A55; color: #1B1A55;">
            <h5><i class="fas fa-bell mr-2"></i>Notifikasi Sistem</h5>
            <ul class="mb-0">
                @if($todayUsers > 0)
                    <li>{{ $todayUsers }} user baru terdaftar hari ini</li>
                @endif
                @if($inactiveJurusan > 0)
                    <li>{{ $inactiveJurusan }} jurusan dalam status non-aktif</li>
                @endif
                @if($expiredGelombang > 0)
                    <li>{{ $expiredGelombang }} gelombang sudah berakhir tapi masih aktif</li>
                @endif
                @if($pendingPendaftaran > 0)
                    <li>{{ $pendingPendaftaran }} pendaftaran menunggu verifikasi</li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endif

<!-- Quick Actions Cards -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="info-box">
            <span class="info-box-icon" style="background-color: #1B1A55; color: white;"><i class="fas fa-user-plus"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Tambah User</span>
                <span class="info-box-number">{{ App\Models\User::whereDate('created_at', today())->count() }} hari ini</span>
                <a href="{{ route('admin.user.create') }}" class="btn btn-sm mt-2" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">Tambah Baru</a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="info-box">
            <span class="info-box-icon" style="background-color: #1B1A55; color: white;"><i class="fas fa-graduation-cap"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Kelola Jurusan</span>
                <span class="info-box-number">{{ App\Models\Jurusan::where('is_active', true)->count() }} aktif</span>
                <a href="{{ route('admin.jurusan.index') }}" class="btn btn-sm mt-2" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">Kelola</a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="info-box">
            <span class="info-box-icon" style="background-color: #1B1A55; color: white;"><i class="fas fa-calendar-plus"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Buat Gelombang</span>
                <span class="info-box-number">{{ App\Models\Gelombang::where('status', 'aktif')->count() }} berjalan</span>
                <a href="{{ route('admin.gelombang.create') }}" class="btn btn-sm mt-2" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">Buat Baru</a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="info-box">
            <span class="info-box-icon" style="background-color: #1B1A55; color: white;"><i class="fas fa-map-marker-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Data Wilayah</span>
                <span class="info-box-number">{{ App\Models\Province::count() }} provinsi</span>
                <a href="{{ route('admin.provinces.index') }}" class="btn btn-sm mt-2" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">Kelola</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // User Role Distribution Pie Chart
    const userRoleCtx = document.getElementById('userRoleChart').getContext('2d');
    new Chart(userRoleCtx, {
        type: 'doughnut',
        data: {
            labels: ['Admin', 'Calon Siswa', 'Panitia', 'Keuangan', 'Kepala Sekolah'],
            datasets: [{
                data: [
                    {{ App\Models\User::where('role', 'admin')->count() }},
                    {{ App\Models\User::where('role', 'calon_siswa')->count() }},
                    {{ App\Models\User::where('role', 'panitia')->count() }},
                    {{ App\Models\User::where('role', 'keuangan')->count() }},
                    {{ App\Models\User::where('role', 'kepala_sekolah')->count() }}
                ],
                backgroundColor: [
                    '#1B1A55',    // Admin - Dark Blue
                    '#28a745',    // Calon Siswa - Green
                    '#ffc107',    // Panitia - Yellow
                    '#dc3545',    // Keuangan - Red
                    '#6f42c1'     // Kepala Sekolah - Purple
                ],
                borderWidth: 2
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
    
    // Jurusan Status Bar Chart
    const jurusanStatusCtx = document.getElementById('jurusanStatusChart').getContext('2d');
    new Chart(jurusanStatusCtx, {
        type: 'bar',
        data: {
            labels: ['Aktif', 'Non-Aktif'],
            datasets: [{
                label: 'Jumlah Jurusan',
                data: [
                    {{ App\Models\Jurusan::where('is_active', true)->count() }},
                    {{ App\Models\Jurusan::where('is_active', false)->count() }}
                ],
                backgroundColor: ['#28a745', '#dc3545'],
                borderColor: ['#28a745', '#dc3545'],
                borderWidth: 1
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
    
    // Gelombang Timeline Chart
    const gelombangTimelineCtx = document.getElementById('gelombangTimelineChart').getContext('2d');
    new Chart(gelombangTimelineCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Gelombang Aktif',
                data: [
                    @php
                        $monthlyGelombang = [];
                        for($i = 1; $i <= 12; $i++) {
                            $monthlyGelombang[] = App\Models\Gelombang::whereMonth('tgl_mulai', $i)->whereYear('tgl_mulai', date('Y'))->count();
                        }
                        echo implode(',', $monthlyGelombang);
                    @endphp
                ],
                borderColor: '#1B1A55',
                backgroundColor: 'rgba(27, 26, 85, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Pendaftaran',
                data: [
                    @php
                        $monthlyPendaftaran = [];
                        for($i = 1; $i <= 12; $i++) {
                            $monthlyPendaftaran[] = App\Models\Pendaftaran::whereMonth('created_at', $i)->whereYear('created_at', date('Y'))->count();
                        }
                        echo implode(',', $monthlyPendaftaran);
                    @endphp
                ],
                borderColor: '#F5E8C7',
                backgroundColor: 'rgba(245, 232, 199, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
});
</script>
@endpush