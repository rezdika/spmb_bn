@extends('admin.admin')

@section('title', 'Data Gelombang')

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $gelombangs->total() }}</h3>
                <p style="color: #1B1A55;">Total Gelombang</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ App\Models\Gelombang::where('status', 'aktif')->count() }}</h3>
                <p style="color: #1B1A55;">Gelombang Aktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-play-circle" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ App\Models\Gelombang::where('status', 'nonaktif')->count() }}</h3>
                <p style="color: #1B1A55;">Gelombang Nonaktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-pause-circle" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">Rp {{ number_format(App\Models\Gelombang::avg('biaya_daftar') ?? 0, 0, ',', '.') }}</h3>
                <p style="color: #1B1A55;">Rata-rata Biaya</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Gelombang</h3>
        <div class="card-tools d-flex align-items-center">
            <div class="input-group input-group-sm mr-3" style="width: 250px;">
                <input type="text" class="form-control" placeholder="Cari nama gelombang..." id="searchInput">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary" id="clearSearch">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="btn-group mr-2">
                <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" data-filter="all">Semua Status</a>
                    <a class="dropdown-item" href="#" data-filter="aktif">Aktif</a>
                    <a class="dropdown-item" href="#" data-filter="nonaktif">Nonaktif</a>
                </div>
            </div>
            <a href="{{ route('admin.gelombang.create') }}" class="btn btn-sm" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">
                <i class="fas fa-plus"></i> Tambah Gelombang
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Gelombang</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gelombangs as $gelombang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $gelombang->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($gelombang->tgl_mulai)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($gelombang->tgl_selesai)->format('d/m/Y') }}</td>
                        <td>Rp {{ number_format($gelombang->biaya_daftar, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $gelombang->status == 'aktif' ? '#1B1A55' : '#F5E8C7' }}; color: {{ $gelombang->status == 'aktif' ? 'white' : '#1B1A55' }};">
                                {{ ucfirst($gelombang->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.gelombang.show', $gelombang) }}" class="btn btn-sm" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.gelombang.edit', $gelombang) }}" class="btn btn-sm" style="background-color: #F5E8C7; color: #1B1A55; border-color: #F5E8C7;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.gelombang.destroy', $gelombang) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style=" color: white; border-color: #1B1A55;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
    </div>
    <div class="card-footer">
        {{ $gelombangs->links() }}
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Enhanced search functionality
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        var visibleRows = 0;
        
        $('tbody tr').each(function() {
            var row = $(this);
            var text = row.text().toLowerCase();
            
            if (text.indexOf(value) > -1) {
                row.show();
                visibleRows++;
            } else {
                row.hide();
            }
        });
        
        if (visibleRows === 0 && value !== '') {
            if ($('#noResults').length === 0) {
                $('tbody').append('<tr id="noResults"><td colspan="7" class="text-center text-muted py-4"><i class="fas fa-search mr-2"></i>Tidak ada data yang ditemukan</td></tr>');
            }
        } else {
            $('#noResults').remove();
        }
    });
    
    // Clear search
    $('#clearSearch').on('click', function() {
        $('#searchInput').val('');
        $('tbody tr').show();
        $('#noResults').remove();
    });
    
    // Filter functionality
    $('[data-filter]').on('click', function(e) {
        e.preventDefault();
        var filter = $(this).data('filter');
        
        $('tbody tr').each(function() {
            var row = $(this);
            var status = row.find('.badge').text().toLowerCase();
            
            if (filter === 'all') {
                row.show();
            } else if (filter === 'aktif' && status.includes('aktif')) {
                row.show();
            } else if (filter === 'nonaktif' && status.includes('nonaktif')) {
                row.show();
            } else {
                row.hide();
            }
        });
        
        $('.dropdown-toggle').html('<i class="fas fa-filter"></i> ' + $(this).text());
    });
    
    // Confirm delete
    $('.btn-danger').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var gelombang = $(this).closest('tr').find('td:nth-child(2)').text();
        
        if (confirm('Yakin ingin menghapus gelombang "' + gelombang + '"?\n\nData yang sudah dihapus tidak dapat dikembalikan.')) {
            form.submit();
        }
    });
    
    // Auto hide alerts
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>
@endpush
@endsection