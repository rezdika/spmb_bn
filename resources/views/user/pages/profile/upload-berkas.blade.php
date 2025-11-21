@extends('user.main')

@section('title', 'Upload Berkas - PPDB SMK Bakti Nusantara 666')

@section('styles')
<style>
.upload-area {
    border: 2px dashed #1B1A55;
    border-radius: 10px;
    padding: 40px;
    text-align: center;
    background: #f8f9fa;
    transition: all 0.3s ease;
    cursor: pointer;
}
.upload-area:hover {
    border-color: #F5E8C7;
    background: #fff;
}
.upload-area.dragover {
    border-color: #28a745;
    background: #e8f5e9;
}
.file-preview {
    max-width: 100px;
    max-height: 100px;
    object-fit: cover;
    border-radius: 8px;
}
.status-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}
</style>
@endsection

@section('hero')
<section class="text-white py-5 position-relative" style="min-height: 50vh; display: flex; align-items: center;">
    <div class="position-absolute w-100 h-100" style="background: url('{{ asset('assets/image/hero_section/sekolah_bn.jpg') }}'); background-size: cover; background-position: center; filter: blur(3px); z-index: -1;"></div>
    <div class="container py-5 position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="badge mb-3 px-3 py-2" style="background-color: #F5E8C7; color: #1B1A55;">
                    <i class="fas fa-upload me-2"></i>Upload Berkas
                </div>
                <h1 class="display-5 fw-bold mb-4">Upload <span style="color: #F5E8C7;">Berkas Pendaftaran</span></h1>
                <p class="lead mb-4 opacity-90">Lengkapi berkas pendaftaran Anda untuk melanjutkan proses PPDB.</p>
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

        <div class="row">
            <div class="col-lg-4">
                <!-- Profile Menu -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-header py-3" style="background-color: #1B1A55; color: white;">
                        <h6 class="mb-0"><i class="fas fa-list me-2"></i>Menu Profile</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('profile.data-pribadi') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                                <i class="fas fa-user-edit me-3" style="color: #1B1A55;"></i>
                                <div>
                                    <h6 class="mb-1">Data Pribadi</h6>
                                    <small class="text-muted">Lengkapi identitas diri</small>
                                </div>
                            </a>
                            <a href="{{ route('profile.data-orangtua') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                                <i class="fas fa-users me-3" style="color: #1B1A55;"></i>
                                <div>
                                    <h6 class="mb-1">Data Orang Tua</h6>
                                    <small class="text-muted">Informasi orang tua/wali</small>
                                </div>
                            </a>
                            <a href="{{ route('profile.asal-sekolah') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                                <i class="fas fa-school me-3" style="color: #1B1A55;"></i>
                                <div>
                                    <h6 class="mb-1">Asal Sekolah</h6>
                                    <small class="text-muted">Data sekolah sebelumnya</small>
                                </div>
                            </a>
                            <a href="{{ route('profile.upload-berkas') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3 active">
                                <i class="fas fa-file-upload me-3" style="color: #1B1A55;"></i>
                                <div>
                                    <h6 class="mb-1">Upload Berkas</h6>
                                    <small class="text-muted">Dokumen pendaftaran</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card border-0 shadow mb-4">
                    <div class="card-header" style="background-color: #F5E8C7; color: #1B1A55;">
                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Panduan Upload</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Format: PDF, JPG, PNG</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Ukuran maksimal: 2MB</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Foto harus jelas dan terbaca</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Rapor semester 1-5 bisa digabung dalam 1 file PDF</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Pastikan tidak ada bagian terpotong</li>
                        </ul>
                    </div>
                </div>

                <div class="card border-0 shadow mb-4">
                    <div class="card-header" style="background-color: #1B1A55; color: white;">
                        <h6 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Progress Berkas</h6>
                    </div>
                    <div class="card-body text-center">
                        @php
                            $requiredDocsKeys = ['IJAZAH', 'RAPOR', 'AKTA', 'KK'];
                            $totalRequired = 4;
                            $uploaded = $berkasUser->whereIn('jenis', $requiredDocsKeys)->count();
                            $approved = $berkasUser->whereIn('jenis', $requiredDocsKeys)->where('status', 'approved')->count();
                            $optionalUploaded = $berkasUser->whereIn('jenis', ['KIP', 'KKS'])->count();
                            $progress = ($uploaded / $totalRequired) * 100;
                        @endphp
                        <div class="mb-3">
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar" style="background-color: #1B1A55; width: {{ $progress }}%"></div>
                            </div>
                        </div>
                        <h4 style="color: #1B1A55;">{{ $uploaded }}/{{ $totalRequired }}</h4>
                        <p class="text-muted mb-0">Berkas Wajib</p>
                        <small class="text-success">{{ $approved }} Disetujui</small>
                        @if($optionalUploaded > 0)
                            <br><small class="text-info">+{{ $optionalUploaded }} Berkas Opsional</small>
                        @endif
                    </div>
                </div>
                
                @if($isProfileComplete && $uploaded >= 4)
                    <div class="card border-0 shadow" style="border: 2px solid #28a745 !important;">
                        <div class="card-header" style="background-color: #28a745; color: white;">
                            <h6 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Siap Mendaftar!</h6>
                        </div>
                        <div class="card-body text-center p-4">
                            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                            <h5 class="fw-bold mb-2" style="color: #28a745;">Data Lengkap!</h5>
                            <p class="text-muted mb-3">Semua data dan berkas sudah lengkap. Anda dapat melanjutkan pendaftaran sekarang.</p>
                            <a href="{{ route('pendaftaran.index') }}" class="btn btn-success btn-lg w-100">
                                <i class="fas fa-rocket me-2"></i>Daftar Sekarang
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="col-lg-8">
                <div class="card border-0 shadow">
                    <div class="card-header" style="background-color: #1B1A55; color: white;">
                        <h5 class="mb-0"><i class="fas fa-folder-open me-2"></i>Berkas Wajib</h5>
                    </div>
                    <div class="card-body p-4">
                        @php
                            $requiredDocs = [
                                'IJAZAH' => 'Ijazah/SKHUN',
                                'RAPOR' => 'Rapor Semester 1-5 (dalam 1 file)', 
                                'AKTA' => 'Akta Kelahiran',
                                'KK' => 'Kartu Keluarga'
                            ];
                        @endphp

                        @if(!$pendaftaran)
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Anda belum memiliki data pendaftaran. Silakan lengkapi data pribadi terlebih dahulu.
                                <a href="{{ route('profile.data-pribadi') }}" class="btn btn-sm btn-warning ms-2">Lengkapi Data</a>
                            </div>
                        @else
                        @foreach($requiredDocs as $jenis => $label)
                            @php
                                $berkas = $berkasUser->where('jenis', $jenis)->first();
                            @endphp
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h6 class="mb-0">{{ $label }}</h6>
                                        @if($jenis == 'RAPOR')
                                            <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Gabungkan semua semester dalam 1 file PDF</small>
                                        @endif
                                    </div>
                                    @if($berkas)
                                        {!! $berkas->status_badge !!}
                                    @else
                                        <span class="badge bg-secondary status-badge">Belum Upload</span>
                                    @endif
                                </div>
                                
                                @if($berkas)
                                    <div class="border rounded p-3" style="background-color: #f8f9fa;">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-file-alt me-2" style="color: #1B1A55;"></i>
                                                    <div>
                                                        <small class="text-muted">{{ $berkas->nama_file }}</small><br>
                                                        <small class="text-muted">{{ $berkas->ukuran_kb }} KB</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <a href="{{ route('berkas.preview', $berkas->id) }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                                <button type="button" class="btn btn-sm btn-warning me-2" onclick="replaceFile({{ $berkas->id }}, '{{ $jenis }}')">
                                                    <i class="fas fa-edit"></i> Ganti
                                                </button>
                                                <form method="POST" action="{{ route('berkas.delete', $berkas->id) }}" class="d-inline" onsubmit="return confirm('Yakin hapus berkas ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        @if($berkas->catatan_panitia)
                                            <div class="mt-2 p-2 rounded" style="background-color: #fff3cd;">
                                                <small><strong>Catatan Panitia:</strong> {{ $berkas->catatan_panitia }}</small>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="upload-area" onclick="document.getElementById('file_{{ $jenis }}').click()">
                                        <i class="fas fa-cloud-upload-alt fa-3x mb-3" style="color: #1B1A55;"></i>
                                        <h6>Klik atau drag file ke sini</h6>
                                        <p class="text-muted mb-0">Format: PDF, JPG, PNG (Max: 2MB)</p>
                                        <input type="file" id="file_{{ $jenis }}" class="d-none" accept=".pdf,.jpg,.jpeg,.png" onchange="uploadFile('{{ $jenis }}', this)">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        
                        <!-- Berkas Opsional -->
                        <hr class="my-4">
                        <h6 class="fw-bold mb-3" style="color: #1B1A55;"><i class="fas fa-file-plus me-2"></i>Berkas Opsional</h6>
                        <p class="text-muted mb-3">Upload berkas berikut jika Anda memilikinya (tidak wajib):</p>
                        
                        @php
                            $optionalDocs = [
                                'KIP' => 'Kartu Indonesia Pintar (KIP)',
                                'KKS' => 'Kartu Keluarga Sejahtera (KKS)'
                            ];
                        @endphp
                        
                        @foreach($optionalDocs as $jenis => $label)
                            @php
                                $berkas = $berkasUser->where('jenis', $jenis)->first();
                            @endphp
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h6 class="mb-0">{{ $label }} <span class="badge bg-info">Opsional</span></h6>
                                        <small class="text-muted">Upload jika Anda memiliki kartu ini</small>
                                    </div>
                                    @if($berkas)
                                        {!! $berkas->status_badge !!}
                                    @else
                                        <span class="badge bg-light text-muted status-badge">Tidak Wajib</span>
                                    @endif
                                </div>
                                
                                @if($berkas)
                                    <div class="border rounded p-3" style="background-color: #f8f9fa;">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-file-alt me-2" style="color: #1B1A55;"></i>
                                                    <div>
                                                        <small class="text-muted">{{ $berkas->nama_file }}</small><br>
                                                        <small class="text-muted">{{ $berkas->ukuran_kb }} KB</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <a href="{{ route('berkas.preview', $berkas->id) }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                                <button type="button" class="btn btn-sm btn-warning me-2" onclick="replaceFile({{ $berkas->id }}, '{{ $jenis }}')">
                                                    <i class="fas fa-edit"></i> Ganti
                                                </button>
                                                <form method="POST" action="{{ route('berkas.delete', $berkas->id) }}" class="d-inline" onsubmit="return confirm('Yakin hapus berkas ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        @if($berkas->catatan_panitia)
                                            <div class="mt-2 p-2 rounded" style="background-color: #fff3cd;">
                                                <small><strong>Catatan Panitia:</strong> {{ $berkas->catatan_panitia }}</small>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="upload-area" onclick="document.getElementById('file_{{ $jenis }}').click()" style="border-style: dotted; opacity: 0.7;">
                                        <i class="fas fa-cloud-upload-alt fa-2x mb-2" style="color: #6c757d;"></i>
                                        <h6 class="text-muted">Upload {{ $label }}</h6>
                                        <p class="text-muted mb-0 small">Format: PDF, JPG, PNG (Max: 2MB)</p>
                                        <input type="file" id="file_{{ $jenis }}" class="d-none" accept=".pdf,.jpg,.jpeg,.png" onchange="uploadFile('{{ $jenis }}', this)">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Replace File Modal -->
