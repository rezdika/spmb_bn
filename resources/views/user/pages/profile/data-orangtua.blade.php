@extends('user.main')

@section('title', 'Data Orang Tua - PPDB SMK Bakti Nusantara 666')

@section('hero')
<section class="text-white py-5 position-relative" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="position-absolute w-100 h-100" style="background: url('{{ asset('assets/image/hero_section/sekolah1.png') }}'); background-size: cover; background-position: center; filter: blur(3px); z-index: -1;"></div>
    <div class="container py-5 position-relative">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8">
                <div class="badge mb-3 px-3 py-2" style="background-color: #F5E8C7; color: #1B1A55;">
                    <i class="fas fa-users me-2"></i>Data Orang Tua
                </div>
                <h1 class="display-4 fw-bold mb-4">Data <span style="color: #F5E8C7;">Orang Tua</span></h1>
                <p class="lead mb-4 opacity-90">Lengkapi data orang tua/wali untuk pendaftaran PPDB.</p>
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
        
        <div class="row g-4">
            <!-- Left Sidebar -->
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
                            <a href="{{ route('profile.data-orangtua') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3 active">
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
                            <a href="{{ route('profile.upload-berkas') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                                <i class="fas fa-file-upload me-3" style="color: #1B1A55;"></i>
                                <div>
                                    <h6 class="mb-1">Upload Berkas</h6>
                                    <small class="text-muted">Dokumen pendaftaran</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Information Card -->
                <div class="card border-0 shadow">
                    <div class="card-header py-3" style="background-color: #637AB9; color: #1B1A55;">
                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Penting</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <h6 class="fw-bold" style="color: #1B1A55;">Data Orang Tua</h6>
                            <p class="small text-muted mb-0">Lengkapi data orang tua/wali dengan benar sesuai dokumen resmi.</p>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <h6 class="fw-bold" style="color: #1B1A55;">Tips Pengisian:</h6>
                            <ul class="small text-muted mb-0">
                                <li>Nama sesuai KTP/Kartu Keluarga</li>
                                <li>Pekerjaan yang sebenarnya</li>
                                <li>Nomor HP yang aktif</li>
                                <li>Data wali jika diperlukan</li>
                            </ul>
                        </div>
                        <hr>
                        <div class="text-center">
                            <small class="text-muted">Data orang tua diperlukan untuk keperluan administrasi</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Content -->
            <div class="col-lg-8">
                <div class="card border-0 shadow">
                    <div class="card-header py-3" style="background-color: #1B1A55; color: white;">
                        <h5 class="mb-0"><i class="fas fa-users me-2"></i>Data Orang Tua/Wali</h5>
                    </div>
                    <div class="card-body p-4">
                <form action="{{ route('profile.data-orangtua.store') }}" method="POST">
                    @csrf
                    
                    <h6 class="fw-bold mb-3" style="color: #1B1A55;">Data Ayah</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-user me-2"></i>Nama Ayah
                            </label>
                            <input type="text" name="nama_ayah" class="form-control" value="{{ $dataOrtu->nama_ayah ?? '' }}" required maxlength="120">
                            @error('nama_ayah')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-briefcase me-2"></i>Pekerjaan Ayah
                            </label>
                            <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ $dataOrtu->pekerjaan_ayah ?? '' }}" required maxlength="100">
                            @error('pekerjaan_ayah')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-phone me-2"></i>HP Ayah
                            </label>
                            <input type="text" name="no_ayah" class="form-control" value="{{ $dataOrtu->no_ayah ?? '' }}" maxlength="20">
                            @error('no_ayah')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <h6 class="fw-bold mb-3" style="color: #1B1A55;">Data Ibu</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-user me-2"></i>Nama Ibu
                            </label>
                            <input type="text" name="nama_ibu" class="form-control" value="{{ $dataOrtu->nama_ibu ?? '' }}" required maxlength="120">
                            @error('nama_ibu')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-briefcase me-2"></i>Pekerjaan Ibu
                            </label>
                            <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ $dataOrtu->pekerjaan_ibu ?? '' }}" required maxlength="100">
                            @error('pekerjaan_ibu')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-phone me-2"></i>HP Ibu
                            </label>
                            <input type="text" name="no_ibu" class="form-control" value="{{ $dataOrtu->no_ibu ?? '' }}" maxlength="20">
                            @error('no_ibu')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <h6 class="fw-bold mb-3" style="color: #1B1A55;">Data Wali (Opsional)</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-user me-2"></i>Nama Wali
                            </label>
                            <input type="text" name="wali_nama" class="form-control" value="{{ $dataOrtu->wali_nama ?? '' }}" maxlength="120">
                            @error('wali_nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-phone me-2"></i>HP Wali
                            </label>
                            <input type="text" name="wali_hp" class="form-control" value="{{ $dataOrtu->wali_hp ?? '' }}" maxlength="20">
                            @error('wali_hp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-lg px-4 py-2" style="background-color: #1B1A55; color: white;">
                            <i class="fas fa-save me-2"></i>Simpan Data
                        </button>
                        <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary btn-lg px-4 py-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                    
                    @if($isProfileComplete)
                    <div class="alert alert-success mt-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="fw-bold mb-1">✅ Profile Lengkap!</h6>
                                <small>Semua data sudah lengkap. Anda dapat melanjutkan pendaftaran sekarang.</small>
                            </div>
                            <a href="{{ route('pendaftaran.index') }}" class="btn btn-success btn-lg">
                                <i class="fas fa-graduation-cap me-2"></i>Daftar Sekarang
                            </a>
                        </div>
                    </div>
                    @endif
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection