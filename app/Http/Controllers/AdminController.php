<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input pencarian dan filter dari URL
        $search = $request->input('search');
        $status = $request->input('status');

        // Query Dasar
        $query = Pengajuan::with('user')->latest();

        // Jika ada pencarian (Nama merek atau nama user)
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_merek', 'like', "%{$search}%")
                  ->orWhereHas('user', function($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Jika ada filter status
        if ($status) {
            $query->where('status', $status);
        }

        // Ambil data dengan paginasi
        $pengajuans = $query->paginate(10)->withQueryString();

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
        // Validasi input
        $request->validate([
            // Status jadi nullable karena tombol "Simpan Tahapan" tidak kirim status
            'status' => 'nullable|in:Ditinjau,Disetujui,Ditolak', 
            'catatan_admin' => 'nullable|string|max:1000',
            'file_surat_rekomendasi' => 'nullable|file|mimes:pdf|max:2048',
            'tahapan_proses' => 'nullable|string', // Tambahan validasi tahapan
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        
        // Siapkan array data yang akan diupdate
        $data = [];

        // 1. Update Status (Jika ada input status)
        if ($request->has('status') && $request->status != null) {
            $data['status'] = $request->status;
        }

        // 2. Update Catatan Admin
        if ($request->has('catatan_admin')) {
            $data['catatan_admin'] = $request->catatan_admin;
        }

        // 3. Update Tahapan Proses (Khusus Fasilitasi)
        // Kita update jika input ada DAN kategorinya memang Fasilitasi
        if ($request->has('tahapan_proses') && $pengajuan->kategori == 'Fasilitasi') {
            $data['tahapan_proses'] = $request->tahapan_proses;
        }

        // 4. Handle Upload Surat Rekomendasi
        if ($request->hasFile('file_surat_rekomendasi')) {
            // Hapus file lama jika ada (opsional, biar storage ga penuh)
            if ($pengajuan->file_surat_rekomendasi) {
                Storage::disk('public')->delete($pengajuan->file_surat_rekomendasi);
            }
            
            $path = $request->file('file_surat_rekomendasi')->store('surat_rekomendasi', 'public');
            $data['file_surat_rekomendasi'] = $path;
        }

        // Eksekusi update
        $pengajuan->update($data);

        return back()->with('success', 'Data pengajuan berhasil diperbarui.');
    }
}