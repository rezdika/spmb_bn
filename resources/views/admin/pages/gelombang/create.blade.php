@extends('admin.admin')

@section('title', 'Tambah Gelombang')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Gelombang</h3>
    </div>
    <form action="{{ route('admin.gelombang.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama_gelombang">Nama Gelombang</label>
                <input type="text" class="form-control @error('nama_gelombang') is-invalid @enderror" 
                       id="nama_gelombang" name="nama_gelombang" value="{{ old('nama_gelombang') }}" required>
                @error('nama_gelombang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="number" class="form-control @error('tahun') is-invalid @enderror" 
                       id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}" min="2000" max="2100" readonly>
                @error('tahun')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                               id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                               id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="biaya_pendaftaran">Biaya Pendaftaran</label>
                <input type="number" class="form-control @error('biaya_pendaftaran') is-invalid @enderror" 
                       id="biaya_pendaftaran" name="biaya_pendaftaran" value="{{ old('biaya_pendaftaran') }}" min="0" required>
                @error('biaya_pendaftaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="">Pilih Status</option>
                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.gelombang.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<script>
    const tanggalMulaiInput = document.getElementById('tanggal_mulai');
    const tahunInput = document.getElementById('tahun');

    function updateTahun() {
        if (tanggalMulaiInput.value) {
            const date = new Date(tanggalMulaiInput.value);
            tahunInput.value = date.getFullYear();
        }
    }

    tanggalMulaiInput.addEventListener('change', updateTahun);
    
    // Set tahun on page load if tanggal_mulai has value
    window.addEventListener('load', updateTahun);
</script>
@endsection