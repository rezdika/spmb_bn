@extends('admin.admin')

@section('title', 'Detail Gelombang')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Gelombang</h3>
        <div class="card-tools">
            <a href="{{ route('admin.gelombang.edit', $gelombang) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.gelombang.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">Nama Gelombang</th>
                        <td>: {{ $gelombang->nama }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <td>: {{ \Carbon\Carbon::parse($gelombang->tanggal_mulai)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Selesai</th>
                        <td>: {{ \Carbon\Carbon::parse($gelombang->tanggal_selesai)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Biaya Pendaftaran</th>
                        <td>: Rp {{ number_format($gelombang->biaya_daftar, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: 
                            <span class="badge badge-{{ $gelombang->status == 'aktif' ? 'success' : 'danger' }}">
                                {{ ucfirst($gelombang->status) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection