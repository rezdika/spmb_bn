@extends('admin.admin')

@section('title', 'Tambah Kelurahan/Desa')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Kelurahan/Desa</h3>
    </div>
    <form action="{{ route('admin.villages.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id">ID Kelurahan/Desa</label>
                        <input type="text" class="form-control @error('id') is-invalid @enderror" 
                               id="id" name="id" value="{{ old('id') }}" maxlength="10" placeholder="1101010001" required>
                        @error('id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="district_id">Kecamatan</label>
                        <select class="form-control @error('district_id') is-invalid @enderror" id="district_id" name="district_id" required>
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>
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
                       id="name" name="name" value="{{ old('name') }}" placeholder="KEUDE BAKONGAN" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.villages.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
