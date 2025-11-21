@extends('keuangan.keuangan')

@section('title', 'Laporan per Jurusan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-graduation-cap mr-2"></i>Laporan Pembayaran per Jurusan</h3>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Siswa Lunas</span>
                        <span class="info-box-number">{{ $totalSiswa }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-coins"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Nominal</span>
                        <span class="info-box-number">Rp {{ number_format($totalNominal, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jurusan</th>
                        <th>Total Siswa</th>
                        <th>Total Nominal</th>
                        <th>Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $index => $item)
                        @php
                            $persentase = $totalSiswa > 0 ? round(($item['total_siswa'] / $totalSiswa) * 100, 2) : 0;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['total_siswa'] }} siswa</td>
                            <td>Rp {{ number_format($item['total_nominal'], 0, ',', '.') }}</td>
                            <td>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar bg-success" style="width: {{ $persentase }}%">
                                        {{ $persentase }}%
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
