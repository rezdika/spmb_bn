@extends('admin.admin')

@section('title', 'Edit Kecamatan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Kecamatan</h3>
        <div class="card-tools">
            <a href="{{ route('admin.districts.index') }}" class="btn btn-sm" style="background-color: #F5E8C7; color: #1B1A55; border-color: #F5E8C7;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <form action="{{ route('admin.districts.update', $district) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id">ID Kecamatan</label>
                        <input type="text" class="form-control" id="id" value="{{ $district->id }}" readonly>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="regency_id">Kabupaten/Kota</label>
                        <select class="form-control @error('regency_id') is-invalid @enderror" id="regency_id" name="regency_id" required>
                            <option value="">-- Pilih Kabupaten/Kota --</option>
                            @foreach($regencies as $regency)
                                <option value="{{ $regency->id }}" {{ old('regency_id', $district->regency_id) == $regency->id ? 'selected' : '' }}>
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
                       id="name" name="name" value="{{ old('name', $district->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">
                <i class="fas fa-save"></i> Update Kecamatan
            </button>
            <a href="{{ route('admin.districts.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection
