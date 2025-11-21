<!DOCTYPE html>
<html>
<head>
    <title>Bukti Pembayaran - {{ $pendaftaran->no_pendaftaran }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .bukti { width: 100%; max-width: 600px; margin: 0 auto; border: 2px solid #28a745; }
        .header { background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 20px; text-align: center; }
        .content { padding: 30px; }
        .row { display: flex; margin-bottom: 15px; border-bottom: 1px dotted #ddd; padding-bottom: 10px; }
        .label { width: 180px; font-weight: bold; }
        .value { flex: 1; }
        .total { background: #f8f9fa; padding: 15px; margin: 20px 0; text-align: center; border: 2px dashed #28a745; }
        .footer { background: #f8f9fa; padding: 15px; text-align: center; font-size: 12px; color: #666; }
        .status { background: #28a745; color: white; padding: 10px; text-align: center; font-weight: bold; }
        @media print { body { margin: 0; } }
    </style>
</head>
<body>
    <div class="bukti">
        <div class="header">
            <h2>BUKTI PEMBAYARAN</h2>
            <h3>SMK BAKTI NUSANTARA 666</h3>
            <p>Pendaftaran Peserta Didik Baru</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="label">No. Pendaftaran</div>
                <div class="value">{{ $pendaftaran->no_pendaftaran }}</div>
            </div>
            
            <div class="row">
                <div class="label">Nama Siswa</div>
                <div class="value">{{ $pendaftaran->user->nama_lengkap }}</div>
            </div>
            
            <div class="row">
                <div class="label">Jurusan</div>
                <div class="value">{{ $pendaftaran->jurusan->nama }}</div>
            </div>
            
            <div class="row">
                <div class="label">Gelombang</div>
                <div class="value">{{ $pendaftaran->gelombang->nama }}</div>
            </div>
            
            <div class="row">
                <div class="label">Tanggal Pembayaran</div>
                <div class="value">{{ $pendaftaran->tgl_verifikasi_payment ? $pendaftaran->tgl_verifikasi_payment->format('d M Y, H:i') : '-' }}</div>
            </div>
            
            <div class="row">
                <div class="label">Diverifikasi Oleh</div>
                <div class="value">{{ $pendaftaran->user_verifikasi_payment ?? 'Admin' }}</div>
            </div>
            
            <div class="total">
                <h3 style="margin: 0; color: #28a745;">TOTAL PEMBAYARAN</h3>
                <h2 style="margin: 10px 0; color: #28a745;">Rp {{ number_format($pendaftaran->jumlah_pembayaran, 0, ',', '.') }}</h2>
                <p style="margin: 0; font-size: 14px;">{{ ucwords(terbilang($pendaftaran->jumlah_pembayaran)) }} Rupiah</p>
            </div>
            
            @if($pendaftaran->catatan_pembayaran)
            <div class="row">
                <div class="label">Catatan</div>
                <div class="value">{{ $pendaftaran->catatan_pembayaran }}</div>
            </div>
            @endif
        </div>
        
        <div class="status">
            ✓ PEMBAYARAN TELAH DIVERIFIKASI DAN DITERIMA
        </div>
        
        <div class="footer">
            <p>Dokumen ini dicetak pada {{ now()->format('d M Y, H:i') }}</p>
            <p>Simpan bukti ini sebagai tanda pembayaran yang sah</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>

@php
function terbilang($angka) {
    $angka = abs($angka);
    $baca = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $terbilang = "";
    
    if ($angka < 12) {
        $terbilang = " " . $baca[$angka];
    } else if ($angka < 20) {
        $terbilang = terbilang($angka - 10) . " belas";
    } else if ($angka < 100) {
        $terbilang = terbilang($angka / 10) . " puluh" . terbilang($angka % 10);
    } else if ($angka < 200) {
        $terbilang = " seratus" . terbilang($angka - 100);
    } else if ($angka < 1000) {
        $terbilang = terbilang($angka / 100) . " ratus" . terbilang($angka % 100);
    } else if ($angka < 2000) {
        $terbilang = " seribu" . terbilang($angka - 1000);
    } else if ($angka < 1000000) {
        $terbilang = terbilang($angka / 1000) . " ribu" . terbilang($angka % 1000);
    } else if ($angka < 1000000000) {
        $terbilang = terbilang($angka / 1000000) . " juta" . terbilang($angka % 1000000);
    }
    
    return $terbilang;
}
@endphp