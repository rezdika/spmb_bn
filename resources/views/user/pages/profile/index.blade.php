@extends('user.main')

@section('title', 'Profile - PPDB SMK Bakti Nusantara 666')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/jadwal.css') }}">
@endsection

@section('hero')
<section class="text-white py-5 position-relative" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="position-absolute w-100 h-100" style="background: url('{{ asset('assets/image/hero_section/sekolah_bn.jpg') }}'); background-size: cover; background-position: center; filter: blur(3px); z-index: -1;"></div>
    <div class="container py-5 position-relative">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8">
                <div class="badge mb-3 px-3 py-2" style="background-color: #F5E8C7; color: #1B1A55;">
                    <i class="fas fa-user me-2"></i>Profile Pendaftar
                </div>
                <h1 class="display-4 fw-bold mb-4">Profile <span style="color: #F5E8C7;">{{ explode(' ', Auth::user()->nama_lengkap)[0] }}</span></h1>
                <p class="lead mb-4 opacity-90">Kelola data pribadi dan informasi pendaftaran PPDB Anda.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('home') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                        <i class="fas fa-home me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<!-- Profile Layout -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success mb-4">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif
        
        <div class="row g-4">
            <!-- Left Panel - Photo & Basic Info -->
            <div class="col-lg-4">
                <div class="card border-0 shadow">
                    <div class="card-body p-4 text-center">
                        <!-- Profile Photo -->
                        <div class="mb-4">
                            <div class="position-relative d-inline-block">
                                @if(Auth::user()->foto_profile)
                                    <img src="{{ asset('storage/' . Auth::user()->foto_profile) }}" 
                                         class="rounded-circle" 
                                         style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #1B1A55;" 
                                         alt="Profile Photo">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 150px; height: 150px; background: linear-gradient(135deg, #1B1A55 0%, #2d2a6b 100%); border: 4px solid #1B1A55; font-size: 3rem; font-weight: bold; color: white;">
                                        {{ strtoupper(substr(explode(' ', Auth::user()->nama_lengkap)[0], 0, 1)) }}{{ strtoupper(substr(explode(' ', Auth::user()->nama_lengkap)[1] ?? '', 0, 1)) }}
                                    </div>
                                @endif
                                <button type="button" class="btn btn-sm position-absolute bottom-0 end-0" 
                                        style="background-color: #1B1A55; color: white; border-radius: 50%; width: 40px; height: 40px;"
                                        onclick="document.getElementById('foto_profile').click()">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Basic Info -->
                        <h4 class="fw-bold mb-2" style="color: #1B1A55;">{{ $user->nama_lengkap }}</h4>
                        <p class="text-muted mb-3">{{ $user->email }}</p>
                        
                        <!-- Status Badges -->
                        <div class="mb-4">
                            <span class="badge fs-6 me-2 mb-2" style="background-color: #1B1A55; color: white;">Akun Aktif</span><br>
                            <span class="badge fs-6" style="background-color: #F5E8C7; color: #1B1A55;">Terdaftar: {{ $user->created_at->format('d M Y') }}</span>
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="row g-3 text-center">
                            <div class="col-4">
                                <div class="p-2" style="background-color: #f8f9fa; border-radius: 8px;">
                                    @php
                                        $progress = 0;
                                        if($pendaftaran) {
                                            if($pendaftaran->dataSiswa && !empty($pendaftaran->dataSiswa->nik)) $progress += 25;
                                            if($pendaftaran->dataOrtu && !empty($pendaftaran->dataOrtu->nama_ayah)) $progress += 25;
                                            if($pendaftaran->asalSekolah && !empty($pendaftaran->asalSekolah->nama_sekolah)) $progress += 25;
                                            if($pendaftaran->berkas->where('status', 'approved')->count() >= 3) $progress += 25;
                                        }
                                    @endphp
                                    <h6 class="fw-bold mb-1" style="color: {{ $progress == 100 ? '#28a745' : '#1B1A55' }};">
                                        {{ $progress }}%
                                    </h6>
                                    <small class="text-muted">Profil Lengkap</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2" style="background-color: #f8f9fa; border-radius: 8px;">
                                    <h6 class="fw-bold mb-1" style="color: #1B1A55;">{{ $pendaftaran ? $pendaftaran->berkas->count() : 0 }}/4</h6>
                                    <small class="text-muted">Berkas</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2" style="background-color: #f8f9fa; border-radius: 8px;">
                                    <h6 class="fw-bold mb-1" style="color: #1B1A55;">{{ $pendaftaran ? $pendaftaran->status : 'Belum Daftar' }}</h6>
                                    <small class="text-muted">Status</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Profile -->
                <div class="card border-0 shadow mt-4">
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('profile.data-pribadi') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                                <i class="fas fa-user-edit me-3" style="color: #1B1A55;"></i>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Data Pribadi</h6>
                                    <small class="text-muted">Lengkapi identitas diri</small>
                                </div>
                                @if($pendaftaran && $pendaftaran->dataSiswa && !empty($pendaftaran->dataSiswa->nik))
                                    <i class="fas fa-check-circle text-success"></i>
                                @else
                                    <i class="fas fa-exclamation-circle text-warning"></i>
                                @endif
                            </a>
                            <a href="{{ route('profile.data-orangtua') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                                <i class="fas fa-users me-3" style="color: #1B1A55;"></i>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Data Orang Tua</h6>
                                    <small class="text-muted">Informasi orang tua/wali</small>
                                </div>
                                @if($pendaftaran && $pendaftaran->dataOrtu && !empty($pendaftaran->dataOrtu->nama_ayah))
                                    <i class="fas fa-check-circle text-success"></i>
                                @else
                                    <i class="fas fa-exclamation-circle text-warning"></i>
                                @endif
                            </a>
                            <a href="{{ route('profile.asal-sekolah') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                                <i class="fas fa-school me-3" style="color: #1B1A55;"></i>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Asal Sekolah</h6>
                                    <small class="text-muted">Data sekolah sebelumnya</small>
                                </div>
                                @if($pendaftaran && $pendaftaran->asalSekolah && !empty($pendaftaran->asalSekolah->nama_sekolah))
                                    <i class="fas fa-check-circle text-success"></i>
                                @else
                                    <i class="fas fa-exclamation-circle text-warning"></i>
                                @endif
                            </a>
                            <a href="{{ route('profile.upload-berkas') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                                <i class="fas fa-file-upload me-3" style="color: #1B1A55;"></i>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Upload Berkas</h6>
                                    <small class="text-muted">Dokumen pendaftaran ({{ $pendaftaran ? $pendaftaran->berkas->count() : 0 }}/4)</small>
                                </div>
                                @if($pendaftaran && $pendaftaran->berkas->count() >= 3)
                                    <i class="fas fa-check-circle text-success"></i>
                                @else
                                    <i class="fas fa-exclamation-circle text-warning"></i>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Panel - Profile Information & Edit Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow">
                    <div class="card-header py-3" style="background-color: #1B1A55; color: white;">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Profile</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <!-- Hidden File Input -->
                            <input type="file" id="foto_profile" name="foto_profile" accept="image/*" style="display: none;" onchange="previewImage(this)">
                            
                            <!-- Photo Upload Section -->
                            <div class="mb-4">
                                <label class="form-label fw-bold" style="color: #1B1A55;">
                                    <i class="fas fa-camera me-2"></i>Foto Profile
                                </label>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="position-relative">
                                        @if(Auth::user()->foto_profile)
                                            <img id="preview" src="{{ asset('storage/' . Auth::user()->foto_profile) }}" 
                                                 class="rounded-circle" 
                                                 style="width: 80px; height: 80px; object-fit: cover; border: 2px solid #1B1A55;" 
                                                 alt="Preview">
                                        @else
                                            <div id="preview" class="rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 80px; height: 80px; background: linear-gradient(135deg, #1B1A55 0%, #2d2a6b 100%); border: 2px solid #1B1A55; font-size: 1.5rem; font-weight: bold; color: white;">
                                                {{ strtoupper(substr(explode(' ', Auth::user()->nama_lengkap)[0], 0, 1)) }}{{ strtoupper(substr(explode(' ', Auth::user()->nama_lengkap)[1] ?? '', 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('foto_profile').click()">
                                            <i class="fas fa-upload me-2"></i>Pilih Foto
                                        </button>
                                        <small class="text-muted d-block mt-1">Format: JPG, PNG. Max: 2MB</small>
                                    </div>
                                </div>
                                @error('foto_profile')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="color: #1B1A55;">
                                    <i class="fas fa-user me-2"></i>Nama Lengkap
                                </label>
                                <input type="text" name="nama_lengkap" class="form-control" value="{{ Auth::user()->nama_lengkap }}" required>
                                @error('nama_lengkap')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="color: #1B1A55;">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="color: #1B1A55;">
                                    <i class="fas fa-phone me-2"></i>Nomor HP
                                </label>
                                <input type="tel" name="no_hp" class="form-control" value="{{ Auth::user()->no_hp }}" required>
                                @error('no_hp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <hr class="my-4">
                            
                            <h6 class="fw-bold mb-3" style="color: #1B1A55;">Ubah Password (Opsional)</h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="color: #1B1A55;">
                                    <i class="fas fa-lock me-2"></i>Password Baru
                                </label>
                                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold" style="color: #1B1A55;">
                                    <i class="fas fa-lock me-2"></i>Konfirmasi Password Baru
                                </label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password baru">
                            </div>
                            
                            <div class="d-flex gap-3 flex-wrap">
                                <button type="submit" class="btn btn-lg px-4 py-2" style="background-color: #1B1A55; color: white;">
                                    <i class="fas fa-save me-2"></i>Update Profile
                                </button>
                                @php
                                    $isProfileComplete = false;
                                    if($pendaftaran) {
                                        $isProfileComplete = $pendaftaran->dataSiswa && !empty($pendaftaran->dataSiswa->nik) &&
                                                           $pendaftaran->dataOrtu && !empty($pendaftaran->dataOrtu->nama_ayah) &&
                                                           $pendaftaran->asalSekolah && !empty($pendaftaran->asalSekolah->nama_sekolah) &&
                                                           $pendaftaran->berkas->count() >= 3;
                                    }
                                @endphp
                                @if($isProfileComplete)
                                    <a href="{{ route('pendaftaran.index') }}" class="btn btn-success btn-lg px-4 py-2">
                                        <i class="fas fa-paper-plane me-2"></i>Daftar Sekarang
                                    </a>
                                @endif
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg px-4 py-2">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            preview.innerHTML = `<img src="${e.target.result}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover; border: 2px solid #1B1A55;" alt="Preview">`;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection