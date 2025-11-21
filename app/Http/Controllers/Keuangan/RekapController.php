<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['user', 'jurusan', 'gelombang'])
            ->where('status', 'ADM_PASS');

        if ($request->tanggal_dari && $request->tanggal_sampai) {
            $query->whereBetween('tgl_verifikasi_payment', [$request->tanggal_dari, $request->tanggal_sampai]);
        }

        if ($request->jurusan_id) {
            $query->where('jurusan_id', $request->jurusan_id);
        }

        $rekaps = $query->orderBy('tgl_verifikasi_payment', 'desc')->get();
        $jurusans = Jurusan::all();

        $totalPendaftar = $rekaps->count();
        $totalLunas = $rekaps->where('status_pembayaran', 'lunas')->count();
        $totalNominal = $rekaps->where('status_pembayaran', 'lunas')->sum('jumlah_pembayaran');
        
        $stats = [
            'total' => Pendaftaran::where('status', 'ADM_PASS')->count(),
            'lunas' => Pendaftaran::where('status_pembayaran', 'lunas')->count(),
            'menunggu' => Pendaftaran::where('status_pembayaran', 'menunggu_verifikasi')->count(),
            'belum_bayar' => Pendaftaran::where('status', 'ADM_PASS')->where('status_pembayaran', 'belum_bayar')->count()
        ];

        return view('keuangan.pages.rekap.index', compact('rekaps', 'jurusans', 'totalPendaftar', 'totalLunas', 'totalNominal', 'stats'));
    }

    public function export(Request $request)
    {
        $query = Pendaftaran::with(['user', 'jurusan', 'gelombang'])
            ->where('status', 'ADM_PASS');

        if ($request->tanggal_dari && $request->tanggal_sampai) {
            $query->whereBetween('tgl_verifikasi_payment', [$request->tanggal_dari, $request->tanggal_sampai]);
        }

        if ($request->jurusan_id) {
            $query->where('jurusan_id', $request->jurusan_id);
        }

        $rekaps = $query->orderBy('tgl_verifikasi_payment', 'desc')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'REKAP PEMBAYARAN PPDB');
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'No Pendaftaran');
        $sheet->setCellValue('C3', 'Nama');
        $sheet->setCellValue('D3', 'Jurusan');
        $sheet->setCellValue('E3', 'Jumlah');
        $sheet->setCellValue('F3', 'Status');
        $sheet->setCellValue('G3', 'Tgl Verifikasi');
        $sheet->setCellValue('H3', 'Verifikator');

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1B1A55']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
        ];
        $sheet->getStyle('A3:H3')->applyFromArray($headerStyle);

        $row = 4;
        foreach ($rekaps as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->no_pendaftaran);
            $sheet->setCellValue('C' . $row, $item->user->nama_lengkap);
            $sheet->setCellValue('D' . $row, $item->jurusan->nama);
            $sheet->setCellValue('E' . $row, 'Rp ' . number_format($item->jumlah_pembayaran, 0, ',', '.'));
            $sheet->setCellValue('F' . $row, strtoupper($item->status_pembayaran));
            $sheet->setCellValue('G' . $row, $item->tgl_verifikasi_payment ? $item->tgl_verifikasi_payment->format('d/m/Y H:i') : '-');
            $sheet->setCellValue('H' . $row, $item->user_verifikasi_payment ?? '-');
            $row++;
        }

        $dataStyle = ['borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]];
        $sheet->getStyle('A3:H' . ($row - 1))->applyFromArray($dataStyle);

        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'Rekap_Pembayaran_' . now()->format('YmdHis') . '.xlsx';
        
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
}
