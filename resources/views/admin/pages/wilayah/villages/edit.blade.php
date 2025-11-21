@extends('admin.admin')

@section('title', 'Edit Kelurahan/Desa')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Kelurahan/Desa</h3>
        <div class="card-tools">
            <a href="{{ route('admin.villages.index') }}" class="btn btn-sm" style="background-color: #F5E8C7; color: #1B1A55; border-color: #F5E8C7;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <form action="{{ route('admin.villages.update', $village) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id">ID Kelurahan/Desa</label>
                        <input type="text" class="form-control" id="id" value="{{ $village->id }}" readonly>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="district_id">Kecamatan</label>
                        <select class="form-control @error('district_id') is-invalid @enderror" id="district_id" name="district_id" required>
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" {{ old('district_id', $village->district_id) == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }} - {{ $district->regency->name }} ({{ $district->regency->province->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('district_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Nama Kelurahan/Desa</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $village->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">
                <i class="fas fa-save"></i> Update Kelurahan/Desa
            </button>
            <a href="{{ route('admin.villages.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection
