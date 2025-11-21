@extends('user.main')

@section('title', 'Monitoring Progress - PPDB SMK Bakti Nusantara 666')

@section('hero')
<section class="text-white py-5 position-relative" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="position-absolute w-100 h-100" style="background: url('{{ asset('assets/image/hero_section/sekolah1.png') }}'); background-size: cover; background-position: center; filter: blur(3px); z-index: -1;"></div>
    <div class="container py-5 position-relative">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8">
                <div class="badge mb-3 px-3 py-2" style="background-color: #F5E8C7; color: #1B1A55;">
                    <i class="fas fa-chart-line me-2"></i>Monitoring Progress
                </div>
                <h1 class="display-4 fw-bold mb-4">Status <span style="color: #F5E8C7;">Pendaftaran</span></h1>
                <p class="lead mb-4 opacity-90">Pantau progress pendaftaran PPDB Anda secara real-time.</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success mb-4">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger mb-4">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif
        
        @if($berkasNotifications->count() > 0)
            <div class="alert alert-warning border-0 shadow mb-4" style="border-left: 5px solid #ffc107 !important;">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="alert-heading mb-2">
                            <i class="fas fa-file-exclamation me-2"></i>Berkas Perlu Diperbaiki ({{ $berkasNotifications->count() }})
                        </h5>
                        <p class="mb-2">Panitia telah meninjau berkas Anda dan meminta perbaikan pada dokumen berikut:</p>
                        <ul class="mb-3">
                            @foreach($berkasNotifications as $berkas)
                                <li><strong>{{ $berkas->jenis }}</strong> - {{ $berkas->catatan }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('profile.upload-berkas') }}" class="btn btn-warning">
                            <i class="fas fa-upload me-2"></i>Perbaiki Berkas Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @if($pendaftaran)
            <div class="row g-4">
                <!-- Data Pendaftaran & Pembayaran -->
                <div class="col-lg-8">
                    <!-- Data Pendaftaran -->
                    <div class="card border-0 shadow mb-4">
                        <div class="card-header py-3" style="background-color: #1B1A55; color: white;">
                            <h6 class="mb-0"><i class="fas fa-user me-2"></i>Data Pendaftaran</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <strong>No. Pendaftaran:</strong><br>
                                <span class="text-primary">{{ $pendaftaran->no_pendaftaran }}</span>
                            </div>
                            <div class="mb-3">
                                <strong>Jurusan:</strong><br>
                                {{ $pendaftaran->jurusan->nama }}
                            </div>
                            <div class="mb-3">
                                <strong>Gelombang:</strong><br>
                                {{ $pendaftaran->gelombang->nama }}
                            </div>
                            <div class="mb-3">
                                <strong>Tanggal Daftar:</strong><br>
                                {{ $pendaftaran->tanggal_daftar->format('d M Y, H:i') }}
                            </div>
                        </div>
                    </div>

                    <!-- Upload Pembayaran (jika diterima dan belum bayar) -->
                    @if($pendaftaran->status === 'ADM_PASS' && $pendaftaran->status_pembayaran === 'belum_bayar')
                        <div class="card border-0 shadow">
                            <div class="card-header py-3" style="background: linear-gradient(135deg, #28a745, #20c997); color: white;">
                                <h6 class="mb-0"><i class="fas fa-credit-card me-2"></i>Pembayaran Pendaftaran</h6>
                            </div>
                            <div class="card-body p-0">
                                <!-- Biaya Pendaftaran -->
                                <div class="p-4 border-bottom" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);">
                                    <div class="text-center">
                                        <h4 class="fw-bold text-primary mb-2">Biaya Pendaftaran</h4>
                                        <h2 class="fw-bold text-success mb-0">Rp {{ number_format($pendaftaran->jumlah_pembayaran, 0, ',', '.') }}</h2>
                                        <small class="text-muted">Jurusan {{ $pendaftaran->jurusan->nama }}</small>
                                    </div>
                                </div>

                                <!-- Payment Methods -->
                                <div class="p-4">
                                    <h6 class="fw-bold mb-3"><i class="fas fa-wallet me-2"></i>Pilih Metode Pembayaran</h6>
                                    
                                    <!-- Payment Tabs -->
                                    <ul class="nav nav-pills nav-fill mb-4" id="paymentTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="qris-tab" data-bs-toggle="pill" data-bs-target="#qris" type="button" role="tab">
                                                <i class="fas fa-qrcode me-2"></i>QRIS
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="transfer-tab" data-bs-toggle="pill" data-bs-target="#transfer" type="button" role="tab">
                                                <i class="fas fa-university me-2"></i>Transfer Bank
                                            </button>
                                        </li>
                                    </ul>

                                    <!-- Payment Content -->
                                    <div class="tab-content" id="paymentTabsContent">
                                        <!-- QRIS Payment -->
                                        <div class="tab-pane fade show active" id="qris" role="tabpanel">
                                            <div class="text-center mb-4">
                                                <div class="card border-2 border-primary mx-auto" style="max-width: 280px;">
                                                    <div class="card-header bg-primary text-white py-2">
                                                        <small class="fw-bold"><i class="fas fa-qrcode me-2"></i>Scan QR Code</small>
                                                    </div>
                                                    <div class="card-body p-3">
                                                        <img src="{{ asset('assets/image/qris.jpg') }}" alt="QRIS Code" class="img-fluid rounded" style="max-width: 100%;">
                                                        <div class="mt-3">
                                                            <small class="text-muted d-block">SMK Bakti Nusantara 666</small>
                                                            <small class="text-primary fw-bold">Rp {{ number_format($pendaftaran->jumlah_pembayaran, 0, ',', '.') }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="alert alert-info border-0">
                                                <div class="d-flex align-items-start">
                                                    <i class="fas fa-info-circle me-3 mt-1"></i>
                                                    <div>
                                                        <h6 class="fw-bold mb-2">Cara Pembayaran QRIS:</h6>
                                                        <ol class="mb-0 small">
                                                            <li>Buka aplikasi mobile banking atau e-wallet</li>
                                                            <li>Pilih menu "Scan QR" atau "QRIS"</li>
                                                            <li>Scan QR Code di atas</li>
                                                            <li>Pastikan nominal sesuai</li>
                                                            <li>Konfirmasi pembayaran</li>
                                                            <li>Screenshot bukti pembayaran</li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bank Transfer -->
                                        <div class="tab-pane fade" id="transfer" role="tabpanel">
                                            <div class="row g-3 mb-4">
                                                <div class="col-md-6">
                                                    <div class="card border-primary h-100">
                                                        <div class="card-body text-center p-3">
                                                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                                                                <i class="fas fa-university"></i>
                                                            </div>
                                                            <h6 class="fw-bold text-primary">Bank BCA</h6>
                                                            <p class="mb-1 fw-bold">1234567890</p>
                                                            <small class="text-muted">a.n SMK Bakti Nusantara 666</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card border-success h-100">
                                                        <div class="card-body text-center p-3">
                                                            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                                                                <i class="fas fa-university"></i>
                                                            </div>
                                                            <h6 class="fw-bold text-success">Bank Mandiri</h6>
                                                            <p class="mb-1 fw-bold">0987654321</p>
                                                            <small class="text-muted">a.n SMK Bakti Nusantara 666</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="alert alert-warning border-0">
                                                <div class="d-flex align-items-start">
                                                    <i class="fas fa-exclamation-triangle me-3 mt-1"></i>
                                                    <div>
                                                        <h6 class="fw-bold mb-2">Petunjuk Transfer Bank:</h6>
                                                        <ul class="mb-0 small">
                                                            <li>Transfer sesuai nominal: <strong>Rp {{ number_format($pendaftaran->jumlah_pembayaran, 0, ',', '.') }}</strong></li>
                                                            <li>Gunakan berita transfer: <strong>{{ $pendaftaran->no_pendaftaran }}</strong></li>
                                                            <li>Simpan bukti transfer untuk diupload</li>
                                                            <li>Pastikan nama pengirim sesuai dengan nama pendaftar</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Upload Form -->
                                    <div class="border-top pt-4 mt-4">
                                        <h6 class="fw-bold mb-3"><i class="fas fa-upload me-2"></i>Upload Bukti Pembayaran</h6>
                                        
                                        @if(session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            </div>
                                        @endif
                                        
                                        @if(session('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            </div>
                                        @endif
                                        <form action="{{ route('monitoring.upload-pembayaran') }}" method="POST" enctype="multipart/form-data" id="paymentForm">
                                            @csrf
                                            <input type="hidden" name="pendaftar_id" value="{{ $pendaftaran->id }}">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Bukti Transfer/Screenshot</label>
                                                <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*,application/pdf" required id="fileInput">
                                                <small class="text-muted">Format: JPG, PNG, PDF (Max: 5MB)</small>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Catatan (Opsional)</label>
                                                <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-success w-100 py-3 fw-bold" style="font-size: 1.1rem;" id="submitBtn">
                                                <i class="fas fa-paper-plane me-2"></i>Kirim Bukti Pembayaran
                                            </button>
                                        </form>
                                    </div>

                                    <script>
                                    document.getElementById('paymentForm').addEventListener('submit', function(e) {
                                        const fileInput = document.getElementById('fileInput');
                                        const submitBtn = document.getElementById('submitBtn');
                                        
                                        if (!fileInput.files || fileInput.files.length === 0) {
                                            e.preventDefault();
                                            alert('Silakan pilih file bukti pembayaran terlebih dahulu!');
                                            return false;
                                        }
                                        
                                        const file = fileInput.files[0];
                                        const maxSize = 5 * 1024 * 1024; // 5MB
                                        
                                        if (file.size > maxSize) {
                                            e.preventDefault();
                                            alert('Ukuran file terlalu besar! Maksimal 5MB.');
                                            return false;
                                        }
                                        
                                        // Show loading state
                                        submitBtn.disabled = true;
                                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
                                    });
                                    
                                    // File preview
                                    document.getElementById('fileInput').addEventListener('change', function(e) {
                                        const file = e.target.files[0];
                                        if (file) {
                                            const fileSize = (file.size / 1024 / 1024).toFixed(2);
                                            console.log('File selected:', file.name, 'Size:', fileSize + 'MB');
                                        }
                                    });
                                    </script>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Status & Progress Timeline -->
                <div class="col-lg-4">
                    <!-- Status Card -->
                    <div class="card border-0 shadow mb-4">
                        <div class="card-header py-3" style="background-color: #637AB9; color: white;">
                            <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Status Saat Ini</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center">
                                @if($pendaftaran->status === 'ADM_PASS' && $pendaftaran->status_pembayaran === 'lunas')
                                    <div class="badge bg-success p-3 mb-3" style="font-size: 1rem;">
                                        <i class="fas fa-graduation-cap me-2"></i>DITERIMA
                                    </div>
                                    <h6 class="text-success">Selamat!</h6>
                                    <p class="text-muted">Anda resmi menjadi siswa SMK Bakti Nusantara 666</p>
                                @elseif($pendaftaran->status === 'ADM_PASS')
                                    <div class="badge bg-warning p-3 mb-3" style="font-size: 1rem;">
                                        <i class="fas fa-credit-card me-2"></i>MENUNGGU PEMBAYARAN
                                    </div>
                                    <h6 class="text-warning">Lakukan Pembayaran</h6>
                                    <p class="text-muted">Silakan lakukan pembayaran untuk menyelesaikan pendaftaran</p>
                                @elseif($pendaftaran->status === 'ADM_REJECT')
                                    <div class="badge bg-danger p-3 mb-3" style="font-size: 1rem;">
                                        <i class="fas fa-times me-2"></i>DITOLAK
                                    </div>
                                    <h6 class="text-danger">Pendaftaran Ditolak</h6>
                                    <p class="text-muted">Maaf, pendaftaran Anda tidak dapat diproses</p>
                                @else
                                    <div class="badge bg-info p-3 mb-3" style="font-size: 1rem;">
                                        <i class="fas fa-clock me-2"></i>DALAM REVIEW
                                    </div>
                                    <h6 class="text-info">Sedang Diproses</h6>
                                    <p class="text-muted">Panitia sedang memverifikasi berkas Anda</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Progress Timeline -->
                    <div class="card border-0 shadow">
                        <div class="card-header py-3" style="background-color: #1B1A55; color: white;">
                            <h5 class="mb-0"><i class="fas fa-timeline me-2"></i>Progress Pendaftaran</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="timeline">
                                <!-- Step 1: Pendaftaran -->
                                <div class="timeline-item completed">
                                    <div class="timeline-marker">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold text-success">Pendaftaran Berhasil</h6>
                                        <p class="text-muted mb-1">{{ $pendaftaran->tanggal_daftar->format('d M Y, H:i') }}</p>
                                        <small class="text-success">No. Pendaftaran: {{ $pendaftaran->no_pendaftaran }}</small>
                                    </div>
                                </div>

                                <!-- Step 2: Verifikasi Berkas -->
                                <div class="timeline-item {{ in_array($pendaftaran->status, ['ADM_PASS', 'ADM_REJECT']) ? 'completed' : 'active' }}">
                                    <div class="timeline-marker">
                                        @if($pendaftaran->status === 'ADM_PASS')
                                            <i class="fas fa-check"></i>
                                        @elseif($pendaftaran->status === 'ADM_REJECT')
                                            <i class="fas fa-times"></i>
                                        @else
                                            <i class="fas fa-clock"></i>
                                        @endif
                                    </div>
                                    <div class="timeline-content">
                                        @if($pendaftaran->status === 'ADM_PASS')
                                            <h6 class="fw-bold text-success">Berkas Diterima</h6>
                                            <p class="text-muted mb-1">{{ $pendaftaran->tgl_verifikasi_adm ? $pendaftaran->tgl_verifikasi_adm->format('d M Y, H:i') : '-' }}</p>
                                            <small class="text-success">Selamat! Berkas Anda telah diverifikasi dan diterima oleh {{ $pendaftaran->user_verifikasi_adm ?? 'Admin' }}.</small>
                                            @if($pendaftaran->catatan_admin)
                                                <div class="alert alert-info mt-2">
                                                    <strong>Catatan:</strong> {{ $pendaftaran->catatan_admin }}
                                                </div>
                                            @endif
                                        @elseif($pendaftaran->status === 'ADM_REJECT')
                                            <h6 class="fw-bold text-danger">Berkas Ditolak</h6>
                                            <p class="text-muted mb-1">{{ $pendaftaran->tgl_verifikasi_adm ? $pendaftaran->tgl_verifikasi_adm->format('d M Y, H:i') : '-' }}</p>
                                            <small class="text-danger">Maaf, berkas Anda tidak memenuhi syarat. Diverifikasi oleh {{ $pendaftaran->user_verifikasi_adm ?? 'Admin' }}.</small>
                                            @if($pendaftaran->catatan_admin)
                                                <div class="alert alert-danger mt-2">
                                                    <strong>Alasan Penolakan:</strong> {{ $pendaftaran->catatan_admin }}
                                                </div>
                                            @endif
                                        @else
                                            <h6 class="fw-bold text-warning">Menunggu Verifikasi Berkas</h6>
                                            <p class="text-muted mb-1">Berkas: {{ $pendaftaran->berkas->count() }}/7 dokumen</p>
                                            <small class="text-warning">Panitia sedang memverifikasi berkas Anda. Mohon tunggu.</small>
                                        @endif
                                    </div>
                                </div>

                                <!-- Step 3: Pembayaran (hanya jika diterima) -->
                                @if($pendaftaran->status === 'ADM_PASS')
                                    <div class="timeline-item {{ $pendaftaran->status_pembayaran === 'lunas' ? 'completed' : ($pendaftaran->status_pembayaran === 'menunggu_verifikasi' ? 'active' : '') }}">
                                        <div class="timeline-marker">
                                            @if($pendaftaran->status_pembayaran === 'lunas')
                                                <i class="fas fa-check"></i>
                                            @elseif($pendaftaran->status_pembayaran === 'menunggu_verifikasi')
                                                <i class="fas fa-clock"></i>
                                            @else
                                                <i class="fas fa-credit-card"></i>
                                            @endif
                                        </div>
                                        <div class="timeline-content">
                                            @if($pendaftaran->status_pembayaran === 'lunas')
                                                <h6 class="fw-bold text-success">Pembayaran Lunas</h6>
                                                <p class="text-muted mb-1">{{ $pendaftaran->tgl_verifikasi_payment ? $pendaftaran->tgl_verifikasi_payment->format('d M Y, H:i') : '-' }}</p>
                                                <small class="text-success">Selamat! Pembayaran Anda telah diverifikasi oleh {{ $pendaftaran->user_verifikasi_payment ?? 'Admin' }}. Anda resmi menjadi siswa SMK Bakti Nusantara 666.</small>
                                                
                                                <!-- Cetak Kartu -->
                                                <div class="mt-3">
                                                    <div class="row g-2">
                                                        <div class="col-md-6">
                                                            <a href="{{ route('monitoring.cetak-kartu', $pendaftaran->id) }}" 
                                                               class="btn btn-primary btn-sm w-100" target="_blank">
                                                                <i class="fas fa-id-card me-2"></i>Cetak Kartu Pendaftaran
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="{{ route('monitoring.cetak-bukti-bayar', $pendaftaran->id) }}" 
                                                               class="btn btn-success btn-sm w-100" target="_blank">
                                                                <i class="fas fa-receipt me-2"></i>Cetak Bukti Bayar
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($pendaftaran->status_pembayaran === 'ditolak')
                                                <h6 class="fw-bold text-danger">Pembayaran Ditolak</h6>
                                                <p class="text-muted mb-1">{{ $pendaftaran->tgl_verifikasi_payment ? $pendaftaran->tgl_verifikasi_payment->format('d M Y, H:i') : '-' }}</p>
                                                <small class="text-danger">Maaf, bukti pembayaran Anda ditolak. Silakan upload ulang bukti pembayaran yang valid.</small>
                                                @if($pendaftaran->catatan_pembayaran)
                                                    <div class="alert alert-danger mt-2">
                                                        <strong>Alasan:</strong> {{ $pendaftaran->catatan_pembayaran }}
                                                    </div>
                                                @endif
                                            @elseif($pendaftaran->status_pembayaran === 'menunggu_verifikasi')
                                                <h6 class="fw-bold text-warning">Menunggu Verifikasi Pembayaran</h6>
                                                <p class="text-muted mb-1">Bukti pembayaran sedang diverifikasi</p>
                                                <small class="text-warning">Admin sedang memverifikasi bukti pembayaran Anda.</small>
                                            @else
                                                <h6 class="fw-bold text-primary">Lakukan Pembayaran</h6>
                                                <p class="text-muted mb-1">Upload bukti pembayaran</p>
                                                <small class="text-primary">Silakan lakukan pembayaran dan upload bukti transfer.</small>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-exclamation-triangle fa-5x text-warning"></i>
                </div>
                <h3>Belum Ada Pendaftaran</h3>
                <p class="text-muted mb-4">Anda belum melakukan pendaftaran PPDB.</p>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-2"></i>Mulai Pendaftaran
                </a>
            </div>
        @endif
    </div>
</section>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 0;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
}

.timeline-item.completed .timeline-marker {
    background: #28a745;
    color: white;
}

.timeline-item.active .timeline-marker {
    background: #ffc107;
    color: #212529;
}

.timeline-item:not(.completed):not(.active) .timeline-marker {
    background: #e9ecef;
    color: #6c757d;
}

.timeline-content {
    padding-left: 20px;
}

.upload-area:hover {
    background-color: #f8f9fa;
    border-color: #0d6efd !important;
}

.nav-pills .nav-link {
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s;
}

.nav-pills .nav-link.active {
    background: linear-gradient(135deg, #0d6efd, #6610f2);
}

.card:hover {
    transform: translateY(-2px);
    transition: all 0.3s;
}
</style>

@push('scripts')
<script>
$(document).ready(function() {
    // File validation
    $('#fileInput').on('change', function() {
        const file = this.files[0];
        if (file) {
            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                $(this).val('');
                return;
            }
            console.log('File selected:', file.name);
        }
    });

    // Form submission
    $('#paymentForm').on('submit', function(e) {
        const fileInput = $('#fileInput')[0];
        
        if (!fileInput.files.length) {
            e.preventDefault();
            alert('Silakan pilih file bukti pembayaran terlebih dahulu.');
            return false;
        }
        
        // Show loading
        $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...');
    });
});
</script>
@endpush
@endsection