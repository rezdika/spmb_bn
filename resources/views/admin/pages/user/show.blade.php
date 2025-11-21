@extends('admin.admin')

@section('title', 'Detail User')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail User</h3>
        <div class="card-tools">
            <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-sm" style="background-color: #F5E8C7; color: #1B1A55; border-color: #F5E8C7;">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.user.index') }}" class="btn btn-sm" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Nama Lengkap</th>
                        <td>: {{ $user->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>No HP</th>
                        <td>: {{ $user->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>: 
                            <span class="badge" style="background-color: #1B1A55; color: white;">
                                {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Terdaftar</th>
                        <td>: {{ $user->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Update</th>
                        <td>: {{ $user->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Email Verified</th>
                        <td>: 
                            @if($user->email_verified_at)
                                <span class="badge" style="background-color: #1B1A55; color: white;">Verified</span>
                            @else
                                <span class="badge" style="background-color: #F5E8C7; color: #1B1A55;">Not Verified</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if($user->role == 'calon_siswa')
<!-- Pendaftaran History -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Riwayat Pendaftaran</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gelombang</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada riwayat pendaftaran</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

<!-- Activity Log -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Log Aktivitas</h3>
    </div>
    <div class="card-body">
        <div class="timeline">
            <div class="time-label">
                <span style="background-color: #1B1A55; color: white;">{{ $user->created_at->format('d M Y') }}</span>
            </div>
            <div>
                <i class="fas fa-user" style="background-color: #F5E8C7; color: #1B1A55;"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{ $user->created_at->format('H:i') }}</span>
                    <h3 class="timeline-header">User terdaftar</h3>
                    <div class="timeline-body">
                        User {{ $user->nama_lengkap }} berhasil mendaftar dengan role {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                    </div>
                </div>
            </div>
            @if($user->updated_at != $user->created_at)
            <div class="time-label">
                <span style="background-color: #F5E8C7; color: #1B1A55;">{{ $user->updated_at->format('d M Y') }}</span>
            </div>
            <div>
                <i class="fas fa-edit" style="background-color: #1B1A55; color: white;"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{ $user->updated_at->format('H:i') }}</span>
                    <h3 class="timeline-header">Data diperbarui</h3>
                    <div class="timeline-body">
                        Data user terakhir diperbarui
                    </div>
                </div>
            </div>
            @endif
            <div>
                <i class="fas fa-clock" style="background-color: #F5E8C7; color: #1B1A55;"></i>
            </div>
        </div>
    </div>
</div>
@endsection