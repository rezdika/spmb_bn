@extends('admin.admin')

@section('title', 'Data Kelurahan/Desa')

@push('styles')
<style>
    .pagination {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        margin: 0 !important;
        font-size: 14px !important;
    }
    .pagination .page-item {
        margin: 0 !important;
    }
    .pagination .page-link {
        padding: 4px 8px !important;
        min-width: 28px !important;
        height: 28px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border: none !important;
        background: none !important;
        color: #666 !important;
        text-decoration: none !important;
        font-size: 14px !important;
    }
    .pagination .page-link:hover {
        background-color: #f0f0f0 !important;
        color: #333 !important;
        text-decoration: none !important;
    }
    .pagination .page-item.active .page-link {
        background-color: #007bff !important;
        color: white !important;
        border-radius: 3px !important;
    }
    .pagination .page-item.disabled .page-link {
        color: #ccc !important;
        cursor: not-allowed !important;
    }
    .pagination .page-item.disabled .page-link:hover {
        background: none !important;
        color: #ccc !important;
    }
</style>
@endpush

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ $villages->total() }}</h3>
                <p style="color: #1B1A55;">Total Kelurahan/Desa</p>
            </div>
            <div class="icon">
                <i class="fas fa-home" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ App\Models\District::count() }}</h3>
                <p style="color: #1B1A55;">Total Kecamatan</p>
            </div>
            <div class="icon">
                <i class="fas fa-building" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ App\Models\Regency::count() }}</h3>
                <p style="color: #1B1A55;">Total Kabupaten/Kota</p>
            </div>
            <div class="icon">
                <i class="fas fa-city" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5E8C7;">
            <div class="inner">
                <h3 style="color: #1B1A55;">{{ App\Models\Province::count() }}</h3>
                <p style="color: #1B1A55;">Total Provinsi</p>
            </div>
            <div class="icon">
                <i class="fas fa-map-marked-alt" style="color: #1B1A55;"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Kelurahan/Desa</h3>
        <div class="card-tools d-flex align-items-center">
            <div class="input-group input-group-sm mr-3" style="width: 250px;">
                <input type="text" class="form-control" placeholder="Cari kelurahan/desa..." id="searchInput">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary" id="clearSearch">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <a href="{{ route('admin.villages.create') }}" class="btn btn-sm" style="background-color: #1B1A55; color: white; border-color: #1B1A55;">
                <i class="fas fa-plus"></i> Tambah Kelurahan/Desa
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kecamatan</th>
                        <th>Nama Kelurahan/Desa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($villages as $village)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $village->district->name }}</td>
                        <td>{{ $village->name }}</td>
                        <td>
                            <a href="{{ route('admin.villages.edit', $village) }}" class="btn btn-sm" style="background-color: #F5E8C7; color: #1B1A55; border-color: #F5E8C7;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.villages.destroy', $village) }}" method="POST" class="d-inline">
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
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end align-items-center" style="padding: 10px 20px; background-color: #fafafa; border-top: 1px solid #e0e0e0; font-size: 14px; color: #666;">
        <span class="mr-3">Showing {{ $villages->firstItem() }} to {{ $villages->lastItem() }} of {{ $villages->total() }} results</span>
        {{ $villages->links('pagination::compact') }}
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('tbody tr').each(function() {
            var text = $(this).text().toLowerCase();
            $(this).toggle(text.indexOf(value) > -1);
        });
    });
    
    $('#clearSearch').on('click', function() {
        $('#searchInput').val('');
        $('tbody tr').show();
    });
});
</script>
@endpush