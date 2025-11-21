@extends('admin.admin')

@section('title', 'Edit Jurusan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Jurusan</h3>
        <div class="card-tools">
            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-sm" style="background-color: #F5E8C7; color: #1B1A55; border-color: #F5E8C7;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <form action="{{ route('admin.jurusan.update', $jurusan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kode_jurusan">Kode Jurusan</label>
                        <input type="text" class="form-control @error('kode_jurusan') is-invalid @enderror" 
                               id="kode_jurusan" name="kode_jurusan" value="{{ old('kode_jurusan', $jurusan->kode) }}" required>
                        @error('kode_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_jurusan">Nama Jurusan</label>
                        <input type="text" class="form-control @error('nama_jurusan') is-invalid @enderror" 
                               id="nama_jurusan" name="nama_jurusan" value="{{ old('nama_jurusan', $jurusan->nama) }}" required>
                        @error('nama_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kuota">Kuota</label>
                        <input type="number" class="form-control @error('kuota') is-invalid @enderror" 
                               id="kuota" name="kuota" value="{{ old('kuota', $jurusan->kuota) }}" required min="1">
                        @error('kuota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="is_active">Status</label>
                        <select class="form-control @error('is_active') is-invalid @enderror" id="is_active" name="is_active" required>
                            <option value="1" {{ old('is_active', $jurusan->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $jurusan->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $jurusan->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">
                <i class="fas fa-save"></i> Update Jurusan
            </button>
            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection