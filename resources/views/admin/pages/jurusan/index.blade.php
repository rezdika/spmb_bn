@extends('admin.admin')

@section('title', 'Data Jurusan')

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $jurusans->total() }}</h3>
                <p style="color: #1B1A55;">Total Jurusan</p>
            </div>
            <div class="icon">
                <i class="fas fa-graduation-cap" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ App\Models\Jurusan::where('is_active', 1)->count() }}</h3>
                <p style="color: #1B1A55;">Jurusan Aktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ App\Models\Jurusan::where('is_active', 0)->count() }}</h3>
                <p style="color: #1B1A55;">Jurusan Nonaktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-times-circle" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ App\Models\Jurusan::sum('kuota') }}</h3>
                <p style="color: #1B1A55;">Total Kuota</p>
            </div>
            <div class="icon">
                <i class="fas fa-users" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Jurusan</h3>
        <div class="card-tools d-flex align-items-center">
            <div class="input-group input-group-sm mr-3" style="width: 250px;">
                <input type="text" class="form-control" placeholder="Cari kode, nama jurusan..." id="searchInput">
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
            <a href="{{ route('admin.jurusan.create') }}" class="btn btn-sm" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">
                <i class="fas fa-plus"></i> Tambah Jurusan
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Jurusan</th>
                        <th>Kuota</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jurusans as $jurusan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jurusan->kode }}</td>
                        <td>{{ $jurusan->nama }}</td>
                        <td>{{ $jurusan->kuota }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $jurusan->is_active ? '#1B1A55' : '#F5E8C7' }}; color: {{ $jurusan->is_active ? 'white' : '#1B1A55' }};">
                                {{ $jurusan->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.jurusan.show', $jurusan) }}" class="btn btn-sm" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.jurusan.edit', $jurusan) }}" class="btn btn-sm" style="background-color: #F5E8C7; color: #1B1A55; border-color: #F5E8C7;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.jurusan.destroy', $jurusan) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="color: white; border-color: #1B1A55;" onclick="return confirm('Yakin hapus?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $jurusans->links() }}
    </div>
</div>
@endsection

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
        
        // Show no results message
        if (visibleRows === 0 && value !== '') {
            if ($('#noResults').length === 0) {
                $('tbody').append('<tr id="noResults"><td colspan="6" class="text-center text-muted py-4"><i class="fas fa-search mr-2"></i>Tidak ada data yang ditemukan</td></tr>');
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
        
        // Update filter button text
        $('.dropdown-toggle').html('<i class="fas fa-filter"></i> ' + $(this).text());
    });
    
    // Confirm delete with SweetAlert style
    $('.btn-danger').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var jurusan = $(this).closest('tr').find('td:nth-child(3)').text();
        
        if (confirm('Yakin ingin menghapus jurusan "' + jurusan + '"?\n\nData yang sudah dihapus tidak dapat dikembalikan.')) {
            form.submit();
        }
    });
    
    // Auto hide alerts
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
    
    // Row hover effect
    $('tbody tr').hover(
        function() { $(this).addClass('table-hover-effect'); },
        function() { $(this).removeClass('table-hover-effect'); }
    );
});
</script>
@endpush