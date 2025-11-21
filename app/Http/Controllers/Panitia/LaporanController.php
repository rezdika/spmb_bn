<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\PendaftarBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->periode ?? 'harian';
        $tanggal = $request->tanggal ?? now()->format('Y-m-d');

        if ($periode == 'harian') {
            $startDate = Carbon::parse($tanggal)->startOfDay();
            $endDate = Carbon::parse($tanggal)->endOfDay();
        } elseif ($periode == 'mingguan') {
            $startDate = Carbon::parse($tanggal)->startOfWeek();
            $endDate = Carbon::parse($tanggal)->endOfWeek();
        } else {
            $startDate = Carbon::parse($tanggal)->startOfMonth();
            $endDate = Carbon::parse($tanggal)->endOfMonth();
        }

        $totalVerifikasi = PendaftarBerkas::whereBetween('verified_at', [$startDate, $endDate])
            ->whereNotNull('verified_at')
            ->count();

        $disetujui = PendaftarBerkas::whereBetween('verified_at', [$startDate, $endDate])
            ->where('status', 'approved')
            ->count();

        $ditolak = PendaftarBerkas::whereBetween('verified_at', [$startDate, $endDate])
            ->where('status', 'rejected')
            ->count();

        $berkasVerifikasi = PendaftarBerkas::whereBetween('verified_at', [$startDate, $endDate])
            ->where('status', 'revision')
            ->count();

        $verifikasiPerHari = PendaftarBerkas::whereBetween('verified_at', [$startDate, $endDate])
            ->whereNotNull('verified_at')
            ->select(DB::raw('DATE(verified_at) as tanggal'), DB::raw('count(*) as total'))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $verifikasiPerVerifikator = PendaftarBerkas::whereBetween('verified_at', [$startDate, $endDate])
            ->whereNotNull('verified_at')
            ->join('users', 'pendaftar_berkas.verified_by', '=', 'users.id')
            ->select('users.nama_lengkap as verifikator', DB::raw('count(*) as total'))
            ->groupBy('users.nama_lengkap')
            ->get();

        $detailVerifikasi = PendaftarBerkas::whereBetween('verified_at', [$startDate, $endDate])
            ->whereNotNull('verified_at')
            ->with(['pendaftar.user', 'pendaftar.jurusan', 'verifiedBy'])
            ->orderBy('verified_at', 'desc')
            ->get();

        return view('panitia.pages.laporan.index', compact(
            'periode', 'tanggal', 'totalVerifikasi', 'disetujui', 'ditolak', 
            'berkasVerifikasi', 'verifikasiPerHari', 'verifikasiPerVerifikator', 'detailVerifikasi'
        ));
    }

    public function export(Request $request)
    {
        $periode = $request->periode ?? 'harian';
        $tanggal = $request->tanggal ?? now()->format('Y-m-d');

        if ($periode == 'harian') {
            $startDate = Carbon::parse($tanggal)->startOfDay();
            $endDate = Carbon::parse($tanggal)->endOfDay();
        } elseif ($periode == 'mingguan') {
            $startDate = Carbon::parse($tanggal)->startOfWeek();
            $endDate = Carbon::parse($tanggal)->endOfWeek();
        } else {
            $startDate = Carbon::parse($tanggal)->startOfMonth();
            $endDate = Carbon::parse($tanggal)->endOfMonth();
        }

        $detailVerifikasi = PendaftarBerkas::whereBetween('verified_at', [$startDate, $endDate])
            ->whereNotNull('verified_at')
            ->with(['pendaftar.user', 'pendaftar.jurusan', 'pendaftar.gelombang', 'verifiedBy'])
            ->orderBy('verified_at', 'desc')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'LAPORAN VERIFIKASI PENDAFTARAN');
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', 'Periode: ' . ucfirst($periode));
        $sheet->setCellValue('A3', 'Tanggal: ' . $startDate->format('d/m/Y') . ' - ' . $endDate->format('d/m/Y'));

        // Table Header
        $sheet->setCellValue('A5', 'No');
        $sheet->setCellValue('B5', 'Tanggal Verifikasi');
        $sheet->setCellValue('C5', 'No Pendaftaran');
        $sheet->setCellValue('D5', 'Nama Pendaftar');
        $sheet->setCellValue('E5', 'Jurusan');
        $sheet->setCellValue('F5', 'Jenis Berkas');
        $sheet->setCellValue('G5', 'Status');
        $sheet->setCellValue('H5', 'Verifikator');

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1B1A55']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
        ];
        $sheet->getStyle('A5:H5')->applyFromArray($headerStyle);

        // Data
        $row = 6;
        foreach ($detailVerifikasi as $index => $item) {
            $statusText = match($item->status) {
                'approved' => 'Disetujui',
                'rejected' => 'Ditolak',
                'revision' => 'Perlu Revisi',
                default => 'Pending'
            };
            
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->verified_at->format('d/m/Y H:i'));
            $sheet->setCellValue('C' . $row, $item->pendaftar->no_pendaftaran);
            $sheet->setCellValue('D' . $row, $item->pendaftar->user->nama_lengkap);
            $sheet->setCellValue('E' . $row, $item->pendaftar->jurusan->nama);
            $sheet->setCellValue('F' . $row, $item->jenis);
            $sheet->setCellValue('G' . $row, $statusText);
            $sheet->setCellValue('H' . $row, $item->verifiedBy->nama_lengkap ?? 'Sistem');
            $row++;
        }

        // Styling data
        $dataStyle = [
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
        ];
        $sheet->getStyle('A5:H' . ($row - 1))->applyFromArray($dataStyle);

        // Auto width
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'Laporan_Verifikasi_' . $periode . '_' . now()->format('YmdHis') . '.xlsx';
        
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
}
