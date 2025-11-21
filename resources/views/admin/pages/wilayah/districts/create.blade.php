@extends('admin.admin')

@section('title', 'Tambah Kecamatan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Kecamatan</h3>
    </div>
    <form action="{{ route('admin.districts.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id">ID Kecamatan</label>
                        <input type="text" class="form-control @error('id') is-invalid @enderror" 
                               id="id" name="id" value="{{ old('id') }}" maxlength="7" placeholder="1101010" required>
                        @error('id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="regency_id">Kabupaten/Kota</label>
                        <select class="form-control @error('regency_id') is-invalid @enderror" id="regency_id" name="regency_id" required>
                            <option value="">-- Pilih Kabupaten/Kota --</option>
                            @foreach($regencies as $regency)
                                <option value="{{ $regency->id }}" {{ old('regency_id') == $regency->id ? 'selected' : '' }}>
                                    {{ $regency->name }} ({{ $regency->province->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('regency_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Nama Kecamatan</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" placeholder="BAKONGAN" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.districts.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
