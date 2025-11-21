@extends('admin.admin')

@section('title', 'Monitoring Berkas Pendaftar')

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
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $berkasLengkap }}</h3>
                <p>Berkas Lengkap</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $berkasBelumLengkap }}</h3>
                <p>Berkas Belum Lengkap</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $terverifikasi }}</h3>
                <p>Terverifikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-folder-open mr-2"></i>Monitoring Kelengkapan Berkas</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-success btn-sm" onclick="exportExcel()">
                <i class="fas fa-file-excel"></i> Export Excel
            </button>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-2">
                    <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
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
                <div class="col-md-2">
                    <select name="kelengkapan" class="form-control">
                        <option value="">Semua Kelengkapan</option>
                        <option value="lengkap" {{ request('kelengkapan') == 'lengkap' ? 'selected' : '' }}>Lengkap</option>
                        <option value="belum" {{ request('kelengkapan') == 'belum' ? 'selected' : '' }}>Belum Lengkap</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pendaftaran</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Kelengkapan Berkas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = ($pendaftarans->currentPage() - 1) * $pendaftarans->perPage() + 1; @endphp
                    @forelse($pendaftarans as $item)
                        @php
                            $totalBerkas = $item->berkas->count();
                            $targetBerkas = 7;
                            $percentage = round(($totalBerkas / $targetBerkas) * 100);
                            $progressColor = $percentage >= 80 ? 'success' : ($percentage >= 50 ? 'warning' : 'danger');
                        @endphp
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->no_pendaftaran }}</td>
                            <td>{{ $item->user->nama_lengkap }}</td>
                            <td>{{ $item->jurusan->nama }}</td>
                            <td>
                                <div class="mb-1">
                                    <small>{{ $totalBerkas }}/{{ $targetBerkas }} berkas ({{ $percentage }}%)</small>
                                </div>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar bg-{{ $progressColor }}" role="progressbar" style="width: {{ $percentage }}%">
                                        {{ $percentage }}%
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($item->status == 'SUBMIT')
                                    <span class="badge badge-warning">Menunggu</span>
                                @elseif($item->status == 'ADM_PASS')
                                    <span class="badge badge-success">Disetujui</span>
                                @elseif($item->status == 'ADM_REJECT')
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="showDetail({{ $item->id }})">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
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

@push('scripts')
<script>
function exportExcel() {
    const params = new URLSearchParams(window.location.search);
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route('admin.monitoring-berkas.export') }}';
    
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = '{{ csrf_token() }}';
    form.appendChild(csrfInput);
    
    params.forEach((value, key) => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = value;
        form.appendChild(input);
    });
    
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}

function showDetail(id) {
    window.location.href = '/admin/pendaftaran/' + id;
}
</script>
@endpush
