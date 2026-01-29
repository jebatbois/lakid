<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Menampilkan Dashboard User.
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Cek Admin (Redirect ke Dashboard Admin)
        if ($user->email === 'admin@lakid.kepri.prov.go.id' || $user->usertype === 'admin' || $user->id === 1) {
            return redirect()->route('admin.dashboard');
        }
        
        // (LOGIKA PIMPINAN DIHAPUS DISINI)

        // 2. LOGIKA KUOTA FASILITASI
        $jumlahFasilitasi = Pengajuan::where('kategori', 'Fasilitasi')
                            ->where('tahun', date('Y'))
                            ->count();

        $kuotaMaksimal = 50;
        $sisaKuota = max(0, $kuotaMaksimal - $jumlahFasilitasi);
        $kuotaPenuh = $jumlahFasilitasi >= $kuotaMaksimal;

        // 3. Ambil riwayat user
        $pengajuans = Pengajuan::where('user_id', $user->id)->latest()->get();

        // 4. Statistik Global
        $totalArsip = Archive::count();
        $totalSistem = Pengajuan::where('status', '!=', 'Draft')->count();
        $totalFasilitasiGlobal = $totalArsip + $totalSistem;

        return view('dashboard', compact('pengajuans', 'kuotaPenuh', 'sisaKuota', 'totalFasilitasiGlobal'));
    }

    public function create(Request $request): View
    {
        $kategori = $request->query('kategori', 'Mandiri');
        return view('pengajuan.create', compact('kategori'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'kategori' => 'required|in:Mandiri,Fasilitasi',
            'jenis' => 'required|in:Merek,Hak Cipta',
            'nama_merek' => 'required|string|max:255',
            'deskripsi_karya' => 'required|string',
            'file_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_npwp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_surat_permohonan' => 'required|file|mimes:pdf|max:2048',
            'file_logo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'file_karya' => 'nullable|file|mimes:pdf,mp3,mp4,jpg,jpeg,png|max:5120',
            'file_cv' => 'nullable|file|mimes:pdf|max:2048',
            'file_surat_umk' => 'nullable|file|mimes:pdf|max:2048',
            'file_foto_produk' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fileKtp = $request->file('file_ktp')->store('dokumen/ktp', 'public');
        $fileNpwp = $request->hasFile('file_npwp') ? $request->file('file_npwp')->store('dokumen/npwp', 'public') : null;
        $fileSuratPermohonan = $request->file('file_surat_permohonan')->store('dokumen/surat_permohonan', 'public');
        $fileLogo = $request->hasFile('file_logo') ? $request->file('file_logo')->store('dokumen/logo', 'public') : null;
        $fileKarya = $request->hasFile('file_karya') ? $request->file('file_karya')->store('dokumen/karya', 'public') : null;
        $fileCv = $request->hasFile('file_cv') ? $request->file('file_cv')->store('dokumen/cv', 'public') : null;
        $fileSuratUmk = $request->hasFile('file_surat_umk') ? $request->file('file_surat_umk')->store('dokumen/surat_umk', 'public') : null;
        $fileFotoProduk = $request->hasFile('file_foto_produk') ? $request->file('file_foto_produk')->store('dokumen/foto_produk', 'public') : null;

        Pengajuan::create([
            'user_id' => Auth::id(),
            'kategori' => $request->kategori,
            'jenis' => $request->jenis,
            'nama_merek' => $request->nama_merek,
            'deskripsi_karya' => $request->deskripsi_karya,
            'tahun' => date('Y'),
            'status' => 'Draft',
            'tahapan_proses' => 'Verifikasi Internal',
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

    public function show(Pengajuan $pengajuan)
    {
        $user = Auth::user();
        
        // Logika Pimpinan dihapus dari pengecekan akses
        $isOwner = $pengajuan->user_id === $user->id;
        $isAdmin = ($user->usertype == 'admin' || $user->id == 1 || $user->email == 'admin@lakid.kepri.prov.go.id');

        if (! $isOwner && ! $isAdmin) {
            abort(403, 'Anda tidak memiliki akses untuk melihat pengajuan ini.');
        }

        return view('pengajuan.show', compact('pengajuan'));
    }

    public function destroy(Pengajuan $pengajuan)
    {
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($pengajuan->status == 'Disetujui' || $pengajuan->status == 'Ditolak') {
            return back()->with('error', 'Pengajuan yang sudah selesai tidak dapat dibatalkan.');
        }

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