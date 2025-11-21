<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use App\Models\Gelombang;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class MonitoringBerkasController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['user', 'jurusan', 'gelombang', 'berkas']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->jurusan_id) {
            $query->where('jurusan_id', $request->jurusan_id);
        }

        if ($request->gelombang_id) {
            $query->where('gelombang_id', $request->gelombang_id);
        }

        if ($request->kelengkapan) {
            if ($request->kelengkapan == 'lengkap') {
                $query->has('berkas', '>=', 5);
            } elseif ($request->kelengkapan == 'belum') {
                $query->has('berkas', '<', 5);
            }
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('no_pendaftaran', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($q2) use ($request) {
                      $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $pendaftarans = $query->orderBy('created_at', 'desc')->paginate(20);
        $jurusans = Jurusan::all();
        $gelombangs = Gelombang::all();

        // Statistik
        $totalPendaftar = Pendaftaran::count();
        $berkasLengkap = Pendaftaran::has('berkas', '>=', 5)->count();
        $berkasBelumLengkap = $totalPendaftar - $berkasLengkap;
        $terverifikasi = Pendaftaran::whereIn('status', ['ADM_PASS', 'ADM_REJECT'])->count();

        return view('admin.pages.monitoring-berkas.index', compact(
            'pendaftarans', 'jurusans', 'gelombangs',
            'totalPendaftar', 'berkasLengkap', 'berkasBelumLengkap', 'terverifikasi'
        ));
    }

    public function export(Request $request)
    {
        $query = Pendaftaran::with(['user', 'jurusan', 'gelombang', 'berkas']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->jurusan_id) {
            $query->where('jurusan_id', $request->jurusan_id);
        }

        if ($request->gelombang_id) {
            $query->where('gelombang_id', $request->gelombang_id);
        }

        $pendaftarans = $query->orderBy('created_at', 'desc')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'MONITORING KELENGKAPAN BERKAS PENDAFTAR');
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Table Header
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'No Pendaftaran');
        $sheet->setCellValue('C3', 'Nama');
        $sheet->setCellValue('D3', 'Jurusan');
        $sheet->setCellValue('E3', 'Gelombang');
        $sheet->setCellValue('F3', 'Total Berkas');
        $sheet->setCellValue('G3', 'Kelengkapan');
        $sheet->setCellValue('H3', 'Status');

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1B1A55']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
        ];
        $sheet->getStyle('A3:H3')->applyFromArray($headerStyle);

        // Data
        $row = 4;
        foreach ($pendaftarans as $index => $item) {
            $totalBerkas = $item->berkas->count();
            $kelengkapan = round(($totalBerkas / 7) * 100);
            
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->no_pendaftaran);
            $sheet->setCellValue('C' . $row, $item->user->nama_lengkap);
            $sheet->setCellValue('D' . $row, $item->jurusan->nama);
            $sheet->setCellValue('E' . $row, $item->gelombang->nama);
            $sheet->setCellValue('F' . $row, $totalBerkas . '/7');
            $sheet->setCellValue('G' . $row, $kelengkapan . '%');
            $sheet->setCellValue('H' . $row, $item->status);
            $row++;
        }

        // Styling
        $dataStyle = [
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
        ];
        $sheet->getStyle('A3:H' . ($row - 1))->applyFromArray($dataStyle);

        // Auto width
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'Monitoring_Berkas_' . now()->format('YmdHis') . '.xlsx';
        
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
}
