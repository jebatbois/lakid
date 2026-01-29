<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Archive; // Tambahkan Model Archive
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // Tambahkan Facade DB

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // 1. LOGIKA PENCARIAN & FILTER TABEL
        $search = $request->input('search');
        $status = $request->input('status');

        $query = Pengajuan::with('user')->latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_merek', 'like', "%{$search}%")
                  ->orWhereHas('user', function($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $pengajuans = $query->paginate(10)->withQueryString();

        // 2. LOGIKA GRAFIK (DIPINDAHKAN DARI PIMPINAN/ARCHIVE)
        // Ambil data Arsip (Manual)
        $historicalData = Archive::select('tahun', DB::raw('count(*) as total'))
            ->groupBy('tahun')
            ->pluck('total', 'tahun')
            ->toArray();

        // Ambil data Sistem (Realtime) - Kecuali Draft
        $currentData = Pengajuan::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
            ->where('status', '!=', 'Draft')
            ->groupBy('year')
            ->pluck('total', 'year')
            ->toArray();

        // Gabungkan Data (Merge)
        $startYear = 2023; 
        $endYear = date('Y') + 1;
        $years = [];
        $totals = [];

        for ($y = $startYear; $y <= $endYear; $y++) {
            $years[] = $y;
            $countArchive = $historicalData[$y] ?? 0;
            $countCurrent = $currentData[$y] ?? 0;
            $totals[] = $countArchive + $countCurrent;
        }

        // Kirim data 'years' dan 'totals' ke view
        return view('admin.dashboard', compact('pengajuans', 'years', 'totals'));
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::with('user')->findOrFail($id);
        return view('admin.show', compact('pengajuan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'nullable|in:Ditinjau,Disetujui,Ditolak', 
            'catatan_admin' => 'nullable|string|max:1000',
            'file_surat_rekomendasi' => 'nullable|file|mimes:pdf|max:2048',
            'tahapan_proses' => 'nullable|string', 
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $data = [];

        if ($request->has('status') && $request->status != null) {
            $data['status'] = $request->status;
        }

        if ($request->has('catatan_admin')) {
            $data['catatan_admin'] = $request->catatan_admin;
        }

        if ($request->has('tahapan_proses') && $pengajuan->kategori == 'Fasilitasi') {
            $data['tahapan_proses'] = $request->tahapan_proses;
        }

        if ($request->hasFile('file_surat_rekomendasi')) {
            if ($pengajuan->file_surat_rekomendasi) {
                Storage::disk('public')->delete($pengajuan->file_surat_rekomendasi);
            }
            $path = $request->file('file_surat_rekomendasi')->store('surat_rekomendasi', 'public');
            $data['file_surat_rekomendasi'] = $path;
        }

        $pengajuan->update($data);

        return back()->with('success', 'Data pengajuan berhasil diperbarui.');
    }
}