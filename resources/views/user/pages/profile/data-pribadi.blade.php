@extends('user.main')

@section('title', 'Data Pribadi - PPDB SMK Bakti Nusantara 666')

@section('hero')
<section class="text-white py-5 position-relative" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="position-absolute w-100 h-100" style="background: url('{{ asset('assets/image/hero_section/sekolah1.png') }}'); background-size: cover; background-position: center; filter: blur(3px); z-index: -1;"></div>
    <div class="container py-5 position-relative">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8">
                <div class="badge mb-3 px-3 py-2" style="background-color: #F5E8C7; color: #1B1A55;">
                    <i class="fas fa-user-edit me-2"></i>Data Pribadi
                </div>
                <h1 class="hero-title display-4 fw-bold mb-4">Data <span style="color: #F5E8C7;">Pribadi</span></h1>
                <p class="hero-subtitle lead mb-4 opacity-90">Lengkapi data pribadi untuk pendaftaran PPDB.</p>
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
                        <h6 class="text-clean mb-0"><i class="fas fa-list me-2"></i>Menu Profile</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('profile.data-pribadi') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3 active">
                                <i class="fas fa-user-edit me-3" style="color: #1B1A55;"></i>
                                <div>
                                    <h6 class="text-modern mb-1">Data Pribadi</h6>
                                    <small class="text-muted text-readable">Lengkapi identitas diri</small>
                                </div>
                            </a>
                            <a href="{{ route('profile.data-orangtua') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                                <i class="fas fa-users me-3" style="color: #1B1A55;"></i>
                                <div>
                                    <h6 class="text-modern mb-1">Data Orang Tua</h6>
                                    <small class="text-muted text-readable">Informasi orang tua/wali</small>
                                </div>
                            </a>
                            <a href="{{ route('profile.asal-sekolah') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                                <i class="fas fa-school me-3" style="color: #1B1A55;"></i>
                                <div>
                                    <h6 class="text-modern mb-1">Asal Sekolah</h6>
                                    <small class="text-muted text-readable">Data sekolah sebelumnya</small>
                                </div>
                            </a>
                            <a href="{{ route('profile.upload-berkas') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                                <i class="fas fa-file-upload me-3" style="color: #1B1A55;"></i>
                                <div>
                                    <h6 class="text-modern mb-1">Upload Berkas</h6>
                                    <small class="text-muted text-readable">Dokumen pendaftaran</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Information Card -->
                <div class="card border-0 shadow">
                    <div class="card-header py-3" style="background-color: #637AB9; color: #1B1A55;">
                        <h6 class="text-clean mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Penting</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <h6 class="text-modern fw-bold" style="color: #1B1A55;">Data Pribadi</h6>
                            <p class="small text-readable text-muted mb-0">Lengkapi semua data pribadi dengan benar sesuai dokumen resmi.</p>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <h6 class="text-modern fw-bold" style="color: #1B1A55;">Tips Pengisian:</h6>
                            <ul class="small text-muted mb-0">
                                <li>NIK sesuai KTP/Kartu Keluarga</li>
                                <li>NISN dari sekolah asal</li>
                                <li>Email aktif untuk notifikasi</li>
                                <li>Nomor HP yang bisa dihubungi</li>
                            </ul>
                        </div>
                        <hr>
                        <div class="text-center">
                            <small class="text-muted">Pastikan data yang diisi sudah benar sebelum menyimpan</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Content -->
            <div class="col-lg-8">
                <div class="card border-0 shadow">
                    <div class="card-header py-3" style="background-color: #1B1A55; color: white;">
                        <h5 class="text-elegant mb-0"><i class="fas fa-user-edit me-2"></i>Data Pribadi</h5>
                    </div>
                    <div class="card-body p-4">
                <form action="{{ route('profile.data-pribadi.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #1B1A55;">
                            <i class="fas fa-user me-2"></i>Nama Lengkap
                        </label>
                        <input type="text" name="nama_lengkap" class="form-control" value="{{ $user->nama_lengkap }}" required>
                        @error('nama_lengkap')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #1B1A55;">
                            <i class="fas fa-envelope me-2"></i>Email
                        </label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #1B1A55;">
                            <i class="fas fa-phone me-2"></i>Nomor HP
                        </label>
                        <input type="tel" name="no_hp" class="form-control" value="{{ $user->no_hp }}" required>
                        @error('no_hp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <hr class="my-4">
                    <h6 class="fw-bold mb-3" style="color: #1B1A55;">Data Identitas</h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-id-card me-2"></i>NIK
                            </label>
                            <input type="text" name="nik" class="form-control" value="{{ $dataSiswa->nik ?? '' }}" required maxlength="16">
                            @error('nik')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-school me-2"></i>NISN
                            </label>
                            <input type="text" name="nisn" class="form-control" value="{{ $dataSiswa->nisn ?? '' }}" maxlength="10">
                            @error('nisn')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-venus-mars me-2"></i>Jenis Kelamin
                            </label>
                            <select name="jk" class="form-control" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ ($dataSiswa->jk ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ ($dataSiswa->jk ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-calendar me-2"></i>Tanggal Lahir
                            </label>
                            @php
                            $tglLahir = $dataSiswa->tgl_lahir ?? '';
                            if ($tglLahir) {
                                $tglLahir = \Carbon\Carbon::parse($tglLahir)->format('Y-m-d');
                            }
                            @endphp
                            <input type="date" name="tgl_lahir" class="form-control" value="{{ $tglLahir }}" required>
                            @error('tgl_lahir')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #1B1A55;">
                            <i class="fas fa-map-marker-alt me-2"></i>Tempat Lahir
                        </label>
                        <input type="text" name="tmp_lahir" class="form-control" value="{{ $dataSiswa->tmp_lahir ?? '' }}" required maxlength="60">
                        @error('tmp_lahir')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #1B1A55;">
                            <i class="fas fa-home me-2"></i>Alamat Lengkap
                        </label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required>{{ $dataSiswa->alamat ?? '' }}</textarea>
                        @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <hr class="my-4">
                    <h6 class="fw-bold mb-3" style="color: #1B1A55;">Wilayah Domisili</h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-map me-2"></i>Provinsi
                            </label>
                            <select name="provinsi" id="provinsi" class="form-control" required>
                                <option value="">Pilih Provinsi</option>
                                @foreach($provinsiList as $provinsi)
                                    <option value="{{ $provinsi->id }}" {{ ($dataSiswa && $dataSiswa->village && $dataSiswa->village->district->regency->province_id == $provinsi->id) ? 'selected' : '' }}>{{ $provinsi->name }}</option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-map-marker me-2"></i>Kabupaten/Kota
                            </label>
                            <select name="kabupaten" id="kabupaten" class="form-control" required disabled>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                            @error('kabupaten')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-location-arrow me-2"></i>Kecamatan
                            </label>
                            <select name="kecamatan" id="kecamatan" class="form-control" required disabled>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            @error('kecamatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color: #1B1A55;">
                                <i class="fas fa-map-pin me-2"></i>Kelurahan/Desa
                            </label>
                            <select name="kelurahan" id="kelurahan" class="form-control" required disabled>
                                <option value="">Pilih Kelurahan/Desa</option>
                            </select>
                            @error('kelurahan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <input type="hidden" name="village_id" id="village_id" value="{{ $dataSiswa->village_id ?? '' }}">
                    
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const provinsiSelect = document.getElementById('provinsi');
    const kabupatenSelect = document.getElementById('kabupaten');
    const kecamatanSelect = document.getElementById('kecamatan');
    const kelurahanSelect = document.getElementById('kelurahan');
    const villageIdInput = document.getElementById('village_id');
    
    // Load existing data if available
    @if($dataSiswa && $dataSiswa->village)
        const existingData = {
            provinceId: '{{ $dataSiswa->village->district->regency->province_id }}',
            regencyId: '{{ $dataSiswa->village->district->regency_id }}',
            districtId: '{{ $dataSiswa->village->district_id }}',
            villageId: '{{ $dataSiswa->village_id }}'
        };
        
        // Load kabupaten
        if (existingData.provinceId) {
            loadKabupaten(existingData.provinceId, existingData.regencyId);
        }
    @endif
    
    function loadKabupaten(provinceId, selectedRegencyId = '') {
        fetch(`/api/regencies/${provinceId}`)
            .then(response => response.json())
            .then(data => {
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                data.forEach(regency => {
                    const selected = regency.id === selectedRegencyId ? 'selected' : '';
                    kabupatenSelect.innerHTML += `<option value="${regency.id}" ${selected}>${regency.name}</option>`;
                });
                kabupatenSelect.disabled = false;
                
                if (selectedRegencyId) {
                    loadKecamatan(selectedRegencyId, '{{ $dataSiswa && $dataSiswa->village ? $dataSiswa->village->district_id : "" }}');
                }
            });
    }
    
    function loadKecamatan(regencyId, selectedDistrictId = '') {
        fetch(`/api/districts/${regencyId}`)
            .then(response => response.json())
            .then(data => {
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                data.forEach(district => {
                    const selected = district.id === selectedDistrictId ? 'selected' : '';
                    kecamatanSelect.innerHTML += `<option value="${district.id}" ${selected}>${district.name}</option>`;
                });
                kecamatanSelect.disabled = false;
                
                if (selectedDistrictId) {
                    loadKelurahan(selectedDistrictId, '{{ $dataSiswa && $dataSiswa->village ? $dataSiswa->village_id : "" }}');
                }
            });
    }
    
    function loadKelurahan(districtId, selectedVillageId = '') {
        fetch(`/api/villages/${districtId}`)
            .then(response => response.json())
            .then(data => {
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                data.forEach(village => {
                    const selected = village.id === selectedVillageId ? 'selected' : '';
                    kelurahanSelect.innerHTML += `<option value="${village.id}" ${selected}>${village.name}</option>`;
                });
                kelurahanSelect.disabled = false;
                
                if (selectedVillageId) {
                    document.getElementById('village_id').value = selectedVillageId;
                }
            });
    }
    
    provinsiSelect.addEventListener('change', function() {
        const provinceId = this.value;
        if (provinceId) {
            loadKabupaten(provinceId);
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kecamatanSelect.disabled = true;
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            kelurahanSelect.disabled = true;
        }
    });
    
    kabupatenSelect.addEventListener('change', function() {
        const regencyId = this.value;
        if (regencyId) {
            loadKecamatan(regencyId);
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            kelurahanSelect.disabled = true;
        }
    });
    
    kecamatanSelect.addEventListener('change', function() {
        const districtId = this.value;
        if (districtId) {
            loadKelurahan(districtId);
        }
    });
    
    kelurahanSelect.addEventListener('change', function() {
        const villageId = this.value;
        if (villageId) {
            document.getElementById('village_id').value = villageId;
        }
    });
});
</script>
@endsection