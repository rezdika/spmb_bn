@extends('user.main')

@section('title', 'Pendaftaran PPDB - SMK Bakti Nusantara 666')

@section('hero')
<section class="position-relative" style="height: 400px; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets/image/hero_section/sekolah1.png') }}'); background-size: cover; background-position: center;">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="badge bg-light text-primary mb-3 px-3 py-2">
                    <i class="fas fa-user-plus me-2"></i>Pendaftaran PPDB 2025/2026
                </div>
                <h1 class="display-4 fw-bold mb-4 text-white">Form <span style="color: #F5E8C7;">Pendaftaran</span></h1>
                <p class="lead mb-4 opacity-90">Lengkapi form pendaftaran dengan data yang sudah tersimpan di profile Anda.</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-lg-4 mb-4">
                @if(!$profileComplete)
                <div class="alert alert-warning mb-4">
                    <h6 class="fw-bold mb-2">⚠️ Profile Belum Lengkap</h6>
                    <p class="mb-2 small">Untuk dapat mendaftar, Anda harus melengkapi:</p>
                    <ul class="mb-3 small">
                        @foreach($missingFields as $field)
                        <li>{{ $field }}</li>
                        @endforeach
                    </ul>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('profile.data-pribadi') }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-user me-1"></i>Lengkapi Data Pribadi
                        </a>
                        <a href="{{ route('profile.data-orangtua') }}" class="btn btn-sm btn-info">
                            <i class="fas fa-users me-1"></i>Data Orang Tua
                        </a>
                        <a href="{{ route('profile.asal-sekolah') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-school me-1"></i>Asal Sekolah
                        </a>
                        <a href="{{ route('profile.upload-berkas') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-file-upload me-1"></i>Upload Berkas
                        </a>
                    </div>
                </div>
                @else
                <div class="alert alert-success mb-4">
                    <h6 class="fw-bold mb-2">✅ Profile Lengkap</h6>
                    <p class="mb-0 small">Semua data sudah lengkap. Anda dapat melanjutkan pendaftaran.</p>
                </div>
                @endif
                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">📋 Progress Pendaftaran</h5>
                        <div class="d-flex align-items-center mb-3">
                            <div class="{{ $profileComplete ? 'bg-success' : 'bg-warning' }} rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px;">
                                <i class="fas fa-{{ $profileComplete ? 'check' : 'exclamation' }} text-white small"></i>
                            </div>
                            <span>Profile {{ $profileComplete ? 'Lengkap' : 'Belum Lengkap' }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px;">
                                <span class="text-white small">2</span>
                            </div>
                            <span class="fw-bold">Form Pendaftaran</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px;">
                                <span class="text-white small">3</span>
                            </div>
                            <span class="text-muted">Konfirmasi</span>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3" style="color: #1B1A55;">💡 Langkah Pendaftaran</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2">1️⃣ Lengkapi data pribadi di profile</li>
                            <li class="mb-2">2️⃣ Isi data orang tua/wali</li>
                            <li class="mb-2">3️⃣ Masukkan data asal sekolah</li>
                            <li class="mb-2">4️⃣ Upload berkas wajib (min 3)</li>
                            <li class="mb-2">5️⃣ Pilih jurusan dan gelombang</li>
                            <li class="mb-0">6️⃣ Submit pendaftaran</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Content -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4" style="color: #1B1A55;">Form Pendaftaran PPDB</h4>

                        @if(session('error'))
                            <div class="alert alert-danger mb-4">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            </div>
                        @endif
                        
                        @if($errors->any())
                            <div class="alert alert-danger mb-4">
                                <h6 class="fw-bold mb-2">Terjadi kesalahan:</h6>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('pendaftaran.store') }}" method="POST">
                            @csrf
                            
                            <!-- Data Pribadi (Auto-filled) -->
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3" style="color: #1B1A55;">📋 Data Pribadi</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" value="{{ $user->nama_lengkap }}" readonly style="background-color: #f8f9fa;">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="{{ $user->email }}" readonly style="background-color: #f8f9fa;">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">No. HP</label>
                                        <input type="text" class="form-control" value="{{ $user->no_hp }}" readonly style="background-color: #f8f9fa;">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <input type="text" class="form-control" value="Siap Mendaftar" readonly style="background-color: #f8f9fa;">
                                    </div>
                                </div>
                            </div>

                            <!-- Pilihan Jurusan -->
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3" style="color: #1B1A55;">🎓 Pilihan Jurusan</h6>
                                <div class="row">
                                    @foreach($jurusans as $jurusan)
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jurusan_id" id="jurusan{{ $jurusan->id }}" 
                                                   value="{{ $jurusan->id }}" {{ $selectedJurusan == $jurusan->id ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="jurusan{{ $jurusan->id }}">
                                                <strong>{{ $jurusan->nama }}</strong><br>
                                                <small class="text-muted">{{ $jurusan->deskripsi }}</small>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Pilihan Gelombang -->
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3" style="color: #1B1A55;">📅 Pilihan Gelombang</h6>
                                @foreach($gelombangs as $gelombang)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gelombang_id" id="gelombang{{ $gelombang->id }}" 
                                                   value="{{ $gelombang->id }}" required>
                                            <label class="form-check-label w-100" for="gelombang{{ $gelombang->id }}">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ $gelombang->nama }}</strong><br>
                                                        <small class="text-muted">{{ $gelombang->tgl_mulai->format('d M Y') }} - {{ $gelombang->tgl_selesai->format('d M Y') }}</small>
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="badge" style="background-color: #1B1A55;">Rp {{ number_format($gelombang->biaya_daftar, 0, ',', '.') }}</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Profile
                                </a>
                                @if($profileComplete)
                                <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Pendaftaran
                                </button>
                                @else
                                <div class="d-flex flex-column">
                                    <button type="button" class="btn btn-secondary px-4 mb-2" disabled>
                                        <i class="fas fa-lock me-2"></i>Lengkapi Profile Dulu
                                    </button>
                                    <small class="text-muted text-center">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Tombol akan aktif setelah profile lengkap
                                    </small>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submitBtn');
    
    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            // Disable button to prevent double submit
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            
            // Check if required fields are selected
            const jurusan = document.querySelector('input[name="jurusan_id"]:checked');
            const gelombang = document.querySelector('input[name="gelombang_id"]:checked');
            
            if (!jurusan) {
                e.preventDefault();
                alert('Pilih jurusan terlebih dahulu!');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Submit Pendaftaran';
                return;
            }
            
            if (!gelombang) {
                e.preventDefault();
                alert('Pilih gelombang terlebih dahulu!');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Submit Pendaftaran';
                return;
            }
            
            console.log('Form submitted with:', {
                jurusan_id: jurusan.value,
                gelombang_id: gelombang.value
            });
        });
    }
});
</script>
@endsection