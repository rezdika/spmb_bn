@extends('admin.admin')

@section('title', 'Tambah Provinsi')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Provinsi</h3>
    </div>
    <form action="{{ route('admin.provinces.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id">ID Provinsi</label>
                        <input type="text" class="form-control @error('id') is-invalid @enderror" 
                               id="id" name="id" value="{{ old('id') }}" maxlength="2" placeholder="11" required>
                        @error('id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="name">Nama Provinsi</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" placeholder="ACEH" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.provinces.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
