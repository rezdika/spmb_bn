<!DOCTYPE html>
<html>
<head>
    <title>Kartu Pendaftaran - {{ $pendaftaran->no_pendaftaran }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .kartu { width: 100%; max-width: 800px; margin: 0 auto; border: 2px solid #1B1A55; }
        .header { background: linear-gradient(135deg, #1B1A55, #637AB9); color: white; padding: 20px; text-align: center; }
        .content { padding: 30px; }
        .row { display: flex; margin-bottom: 15px; }
        .label { width: 200px; font-weight: bold; }
        .value { flex: 1; }
        .foto { width: 120px; height: 150px; border: 2px solid #ddd; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; }
        .status { background: #28a745; color: white; padding: 10px; text-align: center; font-weight: bold; }
        @media print { body { margin: 0; } }
    </style>
</head>
<body>
    <div class="kartu">
        <div class="header">
            <h2>KARTU PENDAFTARAN SISWA BARU</h2>
            <h3>SMK BAKTI NUSANTARA 666</h3>
            <p>Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
        </div>
        
        <div class="content">
            <div style="text-align: center; margin-bottom: 30px;">
                <div class="foto">
                    @if($pendaftaran->user->foto_profile)
                        <img src="{{ asset('storage/foto_profile/' . $pendaftaran->user->foto_profile) }}" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <span style="color: #666;">Foto 3x4</span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="label">No. Pendaftaran</div>
                <div class="value">: {{ $pendaftaran->no_pendaftaran }}</div>
            </div>
            
            <div class="row">
                <div class="label">Nama Lengkap</div>
                <div class="value">: {{ $pendaftaran->user->nama_lengkap }}</div>
            </div>
            
            <div class="row">
                <div class="label">Jurusan</div>
                <div class="value">: {{ $pendaftaran->jurusan->nama }}</div>
            </div>
            
            <div class="row">
                <div class="label">Gelombang</div>
                <div class="value">: {{ $pendaftaran->gelombang->nama }}</div>
            </div>
            
            @if($pendaftaran->dataSiswa)
            <div class="row">
                <div class="label">Tempat, Tanggal Lahir</div>
                <div class="value">: {{ $pendaftaran->dataSiswa->tempat_lahir }}, {{ $pendaftaran->dataSiswa->tanggal_lahir ? \Carbon\Carbon::parse($pendaftaran->dataSiswa->tanggal_lahir)->format('d M Y') : '-' }}</div>
            </div>
            
            <div class="row">
                <div class="label">Jenis Kelamin</div>
                <div class="value">: {{ $pendaftaran->dataSiswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
            </div>
            @endif
            
            @if($pendaftaran->asalSekolah)
            <div class="row">
                <div class="label">Asal Sekolah</div>
                <div class="value">: {{ $pendaftaran->asalSekolah->nama_sekolah }}</div>
            </div>
            @endif
            
            <div class="row">
                <div class="label">Tanggal Daftar</div>
                <div class="value">: {{ $pendaftaran->tanggal_daftar->format('d M Y') }}</div>
            </div>
            
            <div class="row">
                <div class="label">Tanggal Verifikasi</div>
                <div class="value">: {{ $pendaftaran->tgl_verifikasi_payment ? $pendaftaran->tgl_verifikasi_payment->format('d M Y') : '-' }}</div>
            </div>
        </div>
        
        <div class="status">
            ✓ DITERIMA - PEMBAYARAN LUNAS
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>