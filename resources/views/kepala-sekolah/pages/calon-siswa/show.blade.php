@extends('kepala-sekolah.kepala-sekolah')

@section('title', 'Detail Calon Siswa')

@section('content')
<div class="mb-3">
    <a href="{{ route('kepala-sekolah.calon-siswa.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left mr-1"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($pendaftaran->user->nama_lengkap) }}&background=1B1A55&color=F5E8C7&size=150" 
                     class="img-circle mb-3" style="width: 150px; height: 150px;">
                <h4>{{ $pendaftaran->user->nama_lengkap }}</h4>
                <p class="text-muted">{{ $pendaftaran->no_pendaftaran }}</p>
                <p>
                    <strong>Jurusan:</strong> {{ $pendaftaran->jurusan->nama }}<br>
                    <strong>Gelombang:</strong> {{ $pendaftaran->gelombang->nama }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#data-siswa">Data Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#data-ortu">Data Orang Tua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#asal-sekolah">Asal Sekolah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#berkas">Berkas</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="data-siswa">
                        @if($pendaftaran->dataSiswa)
                            <table class="table table-bordered">
                                <tr><th width="200">NIK</th><td>{{ $pendaftaran->dataSiswa->nik }}</td></tr>
                                <tr><th>Nama Lengkap</th><td>{{ $pendaftaran->dataSiswa->nama }}</td></tr>
                                <tr><th>Tempat, Tanggal Lahir</th><td>{{ $pendaftaran->dataSiswa->tempat_lahir }}, {{ $pendaftaran->dataSiswa->tanggal_lahir }}</td></tr>
                                <tr><th>Jenis Kelamin</th><td>{{ $pendaftaran->dataSiswa->jenis_kelamin }}</td></tr>
                                <tr><th>Agama</th><td>{{ $pendaftaran->dataSiswa->agama }}</td></tr>
                                <tr><th>Alamat</th><td>{{ $pendaftaran->dataSiswa->alamat }}</td></tr>
                            </table>
                        @else
                            <p class="text-muted">Data siswa belum dilengkapi</p>
                        @endif
                    </div>

                    <div class="tab-pane fade" id="data-ortu">
                        @if($pendaftaran->dataOrtu)
                            <h5>Data Ayah</h5>
                            <table class="table table-bordered mb-3">
                                <tr><th width="200">Nama</th><td>{{ $pendaftaran->dataOrtu->nama_ayah }}</td></tr>
                                <tr><th>Pekerjaan</th><td>{{ $pendaftaran->dataOrtu->pekerjaan_ayah }}</td></tr>
                                <tr><th>No HP</th><td>{{ $pendaftaran->dataOrtu->no_hp_ayah }}</td></tr>
                            </table>
                            <h5>Data Ibu</h5>
                            <table class="table table-bordered">
                                <tr><th width="200">Nama</th><td>{{ $pendaftaran->dataOrtu->nama_ibu }}</td></tr>
                                <tr><th>Pekerjaan</th><td>{{ $pendaftaran->dataOrtu->pekerjaan_ibu }}</td></tr>
                                <tr><th>No HP</th><td>{{ $pendaftaran->dataOrtu->no_hp_ibu }}</td></tr>
                            </table>
                        @else
                            <p class="text-muted">Data orang tua belum dilengkapi</p>
                        @endif
                    </div>

                    <div class="tab-pane fade" id="asal-sekolah">
                        @if($pendaftaran->asalSekolah)
                            <table class="table table-bordered">
                                <tr><th width="200">Nama Sekolah</th><td>{{ $pendaftaran->asalSekolah->nama_sekolah }}</td></tr>
                                <tr><th>NPSN</th><td>{{ $pendaftaran->asalSekolah->npsn }}</td></tr>
                                <tr><th>Alamat</th><td>{{ $pendaftaran->asalSekolah->alamat_sekolah }}</td></tr>
                                <tr><th>Tahun Lulus</th><td>{{ $pendaftaran->asalSekolah->tahun_lulus }}</td></tr>
                            </table>
                        @else
                            <p class="text-muted">Data asal sekolah belum dilengkapi</p>
                        @endif
                    </div>

                    <div class="tab-pane fade" id="berkas">
                        @if($pendaftaran->berkas->count() > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Jenis Berkas</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendaftaran->berkas as $berkas)
                                        <tr>
                                            <td>{{ $berkas->jenis_berkas }}</td>
                                            <td>
                                                @if($berkas->status_verifikasi == 'diterima')
                                                    <span class="badge badge-success">Diterima</span>
                                                @elseif($berkas->status_verifikasi == 'ditolak')
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @else
                                                    <span class="badge badge-secondary">Menunggu</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ asset('storage/berkas/' . $berkas->file_path) }}" target="_blank" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">Belum ada berkas yang diupload</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
