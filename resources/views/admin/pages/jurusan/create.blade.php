@extends('admin.admin')

@section('title', 'Tambah Jurusan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Jurusan</h3>
    </div>
    <form action="{{ route('admin.jurusan.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="kode_jurusan">Kode Jurusan</label>
                <input type="text" class="form-control @error('kode_jurusan') is-invalid @enderror" 
                       id="kode_jurusan" name="kode_jurusan" value="{{ old('kode_jurusan') }}" required>
                @error('kode_jurusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama_jurusan">Nama Jurusan</label>
                <input type="text" class="form-control @error('nama_jurusan') is-invalid @enderror" 
                       id="nama_jurusan" name="nama_jurusan" value="{{ old('nama_jurusan') }}" required>
                @error('nama_jurusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kuota">Kuota</label>
                <input type="number" class="form-control @error('kuota') is-invalid @enderror" 
                       id="kuota" name="kuota" value="{{ old('kuota') }}" min="1" required>
                @error('kuota')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" 
                           {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection