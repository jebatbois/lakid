<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchiveController extends Controller
{
    public function index()
    {
        // 1. AMBIL DATA HISTORIS (ARSIP)
        // Kelompokkan berdasarkan tahun
        $historicalData = Archive::select('tahun', DB::raw('count(*) as total'))
            ->groupBy('tahun')
            ->pluck('total', 'tahun')
            ->toArray();

        // 2. AMBIL DATA REAL-TIME (PENGAJUAN SEKARANG)
        // Kelompokkan berdasarkan tahun pembuatan
        $currentData = Pengajuan::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
            ->groupBy('year')
            ->pluck('total', 'year')
            ->toArray();

        // 3. GABUNGKAN DATA (MERGE)
        // Kita buat array list tahun dari 2020 sampai tahun depan agar grafik rapi
        $startYear = 2023; 
        $endYear = date('Y') + 1;
        $years = [];
        $totals = [];

        for ($y = $startYear; $y <= $endYear; $y++) {
            $years[] = $y;
            // Jumlahkan jika ada data di Arsip ATAU di Pengajuan pada tahun tersebut
            $countArchive = $historicalData[$y] ?? 0;
            $countCurrent = $currentData[$y] ?? 0;
            $totals[] = $countArchive + $countCurrent;
        }

        // 4. AMBIL LIST DATA UNTUK TABEL (Pagination)
        $archives = Archive::latest()->paginate(10);

        return view('admin.archives.index', compact('years', 'totals', 'archives'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required|string',
            'nama_merek' => 'required|string',
            'jenis' => 'required|string',
            'tahun' => 'required|integer|digits:4',
        ]);

        Archive::create([
            'nama_pemohon' => $request->nama_pemohon,
            'nama_merek' => $request->nama_merek,
            'jenis' => $request->jenis,
            'tahun' => $request->tahun,
            'keterangan' => 'Migrasi Data Lakid',
            'status' => 'Selesai'
        ]);

        return back()->with('success', 'Data arsip berhasil ditambahkan.');
    }
    
    public function destroy($id)
    {
        Archive::findOrFail($id)->delete();
        return back()->with('success', 'Data arsip dihapus.');
    }
}