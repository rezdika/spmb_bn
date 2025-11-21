@extends('admin.admin')

@section('title', 'Edit Prestasi')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Prestasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.prestasi.index') }}">Prestasi</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('admin.prestasi.update', $prestasi) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Judul Prestasi <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $prestasi->title) }}" required>
                                @error('title')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $prestasi->category) }}" required>
                                @error('category')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Siswa <span class="text-danger">*</span></label>
                                <input type="text" name="student_name" class="form-control @error('student_name') is-invalid @enderror" value="{{ old('student_name', $prestasi->student_name) }}" required>
                                @error('student_name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kelas <span class="text-danger">*</span></label>
                                <input type="text" name="class" class="form-control @error('class') is-invalid @enderror" value="{{ old('class', $prestasi->class) }}" required>
                                @error('class')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Prestasi <span class="text-danger">*</span></label>
                                <input type="date" name="achievement_date" class="form-control @error('achievement_date') is-invalid @enderror" value="{{ old('achievement_date', $prestasi->achievement_date->format('Y-m-d')) }}" required>
                                @error('achievement_date')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Penyelenggara <span class="text-danger">*</span></label>
                                <input type="text" name="organizer" class="form-control @error('organizer') is-invalid @enderror" value="{{ old('organizer', $prestasi->organizer) }}" required>
                                @error('organizer')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Level <span class="text-danger">*</span></label>
                                <select name="level" class="form-control @error('level') is-invalid @enderror" required>
                                    <option value="Sekolah" {{ $prestasi->level == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                                    <option value="Kecamatan" {{ $prestasi->level == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                                    <option value="Kabupaten" {{ $prestasi->level == 'Kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                                    <option value="Provinsi" {{ $prestasi->level == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                    <option value="Nasional" {{ $prestasi->level == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                    <option value="Internasional" {{ $prestasi->level == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                </select>
                                @error('level')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Singkat <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description', $prestasi->description) }}</textarea>
                        @error('description')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Lengkap</label>
                        <textarea name="full_description" class="form-control @error('full_description') is-invalid @enderror" rows="5">{{ old('full_description', $prestasi->full_description) }}</textarea>
                        @error('full_description')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gambar Prestasi</label>
                                @if($prestasi->image)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($prestasi->image) }}" alt="Current" style="max-width: 200px;">
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                                @error('image')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" required>
                                    <option value="1" {{ $prestasi->is_active ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ !$prestasi->is_active ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('is_active')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
