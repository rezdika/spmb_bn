@extends('admin.admin')

@section('title', 'Edit Kabupaten/Kota')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Kabupaten/Kota</h3>
        <div class="card-tools">
            <a href="{{ route('admin.regencies.index') }}" class="btn btn-sm" style="background-color: #F5E8C7; color: #1B1A55; border-color: #F5E8C7;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <form action="{{ route('admin.regencies.update', $regency) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id">ID Kabupaten/Kota</label>
                        <input type="text" class="form-control" id="id" value="{{ $regency->id }}" readonly>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="province_id">Provinsi</label>
                        <select class="form-control @error('province_id') is-invalid @enderror" id="province_id" name="province_id" required>
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}" {{ old('province_id', $regency->province_id) == $province->id ? 'selected' : '' }}>
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
                       id="name" name="name" value="{{ old('name', $regency->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">
                <i class="fas fa-save"></i> Update Kabupaten/Kota
            </button>
            <a href="{{ route('admin.regencies.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection
