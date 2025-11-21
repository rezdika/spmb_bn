@extends('keuangan.keuangan')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Informasi Pembayaran</h3>
                <div class="card-tools">
                    <a href="{{ route('keuangan.pembayaran.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
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
                    <tr>
                        <th>Jurusan</th>
                        <td>: {{ $pendaftaran->jurusan->nama }}</td>
                    </tr>
                    <tr>
                        <th>Gelombang</th>
                        <td>: {{ $pendaftaran->gelombang->nama }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Pembayaran</th>
                        <td>: <strong class="text-success">Rp {{ number_format($pendaftaran->jumlah_pembayaran, 0, ',', '.') }}</strong></td>
                    </tr>
                    <tr>
                        <th>Status Pembayaran</th>
                        <td>: 
                            @if($pendaftaran->status_pembayaran == 'lunas')
                                <span class="badge badge-success">Lunas</span>
                            @elseif($pendaftaran->status_pembayaran == 'menunggu_verifikasi')
                                <span class="badge badge-warning">Menunggu Verifikasi</span>
                            @elseif($pendaftaran->status_pembayaran == 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                            @else
                                <span class="badge badge-secondary">Belum Bayar</span>
                            @endif
                        </td>
                    </tr>
                    @if($pendaftaran->tgl_verifikasi_payment)
                        <tr>
                            <th>Tanggal Verifikasi</th>
                            <td>: {{ $pendaftaran->tgl_verifikasi_payment->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Diverifikasi Oleh</th>
                            <td>: {{ $pendaftaran->user_verifikasi_payment }}</td>
                        </tr>
                    @endif
                </table>

                @if($pendaftaran->status_pembayaran == 'menunggu_verifikasi')
                    <hr>
                    <h5>Verifikasi Pembayaran</h5>
                    <form action="{{ route('keuangan.pembayaran.verifikasi', $pendaftaran->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="lunas">Terima - Lunas</option>
                                <option value="tolak">Tolak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Catatan (Opsional)</label>
                            <textarea name="catatan" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Simpan Verifikasi
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-image mr-2"></i>Bukti Pembayaran</h3>
                @if($pendaftaran->bukti_pembayaran)
                    <div class="card-tools">
                        <a href="{{ route('keuangan.pembayaran.download-bukti', $pendaftaran->id) }}" 
                           class="btn btn-primary btn-sm" target="_blank">
                            <i class="fas fa-download"></i> Download
                        </a>
                    </div>
                @endif
            </div>
            <div class="card-body text-center">
                @if($pendaftaran->bukti_pembayaran)
                    @php
                        $fileExtension = pathinfo($pendaftaran->bukti_pembayaran, PATHINFO_EXTENSION);
                    @endphp
                    
                    @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/bukti_pembayaran/' . $pendaftaran->bukti_pembayaran) }}" 
                             class="img-fluid border rounded" 
                             alt="Bukti Pembayaran"
                             style="max-height: 400px; cursor: pointer;"
                             onclick="window.open(this.src, '_blank')">
                        <p class="text-muted mt-2 small">Klik gambar untuk memperbesar</p>
                    @elseif(strtolower($fileExtension) == 'pdf')
                        <div class="text-center p-4">
                            <i class="fas fa-file-pdf fa-5x text-danger mb-3"></i>
                            <h5>File PDF</h5>
                            <p class="text-muted">{{ $pendaftaran->bukti_pembayaran }}</p>
                            <a href="{{ route('keuangan.pembayaran.download-bukti', $pendaftaran->id) }}" 
                               class="btn btn-danger" target="_blank">
                                <i class="fas fa-eye"></i> Lihat PDF
                            </a>
                        </div>
                    @endif
                    
                    <hr>
                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i> 
                        Diupload: {{ $pendaftaran->updated_at->format('d/m/Y H:i') }}
                    </small>
                    
                    @if($pendaftaran->catatan_pembayaran)
                        <div class="alert alert-info mt-3">
                            <strong>Catatan:</strong><br>
                            {{ $pendaftaran->catatan_pembayaran }}
                        </div>
                    @endif
                @else
                    <div class="text-center p-4">
                        <i class="fas fa-file-upload fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Bukti Pembayaran</h5>
                        <p class="text-muted">Siswa belum mengupload bukti pembayaran</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