<div class="modal fade" id="replaceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ganti Berkas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="replaceForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih File Baru</label>
                        <input type="file" class="form-control" name="file" accept=".pdf,.jpg,.jpeg,.png" required>
                        <small class="text-muted">Format: PDF, JPG, PNG (Max: 2MB)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ganti Berkas</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function uploadFile(jenis, input) {
    if (!input.files[0]) return;
    
    // Check if pendaftaran exists
    @if(!$pendaftaran)
        alert('Anda belum memiliki data pendaftaran. Silakan lengkapi data pribadi terlebih dahulu.');
        window.location.href = '{{ route("profile.data-pribadi") }}';
        return;
    @endif
    
    const formData = new FormData();
    formData.append('pendaftar_id', {{ $pendaftaran->id ?? 0 }});
    formData.append('jenis', jenis);
    formData.append('file', input.files[0]);
    formData.append('_token', '{{ csrf_token() }}');
    
    // Show loading
    const uploadArea = input.closest('.upload-area');
    const originalContent = uploadArea.innerHTML;
    uploadArea.innerHTML = '<i class="fas fa-spinner fa-spin fa-2x"></i><br>Mengupload...';
    
    fetch('{{ route("berkas.upload") }}', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Gagal upload berkas');
            uploadArea.innerHTML = originalContent;
        }
    })
    .catch(error => {
        console.error('Upload error:', error);
        alert('Terjadi kesalahan saat upload: ' + error.message);
        uploadArea.innerHTML = originalContent;
    });
}

function replaceFile(berkasId, jenis) {
    document.getElementById('replaceForm').action = `/berkas/${berkasId}/update`;
    new bootstrap.Modal(document.getElementById('replaceModal')).show();
}

// Drag and drop functionality
document.querySelectorAll('.upload-area').forEach(area => {
    area.addEventListener('dragover', (e) => {
        e.preventDefault();
        area.classList.add('dragover');
    });
    
    area.addEventListener('dragleave', () => {
        area.classList.remove('dragover');
    });
    
    area.addEventListener('drop', (e) => {
        e.preventDefault();
        area.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const input = area.querySelector('input[type="file"]');
            input.files = files;
            input.dispatchEvent(new Event('change'));
        }
    });
});
</script>
@endsection