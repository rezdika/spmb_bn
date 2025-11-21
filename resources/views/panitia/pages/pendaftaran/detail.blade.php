@extends('panitia.panitia')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Pendaftar</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th width="200">No Pendaftaran</th>
                        <td>{{ $pendaftaran->no_pendaftaran }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $pendaftaran->user->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $pendaftaran->user->email }}</td>
                    </tr>
                    <tr>
                        <th>No HP</th>
                        <td>{{ $pendaftaran->user->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Jurusan</th>
                        <td>{{ $pendaftaran->jurusan->nama }}</td>
                    </tr>
                    <tr>
                        <th>Gelombang</th>
                        <td>{{ $pendaftaran->gelombang->nama }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($pendaftaran->status == 'SUBMIT')
                                <span class="badge badge-warning">Menunggu Verifikasi</span>
                            @elseif($pendaftaran->status == 'ADM_PASS')
                                <span class="badge badge-success">Disetujui</span>
                            @elseif($pendaftaran->status == 'ADM_REJECT')
                                <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Berkas Pendaftaran</h3>
            </div>
            <div class="card-body">
                @if($pendaftaran->berkas->count() > 0)
                    @php
                        $totalBerkas = $pendaftaran->berkas->count();
                        $terverifikasi = $pendaftaran->berkas->whereNotNull('verified_at')->count();
                        $valid = $pendaftaran->berkas->where('status', 'approved')->count();
                        $tidakValid = $pendaftaran->berkas->whereIn('status', ['rejected', 'revision'])->count();
                        $progress = $totalBerkas > 0 ? round(($terverifikasi / $totalBerkas) * 100) : 0;
                    @endphp
                    
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Status Verifikasi Berkas</h6>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar bg-info" style="width: {{ $progress }}%">{{ $progress }}%</div>
                                </div>
                                <small class="text-muted">{{ $terverifikasi }}/{{ $totalBerkas }} berkas telah diverifikasi</small>
                            </div>
                            <div class="col-md-6">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="badge badge-success p-2">{{ $valid }}</div>
                                        <br><small>Valid</small>
                                    </div>
                                    <div class="col-4">
                                        <div class="badge badge-danger p-2">{{ $tidakValid }}</div>
                                        <br><small>Tidak Valid</small>
                                    </div>
                                    <div class="col-4">
                                        <div class="badge badge-secondary p-2">{{ $totalBerkas - $terverifikasi }}</div>
                                        <br><small>Belum</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Jenis Berkas</th>
                                    <th>Nama File</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendaftaran->berkas as $berkas)
                                <tr id="berkas-{{ $berkas->id }}">
                                    <td>{{ $berkas->jenis }}</td>
                                    <td><small>{{ $berkas->nama_file }}</small></td>
                                    <td class="status-cell">
                                        @if($berkas->status == 'pending')
                                            <span class="badge badge-secondary">Belum Diverifikasi</span>
                                        @elseif($berkas->status == 'approved')
                                            <span class="badge badge-success">Disetujui</span>
                                        @elseif($berkas->status == 'rejected')
                                            <span class="badge badge-danger">Ditolak</span>
                                        @elseif($berkas->status == 'revision')
                                            <span class="badge badge-warning">Perlu Perbaikan</span>
                                        @endif
                                        @if($berkas->catatan_panitia)
                                            <br><small class="text-muted catatan-text">{{ $berkas->catatan_panitia }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $filePath = public_path('storage/' . $berkas->url);
                                            $fileExists = file_exists($filePath);
                                        @endphp
                                        
                                        @if($fileExists)
                                            <a href="{{ asset('storage/' . $berkas->url) }}" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        @else
                                            <span class="btn btn-sm btn-secondary disabled">
                                                <i class="fas fa-exclamation-triangle"></i> File Tidak Ditemukan
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">Belum ada berkas yang diupload</p>
                @endif
            </div>
        </div>

        {{-- Form verifikasi dihapus - hanya untuk melihat detail saja --}}
        @if($pendaftaran->status == 'SUBMIT')
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="card-title">Informasi Verifikasi</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Untuk melakukan verifikasi berkas, silakan gunakan menu "Verifikasi Berkas".</strong><br>
                    Halaman ini hanya untuk melihat detail pendaftaran.
                </div>
                <a href="{{ route('panitia.berkas.index') }}" class="btn btn-primary">
                    <i class="fas fa-clipboard-check"></i> Ke Menu Verifikasi Berkas
                </a>
            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <a href="{{ route('panitia.pendaftaran.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        @if($pendaftaran->dataSiswa)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Siswa</h3>
            </div>
            <div class="card-body">
                <p><strong>NIK:</strong> {{ $pendaftaran->dataSiswa->nik }}</p>
                <p><strong>Tempat Lahir:</strong> {{ $pendaftaran->dataSiswa->tmp_lahir }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $pendaftaran->dataSiswa->tgl_lahir }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $pendaftaran->dataSiswa->jk }}</p>
                <p><strong>Agama:</strong> {{ $pendaftaran->dataSiswa->agama }}</p>
            </div>
        </div>
        @endif

        @if($pendaftaran->asalSekolah)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Asal Sekolah</h3>
            </div>
            <div class="card-body">
                <p><strong>NPSN:</strong> {{ $pendaftaran->asalSekolah->npsn }}</p>
                <p><strong>Nama Sekolah:</strong> {{ $pendaftaran->asalSekolah->nama_sekolah }}</p>
                <p><strong>Alamat:</strong> {{ $pendaftaran->asalSekolah->kabupaten }}</p>
            </div>
        </div>
        @endif

        @if($pendaftaran->status != 'SUBMIT')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Riwayat Verifikasi</h3>
            </div>
            <div class="card-body">
                <p><strong>Diverifikasi oleh:</strong> {{ $pendaftaran->user_verifikasi_adm ?? '-' }}</p>
                <p><strong>Tanggal:</strong> 
                    @if($pendaftaran->tanggal_verifikasi)
                        {{ \Carbon\Carbon::parse($pendaftaran->tanggal_verifikasi)->format('d/m/Y H:i') }}
                    @else
                        -
                    @endif
                </p>
                @if($pendaftaran->catatan_admin)
                <p><strong>Catatan:</strong><br>{{ $pendaftaran->catatan_admin }}</p>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Modal preview dihapus - menggunakan link langsung --}}
@endsection

@push('scripts')
<script>
// Script verifikasi dihapus - halaman ini hanya untuk melihat detail
</script>
@endpush
