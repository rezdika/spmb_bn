@extends('panitia.panitia')

@section('title', 'Profil Saya')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama_lengkap) }}&background=1B1A55&color=fff&size=150" 
                     class="img-circle mb-3" alt="Profile Picture" style="width: 150px; height: 150px;">
                <h4 class="font-weight-bold">{{ auth()->user()->nama_lengkap }}</h4>
                <p class="text-muted">Panitia</p>
                <p class="text-sm">
                    <i class="fas fa-envelope mr-1"></i> {{ auth()->user()->email }}<br>
                    @if(auth()->user()->no_hp)
                    <i class="fas fa-phone mr-1"></i> {{ auth()->user()->no_hp }}<br>
                    @endif
                    <i class="fas fa-calendar mr-1"></i> Bergabung {{ auth()->user()->created_at->format('d M Y') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user mr-2"></i>Informasi Profil</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('panitia.profile.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" 
                                       value="{{ old('nama_lengkap', auth()->user()->nama_lengkap) }}" required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" 
                                       value="{{ old('email', auth()->user()->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_hp">Nomor HP</label>
                                <input type="tel" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" 
                                       value="{{ old('no_hp', auth()->user()->no_hp) }}" placeholder="08xxxxxxxxxx">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" class="form-control" value="Panitia" readonly>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-lock mr-2"></i>Ganti Password</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('panitia.profile.password.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="current_password">Password Saat Ini</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_password">Password Baru</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key mr-1"></i>Ganti Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
