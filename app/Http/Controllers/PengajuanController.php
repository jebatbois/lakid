<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Archive; // Tambahkan Model Archive
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Menampilkan Dashboard User (Logika Kuota & Redirect).
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Cek Admin & Pimpinan (Redirect ke Dashboard masing-masing)
        if ($user->email === 'admin@lakid.kepri.prov.go.id') {
            return redirect()->route('admin.dashboard');
        }
        if ($user->email === 'kadis@lakid.kepri.prov.go.id') {
            return redirect()->route('pimpinan.dashboard');
        }
        
        // 2. LOGIKA KUOTA FASILITASI (Hitung sisa kuota)
        $jumlahFasilitasi = Pengajuan::where('kategori', 'Fasilitasi')
                            ->where('tahun', date('Y'))
                            ->count();

        $kuotaMaksimal = 50;
        $sisaKuota = max(0, $kuotaMaksimal - $jumlahFasilitasi);
        $kuotaPenuh = $jumlahFasilitasi >= $kuotaMaksimal;

        // 3. Ambil data riwayat pengajuan user ini
        $pengajuans = Pengajuan::where('user_id', $user->id)->latest()->get();

        // 4. STATISTIK GLOBAL (GABUNGAN ARSIP & SISTEM)
        // Menghitung total data dari Arsip + Data Pengajuan Aktif (Bukan Draft)
        $totalArsip = Archive::count();
        $totalSistem = Pengajuan::where('status', '!=', 'Draft')->count();
        $totalFasilitasiGlobal = $totalArsip + $totalSistem;

        return view('dashboard', compact('pengajuans', 'kuotaPenuh', 'sisaKuota', 'totalFasilitasiGlobal'));
    }

    /**
     * Menampilkan Form Pengajuan (Create).
     */
    public function create(Request $request): View
    {
        $kategori = $request->query('kategori', 'Mandiri'); // Default Mandiri jika tidak ada parameter
        return view('pengajuan.create', compact('kategori'));
    }

    /**
     * Menyimpan Pengajuan Baru (Store).
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi Input
        $request->validate([
            'kategori' => 'required|in:Mandiri,Fasilitasi',
            'jenis' => 'required|in:Merek,Hak Cipta',
            'nama_merek' => 'required|string|max:255',
            'deskripsi_karya' => 'required|string',
            // Validasi File (Maks 2MB, PDF/JPG/PNG)
            'file_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_npwp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // Opsional
            'file_surat_permohonan' => 'required|file|mimes:pdf|max:2048',
            'file_logo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Khusus Merek
            'file_karya' => 'nullable|file|mimes:pdf,mp3,mp4,jpg,jpeg,png|max:5120', // Khusus Hak Cipta (Max 5MB)
            'file_cv' => 'nullable|file|mimes:pdf|max:2048',
            'file_surat_umk' => 'nullable|file|mimes:pdf|max:2048',
            'file_foto_produk' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload File ke Storage
        $fileKtp = $request->file('file_ktp')->store('dokumen/ktp', 'public');
        $fileNpwp = $request->hasFile('file_npwp') ? $request->file('file_npwp')->store('dokumen/npwp', 'public') : null;
        $fileSuratPermohonan = $request->file('file_surat_permohonan')->store('dokumen/surat_permohonan', 'public');
        $fileLogo = $request->hasFile('file_logo') ? $request->file('file_logo')->store('dokumen/logo', 'public') : null;
        $fileKarya = $request->hasFile('file_karya') ? $request->file('file_karya')->store('dokumen/karya', 'public') : null;
        $fileCv = $request->hasFile('file_cv') ? $request->file('file_cv')->store('dokumen/cv', 'public') : null;
        $fileSuratUmk = $request->hasFile('file_surat_umk') ? $request->file('file_surat_umk')->store('dokumen/surat_umk', 'public') : null;
        $fileFotoProduk = $request->hasFile('file_foto_produk') ? $request->file('file_foto_produk')->store('dokumen/foto_produk', 'public') : null;

        // Simpan ke Database
        Pengajuan::create([
            'user_id' => Auth::id(),
            'kategori' => $request->kategori,
            'jenis' => $request->jenis,
            'nama_merek' => $request->nama_merek,
            'deskripsi_karya' => $request->deskripsi_karya,
            'tahun' => date('Y'),
            'status' => 'Draft', // Status awal
            'tahapan_proses' => 'Verifikasi Internal', // Default step
            
            // Path File
            'file_ktp' => $fileKtp,
            'file_npwp' => $fileNpwp,
            'file_surat_permohonan' => $fileSuratPermohonan,
            'file_logo' => $fileLogo,
            'file_karya' => $fileKarya,
            'file_cv' => $fileCv,
            'file_surat_umk' => $fileSuratUmk,
            'file_foto_produk' => $fileFotoProduk,
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan berhasil dibuat! Status saat ini: Draft.');
    }

    /**
     * Menampilkan Detail Pengajuan.
     */
    public function show(Pengajuan $pengajuan)
    {
        $user = Auth::user();
        
        // Otorisasi: Hanya pemilik, Admin, atau Kadis yang boleh lihat
        $isOwner = $pengajuan->user_id === $user->id;
        $isAdmin = $user->email === 'admin@lakid.kepri.prov.go.id';
        $isKadis = $user->email === 'kadis@lakid.kepri.prov.go.id';

        if (! $isOwner && ! $isAdmin && ! $isKadis) {
            abort(403, 'Anda tidak memiliki akses untuk melihat pengajuan ini.');
        }

        return view('pengajuan.show', compact('pengajuan'));
    }

    /**
     * Menghapus/Membatalkan Pengajuan.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        // Hanya pemilik yang boleh hapus
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hanya bisa hapus jika belum diproses final
        if ($pengajuan->status == 'Disetujui' || $pengajuan->status == 'Ditolak') {
            return back()->with('error', 'Pengajuan yang sudah selesai tidak dapat dibatalkan.');
        }

        // Hapus semua file fisik agar server bersih
        $files = [
            $pengajuan->file_logo, $pengajuan->file_karya, $pengajuan->file_ktp,
            $pengajuan->file_npwp, $pengajuan->file_surat_permohonan, $pengajuan->file_cv,
            $pengajuan->file_surat_umk, $pengajuan->file_foto_produk
        ];

        foreach ($files as $file) {
            if ($file && Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
        }

        $pengajuan->delete();

        return redirect()->route('dashboard')->with('success', 'Pengajuan berhasil dibatalkan dan dihapus.');
    }
}