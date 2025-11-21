@extends('admin.admin')

@section('title', 'Data User')

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $users->total() }}</h3>
                <p style="color: #1B1A55;">Total Pengguna</p>
            </div>
            <div class="icon">
                <i class="fas fa-users" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ App\Models\User::where('role', 'admin')->count() }}</h3>
                <p style="color: #1B1A55;">Admin</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-shield" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ App\Models\User::where('role', 'calon_siswa')->count() }}</h3>
                <p style="color: #1B1A55;">Calon Siswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ App\Models\User::whereIn('role', ['panitia', 'keuangan', 'kepala_sekolah'])->count() }}</h3>
                <p style="color: #1B1A55;">Staff</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tie" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data User</h3>
        <div class="card-tools d-flex align-items-center">
            <div class="input-group input-group-sm mr-3" style="width: 280px;">
                <input type="text" class="form-control" placeholder="Cari nama, email, no HP..." id="searchInput">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary" id="clearSearch">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="btn-group mr-2">
                <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-filter"></i> Filter Role
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" data-filter="all">Semua Role</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-filter="admin">Admin</a>
                    <a class="dropdown-item" href="#" data-filter="calon_siswa">Calon Siswa</a>
                    <a class="dropdown-item" href="#" data-filter="panitia">Panitia</a>
                    <a class="dropdown-item" href="#" data-filter="keuangan">Keuangan</a>
                    <a class="dropdown-item" href="#" data-filter="kepala_sekolah">Kepala Sekolah</a>
                    <a class="dropdown-item" href="#" data-filter="user_end">User End</a>
                </div>
            </div>
            <a href="{{ route('admin.user.create') }}" class="btn btn-sm" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->no_hp }}</td>
                        <td>
                            <span class="badge" style="background-color: #1B1A55; color: white;">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.user.show', $user) }}" class="btn btn-sm" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-sm" style="background-color: #F5E8C7; color: #1B1A55; border-color: #F5E8C7;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.user.destroy', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background-color: #1B1A55; color: white; border-color: #1B1A55;" onclick="return confirm('Yakin hapus?')">
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
        {{ $users->links() }}
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
        $('.dropdown-toggle').html('<i class="fas fa-filter"></i> Filter Role');
    });
    
    // Filter by role
    $('[data-filter]').on('click', function(e) {
        e.preventDefault();
        var filter = $(this).data('filter');
        var visibleRows = 0;
        
        $('tbody tr').each(function() {
            var row = $(this);
            var roleText = row.find('.badge').text().toLowerCase().replace(/\s+/g, '_');
            
            if (filter === 'all') {
                row.show();
                visibleRows++;
            } else if (roleText.includes(filter.replace('_', ' ')) || roleText.includes(filter)) {
                row.show();
                visibleRows++;
            } else {
                row.hide();
            }
        });
        
        // Update filter button text
        var filterText = $(this).text();
        $('.dropdown-toggle').html('<i class="fas fa-filter"></i> ' + filterText);
        
        // Show no results message
        if (visibleRows === 0) {
            if ($('#noResults').length === 0) {
                $('tbody').append('<tr id="noResults"><td colspan="6" class="text-center text-muted py-4"><i class="fas fa-filter mr-2"></i>Tidak ada data untuk filter ini</td></tr>');
            }
        } else {
            $('#noResults').remove();
        }
    });
    
    // Confirm delete
    $('.btn-danger').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var userName = $(this).closest('tr').find('td:nth-child(2)').text();
        var userRole = $(this).closest('tr').find('.badge').text();
        
        if (confirm('Yakin ingin menghapus user "' + userName + '" dengan role ' + userRole + '?\n\nData yang sudah dihapus tidak dapat dikembalikan.')) {
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