@extends('user.main')

@section('title', 'Tenaga Pendidik - SMK Bakti Nusantara 666')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Tenaga Pendidik</li>
        </ol>
    </div>
</nav>
@endsection

@section('content')
<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/image/fotobersama.jpg') }}" alt="Foto Bersama Tenaga Pendidik" class="img-fluid rounded shadow" style="max-height: 800px; width: 100%; object-fit: cover;">
        </div>
        
        <h2 class=" mb-4" style="color: #1B1A55; font-weight: 700;">Tenaga Pendidik</h2>
        
       
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 80px;">No</th>
                        <th>Nama</th>
                        <th>Mata Pelajaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guru as $index => $g)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $g->nama_guru }}</td>
                        <td>{{ $g->mata_pelajaran }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $guru->links('vendor.pagination.compact') }}
        </div>
    </div>
</section>
@endsection
