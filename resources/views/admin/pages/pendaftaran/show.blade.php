@extends('admin.admin')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-graduate mr-2"></i>Detail Pendaftaran</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.monitoring-berkas.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="200">No Pendaftaran</th>
                                <td>: {{ $pendaftaran->no_pendaftaran }}</td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>: {{ $pendaftaran->user->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>: {{ $pendaftaran->user->email }}</td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td>: {{ $pendaftaran->user->no_hp }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="200">Jurusan</th>
                                <td>: {{ $pendaftaran->jurusan->nama }}</td>
                            </tr>
                            <tr>
                                <th>Gelombang</th>
                                <td>: {{ $pendaftaran->gelombang->nama }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>: 
                                    @if($pendaftaran->status == 'SUBMIT')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($pendaftaran->status == 'ADM_PASS')
                                        <span class="badge badge-success">Disetujui</span>
                                    @elseif($pendaftaran->status == 'ADM_REJECT')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Daftar</th>
                                <td>: {{ $pendaftaran->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#berkas">Berkas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#data-siswa">Data Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#data-ortu">Data Orang Tua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#asal-sekolah">Asal Sekolah</a>
                    </li>
                </ul>

                <div class="tab-content mt-3">
                    <div id="berkas" class="tab-pane fade show active">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Berkas</th>
                                        <th>File</th>
                                        <th>Tanggal Upload</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendaftaran->berkas as $index => $berkas)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $berkas->jenis }}</td>
                                            <td>
                                                @php
                                                    $filePath = public_path('storage/' . $berkas->url);
                                                    $fileExists = file_exists($filePath);
                                                @endphp
                                                
                                                @if($fileExists)
                                                    <a href="{{ asset('storage/' . $berkas->url) }}" target="_blank" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                @else
                                                    <span class="btn btn-sm btn-secondary disabled">
                                                        <i class="fas fa-exclamation-triangle"></i> File Tidak Ditemukan
                                                    </span>
                                                @endif
                                                
                                                <small class="d-block text-muted mt-1">{{ $berkas->nama_file }}</small>
                                            </td>
                                            <td>{{ $berkas->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada berkas</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="data-siswa" class="tab-pane fade">
                        @if($pendaftaran->dataSiswa)
                            <table class="table table-borderless">
                                <tr>
                                    <th width="200">NIK</th>
                                    <td>: {{ $pendaftaran->dataSiswa->nik }}</td>
                                </tr>
                                <tr>
                                    <th>NISN</th>
                                    <td>: {{ $pendaftaran->dataSiswa->nisn }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>: {{ $pendaftaran->dataSiswa->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>: {{ $pendaftaran->dataSiswa->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat Lahir</th>
                                    <td>: {{ $pendaftaran->dataSiswa->tmp_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>: {{ $pendaftaran->dataSiswa->tgl_lahir->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>: {{ $pendaftaran->dataSiswa->alamat }}</td>
                                </tr>
                            </table>
                        @else
                            <p class="text-muted">Data siswa belum diisi</p>
                        @endif
                    </div>

                    <div id="data-ortu" class="tab-pane fade">
                        @if($pendaftaran->dataOrtu)
                            <h5>Data Ayah</h5>
                            <table class="table table-borderless mb-4">
                                <tr>
                                    <th width="200">Nama Ayah</th>
                                    <td>: {{ $pendaftaran->dataOrtu->nama_ayah }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan</th>
                                    <td>: {{ $pendaftaran->dataOrtu->pekerjaan_ayah }}</td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                    <td>: {{ $pendaftaran->dataOrtu->no_ayah }}</td>
                                </tr>
                            </table>

                            <h5>Data Ibu</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="200">Nama Ibu</th>
                                    <td>: {{ $pendaftaran->dataOrtu->nama_ibu }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan</th>
                                    <td>: {{ $pendaftaran->dataOrtu->pekerjaan_ibu }}</td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                    <td>: {{ $pendaftaran->dataOrtu->no_ibu }}</td>
                                </tr>
                            </table>
                        @else
                            <p class="text-muted">Data orang tua belum diisi</p>
                        @endif
                    </div>

                    <div id="asal-sekolah" class="tab-pane fade">
                        @if($pendaftaran->asalSekolah)
                            <table class="table table-borderless">
                                <tr>
                                    <th width="200">Nama Sekolah</th>
                                    <td>: {{ $pendaftaran->asalSekolah->nama_sekolah }}</td>
                                </tr>
                                <tr>
                                    <th>NPSN</th>
                                    <td>: {{ $pendaftaran->asalSekolah->npsn }}</td>
                                </tr>
                                <tr>
                                    <th>Kabupaten/kota</th>
                                    <td>: {{ $pendaftaran->asalSekolah->kabupaten }}</td>
                                </tr>
                                <tr>
                                    <th>nilai rata rata siswa</th>
                                    <td>: {{ $pendaftaran->asalSekolah->nilai_rata }}</td>
                                </tr>
                            </table>
                        @else
                            <p class="text-muted">Data asal sekolah belum diisi</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
