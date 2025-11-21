@extends('panitia.panitia')

@section('title', 'Data Pendaftaran')

@section('content')
<div class="row mb-3">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary-custom">
            <div class="inner">
                <h3>{{ $totalPendaftar }}</h3>
                <p>Total Pendaftar</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $menungguVerifikasi }}</h3>
                <p>Menunggu Verifikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $disetujui }}</h3>
                <p>Disetujui</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $ditolak }}</h3>
                <p>Ditolak</p>
            </div>
            <div class="icon">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Pendaftaran</h3>
    </div>
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari No/Nama..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="SUBMIT" {{ request('status') == 'SUBMIT' ? 'selected' : '' }}>Submit</option>
                        <option value="ADM_PASS" {{ request('status') == 'ADM_PASS' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ADM_REJECT" {{ request('status') == 'ADM_REJECT' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="jurusan_id" class="form-control">
                        <option value="">Semua Jurusan</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ request('jurusan_id') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="gelombang_id" class="form-control">
                        <option value="">Semua Gelombang</option>
                        @foreach($gelombangs as $gelombang)
                            <option value="{{ $gelombang->id }}" {{ request('gelombang_id') == $gelombang->id ? 'selected' : '' }}>{{ $gelombang->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('panitia.pendaftaran.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No Pendaftaran</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Gelombang</th>
                        <th>Status</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftarans as $pendaftaran)
                    <tr>
                        <td>{{ $pendaftaran->no_pendaftaran }}</td>
                        <td>{{ $pendaftaran->user->nama_lengkap }}</td>
                        <td>{{ $pendaftaran->jurusan->nama }}</td>
                        <td>{{ $pendaftaran->gelombang->nama }}</td>
                        <td>
                            @if($pendaftaran->status == 'SUBMIT')
                                <span class="badge badge-warning">Menunggu Verifikasi</span>
                            @elseif($pendaftaran->status == 'ADM_PASS')
                                <span class="badge badge-success">Disetujui</span>
                            @elseif($pendaftaran->status == 'ADM_REJECT')
                                <span class="badge badge-danger">Ditolak</span>
                            @else
                                <span class="badge badge-secondary">{{ $pendaftaran->status }}</span>
                            @endif
                        </td>
                        <td>{{ $pendaftaran->tanggal_daftar->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('panitia.pendaftaran.show', $pendaftaran->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $pendaftarans->links() }}
        </div>
    </div>
</div>
@endsection
