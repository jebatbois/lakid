<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PimpinanController extends Controller
{
    public function index()
    {
        // === 1. LOGIKA KEAMANAN (CEK EMAIL) ===
        // Hanya email ini yang boleh masuk. Selain itu ditendang (403).
        $currentUser = Auth::user();
        if (! $currentUser || $currentUser->email !== 'kadis@lakid.kepri.prov.go.id') {
            abort(403, 'AKSES DITOLAK. Halaman ini khusus untuk Pimpinan.');
        }

        // === 2. Kartu Statistik Utama ===
        $totalPengajuan = Pengajuan::count();
        $totalDisetujui = Pengajuan::where('status', 'Disetujui')->count();
        $totalDitolak = Pengajuan::where('status', 'Ditolak')->count();
        $totalProses = Pengajuan::whereIn('status', ['Draft', 'Diajukan', 'Ditinjau'])->count();

        // === 3. Data untuk Grafik Lingkaran (Pie Chart) - Distribusi Status ===
        $statusStats = Pengajuan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')->toArray();

        // Pastikan urutan label konsisten
        $allStatuses = ['Draft', 'Diajukan', 'Ditinjau', 'Disetujui', 'Ditolak'];
        $labelsPie = $allStatuses;
        $dataPie = [];
        foreach ($allStatuses as $status) {
            $dataPie[] = $statusStats[$status] ?? 0;
        }

        // === 4. Data untuk Grafik Batang (Bar Chart) - Tren Bulanan (Tahun ini) ===
        $monthlyStats = Pengajuan::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as total')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total', 'month')->toArray();

        $dataBar = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataBar[] = $monthlyStats[$i] ?? 0;
        }

        return view('pimpinan.dashboard', compact(
            'totalPengajuan', 'totalDisetujui', 'totalDitolak', 'totalProses',
            'labelsPie', 'dataPie', 'dataBar'
        ));
    }

    // Fungsi untuk Halaman Cetak (PDF Style)
    public function cetakPdf()
    {
        $totalPengajuan = Pengajuan::count();
        $totalDisetujui = Pengajuan::where('status', 'Disetujui')->count();
        $totalDitolak   = Pengajuan::where('status', 'Ditolak')->count();
        $totalProses    = Pengajuan::whereIn('status', ['Draft', 'Diajukan', 'Ditinjau'])->count();

        // Data Grafik
        $monthlyStats = Pengajuan::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')->orderBy('month')->pluck('total', 'month')->toArray();
        
        $dataBar = [];
        for ($i = 1; $i <= 12; $i++) { $dataBar[] = $monthlyStats[$i] ?? 0; }

        $statusStats = Pengajuan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')->pluck('total', 'status')->toArray();
        $allStatuses = ['Draft', 'Diajukan', 'Ditinjau', 'Disetujui', 'Ditolak'];
        $dataPie = [];
        foreach ($allStatuses as $status) { $dataPie[] = $statusStats[$status] ?? 0; }

        return view('pimpinan.laporan_cetak', compact(
            'totalPengajuan', 'totalDisetujui', 'totalDitolak', 'totalProses', 'dataBar', 'dataPie'
        ));
    }

    // Fungsi Export Excel (CSV)
    public function exportExcel()
    {
        $fileName = 'laporan-lakid-' . date('Y-m-d') . '.csv';

        // Ambil Data Rinci untuk Excel
        $pengajuans = Pengajuan::with('user')->latest()->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($pengajuans) {
            $file = fopen('php://output', 'w');
            
            // Header Kolom Excel
            fputcsv($file, ['No', 'Tanggal', 'Nama Pemohon', 'Nama Merek', 'Jenis', 'Status', 'Catatan Dinas']);

            // Isi Data
            foreach ($pengajuans as $key => $row) {
                fputcsv($file, [
                    $key + 1,
                    $row->created_at->format('Y-m-d H:i'),
                    $row->user->name,
                    $row->nama_merek,
                    $row->jenis,
                    $row->status,
                    $row->catatan_admin ?? '-'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}