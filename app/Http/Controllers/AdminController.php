<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua data, urutkan terbaru, load relasi User biar hemat query
        $pengajuans = Pengajuan::with('user')->latest()->get();
        return view('admin.dashboard', compact('pengajuans'));
    }

    public function show($id)
    {
        // Ambil data pengajuan berdasarkan ID, beserta data user-nya
        $pengajuan = Pengajuan::with('user')->findOrFail($id);
        
        // Tampilkan ke view detail khusus admin
        return view('admin.show', compact('pengajuan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Ditinjau,Disetujui,Ditolak',
            'catatan_admin' => 'nullable|string|max:1000',
            'file_surat_rekomendasi' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $data = [
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin
        ];

        // Jika Admin upload surat rekomendasi
        if ($request->hasFile('file_surat_rekomendasi')) {
            $path = $request->file('file_surat_rekomendasi')->store('surat_rekomendasi', 'public');
            $data['file_surat_rekomendasi'] = $path;
        }

        $pengajuan->update($data);

        return back()->with('success', 'Status dan dokumen berhasil diperbarui.');
    }
}