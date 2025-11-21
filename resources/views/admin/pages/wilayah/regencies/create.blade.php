@extends('admin.admin')

@section('title', 'Tambah Kabupaten/Kota')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Kabupaten/Kota</h3>
    </div>
    <form action="{{ route('admin.regencies.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id">ID Kabupaten/Kota</label>
                        <input type="text" class="form-control @error('id') is-invalid @enderror" 
                               id="id" name="id" value="{{ old('id') }}" maxlength="4" placeholder="1101" required>
                        @error('id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="province_id">Provinsi</label>
                        <select class="form-control @error('province_id') is-invalid @enderror" id="province_id" name="province_id" required>
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                    {{ $province->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('province_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Nama Kabupaten/Kota</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" placeholder="KABUPATEN ACEH SELATAN" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.regencies.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
