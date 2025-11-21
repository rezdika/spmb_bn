@extends('panitia.panitia')

@section('title', 'Verifikasi Berkas - Dashboard Panitia')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-file-check text-primary mr-2"></i>Verifikasi Berkas
        </h1>
        <div class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-chart-bar fa-sm text-white-50"></i> Total: {{ $berkas->total() }} Pendaftar
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                <i class="fas fa-clock mr-1"></i>Menunggu Verifikasi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $berkasPending }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <i class="fas fa-check mr-1"></i>Berkas Disetujui
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $berkasApproved }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <i class="fas fa-edit mr-1"></i>Perlu Perbaikan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $berkasRevision }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                <i class="fas fa-times mr-1"></i>Berkas Ditolak
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $berkasRejected }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-filter mr-2"></i>Filter & Pencarian Berkas
            </h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow">
                    <div class="dropdown-header">Aksi Cepat:</div>
                    <a class="dropdown-item" href="{{ route('panitia.berkas.index', ['status' => 'pending']) }}">
                        <i class="fas fa-clock fa-sm fa-fw mr-2 text-warning"></i>Lihat Menunggu
                    </a>
                    <a class="dropdown-item" href="{{ route('panitia.berkas.index', ['status' => 'revision']) }}">
                        <i class="fas fa-edit fa-sm fa-fw mr-2 text-info"></i>Lihat Revisi
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" class="row align-items-end">
                <div class="col-md-3 mb-3">
                    <label class="form-label small font-weight-bold text-gray-600">Jenis Berkas</label>
                    <select name="jenis" class="form-control form-control-sm">
                        <option value="">Semua Jenis</option>
                        <option value="IJAZAH" {{ request('jenis') == 'IJAZAH' ? 'selected' : '' }}>Ijazah</option>
                        <option value="RAPOR" {{ request('jenis') == 'RAPOR' ? 'selected' : '' }}>Rapor</option>
                        <option value="AKTA" {{ request('jenis') == 'AKTA' ? 'selected' : '' }}>Akta Kelahiran</option>
                        <option value="KK" {{ request('jenis') == 'KK' ? 'selected' : '' }}>Kartu Keluarga</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label small font-weight-bold text-gray-600">Status Verifikasi</label>
                    <select name="status" class="form-control form-control-sm">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="revision" {{ request('status') == 'revision' ? 'selected' : '' }}>Perlu Perbaikan</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label small font-weight-bold text-gray-600">Pencarian</label>
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama siswa atau jurusan..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <div class="btn-group w-100" role="group">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-search mr-1"></i>Cari
                        </button>
                        <a href="{{ route('panitia.berkas.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-undo mr-1"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-table mr-2"></i>Daftar Berkas Pendaftar
                <span class="badge badge-primary ml-2">{{ $berkas->total() }}</span>
            </h6>
            <div class="d-flex align-items-center">
                <div class="custom-control custom-checkbox mr-3">
                    <input type="checkbox" class="custom-control-input" id="selectAll">
                    <label class="custom-control-label" for="selectAll">Pilih Semua</label>
                </div>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle btn btn-sm btn-outline-primary" href="#" role="button" data-toggle="dropdown">
                        <i class="fas fa-cog mr-1"></i>Aksi
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow">
                        <div class="dropdown-header">Aksi Massal:</div>
                        <a class="dropdown-item" href="#" onclick="bulkAction('approved')">
                            <i class="fas fa-check fa-sm fa-fw mr-2 text-success"></i>Setujui Terpilih
                        </a>
                        <a class="dropdown-item" href="#" onclick="bulkAction('revision')">
                            <i class="fas fa-edit fa-sm fa-fw mr-2 text-warning"></i>Revisi Terpilih
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($berkas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th width="40" class="text-center">
                                    <i class="fas fa-check-square text-gray-400"></i>
                                </th>
                                <th class="font-weight-bold">
                                    <i class="fas fa-user mr-1"></i>Nama Siswa
                                </th>
                                <th class="font-weight-bold">
                                    <i class="fas fa-graduation-cap mr-1"></i>Jurusan
                                </th>
                                <th class="text-center font-weight-bold">
                                    <i class="fas fa-file-alt mr-1"></i>Total Berkas
                                </th>
                                <th class="text-center font-weight-bold">
                                    <i class="fas fa-clipboard-check mr-1"></i>Status
                                </th>
                                <th class="text-center font-weight-bold">
                                    <i class="fas fa-calendar mr-1"></i>Tanggal
                                </th>
                                <th class="text-center font-weight-bold">
                                    <i class="fas fa-cogs mr-1"></i>Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($berkas as $pendaftarBerkas)
                                @php 
                                    $firstBerkas = $pendaftarBerkas->first();
                                    $totalBerkas = $pendaftarBerkas->count();
                                    $approvedCount = $pendaftarBerkas->where('status', 'approved')->count();
                                    $pendingCount = $pendaftarBerkas->where('status', 'pending')->count();
                                    $rejectedCount = $pendaftarBerkas->where('status', 'rejected')->count();
                                    $revisionCount = $pendaftarBerkas->where('status', 'revision')->count();
                                @endphp
                                <!-- Main Row -->
                                <tr class="main-row align-middle" data-pendaftar="{{ $firstBerkas->pendaftar_id }}">
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input berkas-checkbox" id="check{{ $firstBerkas->pendaftar_id }}" value="{{ $firstBerkas->pendaftar_id }}">
                                            <label class="custom-control-label" for="check{{ $firstBerkas->pendaftar_id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-primary">
                                                    <i class="fas fa-user text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold text-gray-800">{{ $firstBerkas->pendaftar->user->nama_lengkap }}</div>
                                                <div class="small text-gray-600">ID: {{ $firstBerkas->pendaftar_id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-info badge-pill">{{ $firstBerkas->pendaftar->jurusan->nama }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="font-weight-bold text-primary">{{ $totalBerkas }}</div>
                                        <div class="small text-gray-600">berkas</div>
                                    </td>
                                    <td class="text-center">
                                        @if($rejectedCount > 0)
                                            <span class="badge badge-danger badge-pill">
                                                <i class="fas fa-times mr-1"></i>Ditolak ({{ $rejectedCount }})
                                            </span>
                                        @elseif($revisionCount > 0)
                                            <span class="badge badge-warning badge-pill">
                                                <i class="fas fa-edit mr-1"></i>Revisi ({{ $revisionCount }})
                                            </span>
                                        @elseif($pendingCount > 0)
                                            <span class="badge badge-info badge-pill">
                                                <i class="fas fa-clock mr-1"></i>Menunggu ({{ $pendingCount }})
                                            </span>
                                        @else
                                            <span class="badge badge-success badge-pill">
                                                <i class="fas fa-check mr-1"></i>Lengkap
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="font-weight-bold">{{ $firstBerkas->created_at->format('d/m/Y') }}</div>
                                        <div class="small text-gray-600">{{ $firstBerkas->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm toggle-berkas shadow-sm" data-target="berkas-{{ $firstBerkas->pendaftar_id }}">
                                            <i class="fas fa-plus mr-1"></i>Detail
                                        </button>
                                    </td>
                                </tr>
                                <!-- Expandable Detail Row -->
                                <tr class="berkas-detail bg-light" id="berkas-{{ $firstBerkas->pendaftar_id }}" style="display: none;">
                                    <td colspan="7" class="p-3">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-white py-2">
                                                <h6 class="m-0 font-weight-bold text-primary">
                                                    <i class="fas fa-file-alt mr-2"></i>Detail Berkas - {{ $firstBerkas->pendaftar->user->nama_lengkap }}
                                                </h6>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-sm mb-0">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th width="15%" class="font-weight-bold">
                                                                    <i class="fas fa-tag mr-1"></i>Jenis Berkas
                                                                </th>
                                                                <th width="25%" class="font-weight-bold">
                                                                    <i class="fas fa-file mr-1"></i>Nama File
                                                                </th>
                                                                <th width="10%" class="text-center font-weight-bold">
                                                                    <i class="fas fa-weight mr-1"></i>Ukuran
                                                                </th>
                                                                <th width="15%" class="text-center font-weight-bold">
                                                                    <i class="fas fa-info-circle mr-1"></i>Status
                                                                </th>
                                                                <th width="35%" class="text-center font-weight-bold">
                                                                    <i class="fas fa-tools mr-1"></i>Aksi Verifikasi
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($pendaftarBerkas as $item)
                                                                <tr class="align-middle">
                                                                    <td>
                                                                        <span class="badge badge-secondary badge-pill">
                                                                            <i class="fas fa-file-alt mr-1"></i>{{ $item->jenis }}
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="font-weight-bold text-gray-800">{{ Str::limit($item->nama_file, 30) }}</div>
                                                                        @if($item->catatan_panitia)
                                                                            <div class="small text-info mt-1">
                                                                                <i class="fas fa-comment-alt mr-1"></i>{{ Str::limit($item->catatan_panitia, 50) }}
                                                                            </div>
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <span class="badge badge-light">{{ number_format($item->ukuran_kb) }} KB</span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @php
                                                                            $statusConfig = [
                                                                                'pending' => ['class' => 'warning', 'icon' => 'clock', 'text' => 'Menunggu'],
                                                                                'approved' => ['class' => 'success', 'icon' => 'check', 'text' => 'Disetujui'],
                                                                                'rejected' => ['class' => 'danger', 'icon' => 'times', 'text' => 'Ditolak'],
                                                                                'revision' => ['class' => 'info', 'icon' => 'edit', 'text' => 'Revisi']
                                                                            ];
                                                                            $config = $statusConfig[$item->status] ?? $statusConfig['pending'];
                                                                        @endphp
                                                                        <span class="badge badge-{{ $config['class'] }} badge-pill">
                                                                            <i class="fas fa-{{ $config['icon'] }} mr-1"></i>{{ $config['text'] }}
                                                                        </span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <div class="btn-group btn-group-sm" role="group">
                                                                            <button type="button" class="btn btn-outline-info btn-preview" data-berkas-id="{{ $item->id }}" title="Preview Berkas">
                                                                                <i class="fas fa-eye"></i>
                                                                            </button>
                                                                            <a href="{{ route('panitia.berkas.download', $item->id) }}" class="btn btn-outline-secondary" title="Download Berkas">
                                                                                <i class="fas fa-download"></i>
                                                                            </a>
                                                                            @if($item->status !== 'approved')
                                                                                <button type="button" class="btn btn-success btn-verify" data-berkas-id="{{ $item->id }}" data-status="approved" title="Setujui Berkas">
                                                                                    <i class="fas fa-check"></i>
                                                                                </button>
                                                                            @endif
                                                                            @if($item->status !== 'revision')
                                                                                <button type="button" class="btn btn-warning btn-verify-modal" data-berkas-id="{{ $item->id }}" data-status="revision" title="Minta Revisi">
                                                                                    <i class="fas fa-edit"></i>
                                                                                </button>
                                                                            @endif
                                                                            @if($item->status !== 'rejected')
                                                                                <button type="button" class="btn btn-danger btn-verify-modal" data-berkas-id="{{ $item->id }}" data-status="rejected" title="Tolak Berkas">
                                                                                    <i class="fas fa-times"></i>
                                                                                </button>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted small">
                        Menampilkan {{ $berkas->firstItem() ?? 0 }} - {{ $berkas->lastItem() ?? 0 }} dari {{ $berkas->total() }} data
                    </div>
                    <div>
                        {{ $berkas->appends(request()->query())->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-folder-open fa-4x text-gray-300"></i>
                    </div>
                    <h5 class="text-gray-600 mb-2">Tidak Ada Berkas Ditemukan</h5>
                    <p class="text-gray-500 mb-4">Belum ada berkas yang diupload atau sesuai dengan filter yang dipilih.</p>
                    <a href="{{ route('panitia.berkas.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-refresh mr-1"></i>Refresh Halaman
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Verify Modal -->
<div class="modal fade" id="verifyModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold" id="verifyModalTitle">
                    <i class="fas fa-clipboard-check mr-2"></i>Verifikasi Berkas
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="verifyForm">
                <div class="modal-body">
                    <input type="hidden" id="berkasId">
                    <input type="hidden" id="statusAction">
                    
                    <!-- Warning Alert -->
                    <div class="alert alert-danger border-left-danger" id="rejectWarning" style="display: none;">
                        <div class="d-flex align-items-center">
                            <div class="mr-3">
                                <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-danger mb-1">Peringatan Penting!</h6>
                                <p class="mb-0 small">Menolak berkas berarti siswa <strong>tidak akan lulus</strong> verifikasi berkas dan tidak dapat melanjutkan proses pendaftaran.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Input -->
                    <div class="form-group">
                        <label class="form-label font-weight-bold text-gray-700">
                            <i class="fas fa-comment-alt mr-1"></i>Catatan Verifikasi 
                            <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="catatanPanitia" rows="4" placeholder="Berikan penjelasan yang detail dan konstruktif..." required></textarea>
                        <div class="form-text text-muted">
                            <i class="fas fa-info-circle mr-1"></i>
                            Minimal 10 karakter. Berikan penjelasan yang jelas agar siswa dapat memahami dan memperbaiki berkas.
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save mr-1"></i>Simpan Verifikasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-eye mr-2"></i>Preview Berkas
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="d-flex justify-content-center align-items-center" style="min-height: 500px; background-color: #f8f9fc;">
                    <div class="text-center" id="previewLoading">
                        <div class="spinner-border text-primary mb-3" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="text-muted">Memuat preview berkas...</p>
                    </div>
                    <iframe id="previewFrame" width="100%" height="600px" style="border: none; display: none;" onload="document.getElementById('previewLoading').style.display='none'; this.style.display='block';"></iframe>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Tutup
                </button>
                <button type="button" class="btn btn-primary" onclick="window.open(document.getElementById('previewFrame').src, '_blank')">
                    <i class="fas fa-external-link-alt mr-1"></i>Buka di Tab Baru
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.icon-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    font-size: 0.875rem;
}

.berkas-detail {
    background-color: #f8f9fc;
}

.table th {
    border-top: none;
    font-size: 0.875rem;
}

.badge-pill {
    font-size: 0.75rem;
}

.btn-group-sm > .btn, .btn-sm {
    font-size: 0.75rem;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.toggle-berkas {
    transition: all 0.3s ease;
}

.toggle-berkas:hover {
    transform: translateY(-1px);
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.main-row:hover {
    background-color: #f8f9fc;
}

.custom-control-label::before {
    border: 1px solid #d1d3e2;
}

.table-responsive {
    border-radius: 0.35rem;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Toggle expand/collapse berkas dengan animasi
    $(document).on('click', '.toggle-berkas', function(e) {
        e.preventDefault();
        
        const target = $(this).data('target');
        const icon = $(this).find('i');
        const targetRow = $('#' + target);
        const button = $(this);
        
        if (targetRow.is(':visible')) {
            targetRow.slideUp(300);
            icon.removeClass('fa-minus').addClass('fa-plus');
            button.html('<i class="fas fa-plus mr-1"></i>Detail');
            button.removeClass('btn-secondary').addClass('btn-primary');
        } else {
            targetRow.slideDown(300);
            icon.removeClass('fa-plus').addClass('fa-minus');
            button.html('<i class="fas fa-minus mr-1"></i>Tutup');
            button.removeClass('btn-primary').addClass('btn-secondary');
        }
    });
    
    // Select All functionality
    $('#selectAll').change(function() {
        $('.berkas-checkbox').prop('checked', this.checked);
    });
    
    $('.berkas-checkbox').change(function() {
        if (!this.checked) {
            $('#selectAll').prop('checked', false);
        } else {
            const allChecked = $('.berkas-checkbox:checked').length === $('.berkas-checkbox').length;
            $('#selectAll').prop('checked', allChecked);
        }
    });
    
    // Preview berkas dengan loading state
    $(document).on('click', '.btn-preview', function(e) {
        e.preventDefault();
        const berkasId = $(this).data('berkas-id');
        const button = $(this);
        
        // Show loading state
        const originalHtml = button.html();
        button.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
        
        // Set preview source
        document.getElementById('previewFrame').src = `/panitia/berkas/preview/${berkasId}`;
        $('#previewModal').modal('show');
        
        // Reset button after modal is shown
        $('#previewModal').on('shown.bs.modal', function() {
            button.html(originalHtml).prop('disabled', false);
        });
    });
    
    // Verify berkas langsung (approve) dengan konfirmasi yang lebih baik
    $(document).on('click', '.btn-verify', function(e) {
        e.preventDefault();
        const berkasId = $(this).data('berkas-id');
        const status = $(this).data('status');
        const button = $(this);
        
        // Custom confirmation dengan SweetAlert style
        if (confirm(`✅ Yakin menyetujui berkas ini?\n\nBerkas yang disetujui tidak dapat diubah lagi.`)) {
            // Show loading state
            const originalHtml = button.html();
            button.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
            
            fetch(`/panitia/berkas/verify/${berkasId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message before reload
                    alert('✅ Berkas berhasil disetujui!');
                    location.reload();
                } else {
                    alert('❌ Gagal memverifikasi berkas: ' + (data.message || 'Unknown error'));
                    button.html(originalHtml).prop('disabled', false);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('❌ Terjadi kesalahan saat memverifikasi berkas');
                button.html(originalHtml).prop('disabled', false);
            });
        }
    });
    
    // Show verify modal (revision/reject) dengan konfigurasi yang lebih baik
    $(document).on('click', '.btn-verify-modal', function(e) {
        e.preventDefault();
        const berkasId = $(this).data('berkas-id');
        const status = $(this).data('status');
        
        document.getElementById('berkasId').value = berkasId;
        document.getElementById('statusAction').value = status;
        document.getElementById('catatanPanitia').value = '';
        
        const title = document.getElementById('verifyModalTitle');
        const warning = document.getElementById('rejectWarning');
        const submitBtn = document.getElementById('submitBtn');
        
        if (status === 'revision') {
            title.innerHTML = '<i class="fas fa-edit text-warning mr-2"></i>Minta Revisi Berkas';
            warning.style.display = 'none';
            submitBtn.innerHTML = '<i class="fas fa-edit mr-1"></i>Minta Revisi';
            submitBtn.className = 'btn btn-warning';
            document.getElementById('catatanPanitia').placeholder = 'Jelaskan bagian mana yang perlu diperbaiki...';
        } else if (status === 'rejected') {
            title.innerHTML = '<i class="fas fa-times text-danger mr-2"></i>Tolak Berkas';
            warning.style.display = 'block';
            submitBtn.innerHTML = '<i class="fas fa-times mr-1"></i>Tolak Berkas';
            submitBtn.className = 'btn btn-danger';
            document.getElementById('catatanPanitia').placeholder = 'Berikan alasan penolakan yang jelas...';
        }
        
        $('#verifyModal').modal('show');
        // Focus on textarea
        setTimeout(() => document.getElementById('catatanPanitia').focus(), 500);
    });
    
    // Submit verify form dengan validasi yang lebih baik
    $('#verifyForm').on('submit', function(e) {
        e.preventDefault();
        
        const berkasId = document.getElementById('berkasId').value;
        const status = document.getElementById('statusAction').value;
        const catatan = document.getElementById('catatanPanitia').value.trim();
        const submitBtn = document.getElementById('submitBtn');
        
        // Validasi input
        if (!catatan || catatan.length < 10) {
            alert('⚠️ Catatan minimal 10 karakter untuk memberikan penjelasan yang jelas!');
            document.getElementById('catatanPanitia').focus();
            return;
        }
        
        const confirmMsg = status === 'revision' ? 
            '📝 Yakin ingin meminta revisi berkas ini?\n\nSiswa akan diminta untuk mengupload ulang berkas.' : 
            '❌ Yakin ingin menolak berkas ini?\n\n⚠️ PERHATIAN: Siswa tidak akan lulus verifikasi berkas!';
        
        if (confirm(confirmMsg)) {
            // Show loading state
            const originalHtml = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Memproses...';
            submitBtn.disabled = true;
            
            fetch(`/panitia/berkas/verify/${berkasId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ 
                    status: status,
                    catatan_panitia: catatan
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const successMsg = status === 'revision' ? 
                        '📝 Berkas berhasil diminta revisi!' : 
                        '❌ Berkas berhasil ditolak!';
                    alert(successMsg);
                    location.reload();
                } else {
                    alert('❌ Gagal memverifikasi berkas: ' + (data.message || 'Unknown error'));
                    submitBtn.innerHTML = originalHtml;
                    submitBtn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('❌ Terjadi kesalahan saat memverifikasi berkas');
                submitBtn.innerHTML = originalHtml;
                submitBtn.disabled = false;
            });
        }
    });
});

// Bulk action function
function bulkAction(action) {
    const selectedIds = $('.berkas-checkbox:checked').map(function() {
        return this.value;
    }).get();
    
    if (selectedIds.length === 0) {
        alert('⚠️ Pilih minimal satu berkas untuk diproses!');
        return;
    }
    
    const actionText = action === 'approved' ? 'menyetujui' : 'meminta revisi';
    const confirmMsg = `Yakin ${actionText} ${selectedIds.length} berkas terpilih?`;
    
    if (confirm(confirmMsg)) {
        // Implementation for bulk action
        console.log('Bulk action:', action, 'IDs:', selectedIds);
        alert('🚧 Fitur bulk action sedang dalam pengembangan');
    }
}
</script>
@endpush