<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
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
        
        // PENTING: Variabel ini yang dicari oleh Dashboard
        $kuotaPenuh = $jumlahFasilitasi >= $kuotaMaksimal;

        // 3. Ambil data riwayat pengajuan user ini
        $pengajuans = Pengajuan::where('user_id', $user->id)->latest()->get();
        
        // 4. Lempar variabel ke view dashboard
        return view('dashboard', compact('pengajuans', 'sisaKuota', 'kuotaPenuh'));
    }

    /**
     * Show the form for creating a new pengajuan.
     */
   public function create(Request $request): View
    {
        // PERBAIKAN: Ubah 'tipe' menjadi 'kategori' sesuai link di dashboard
        $kategori = $request->query('kategori', 'Mandiri'); 

        // Cek Kuota Fasilitasi
        if ($kategori == 'Fasilitasi') {
            $terpakai = Pengajuan::where('kategori', 'Fasilitasi')
                        ->where('tahun', date('Y'))
                        ->count();
            
            if ($terpakai >= 50) {
                return redirect()->route('dashboard')->with('error', 'Mohon maaf, Kuota Fasilitasi tahun ini sudah penuh.');
            }
        }

        return view('pengajuan.create', compact('kategori'));
    }

    /**
     * Store a newly created pengajuan in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $rules = [
            'jenis' => 'required',
            'deskripsi_karya' => 'required',
            'kategori' => 'required', // Penting untuk membedakan jalur
            // Dokumen Wajib Umum
            'file_ktp'              => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_npwp'             => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_surat_permohonan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_cv'               => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_surat_umk'        => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_foto_produk'      => 'required|file|mimes:jpg,jpeg,png|max:5120',
        ];

        // Validasi Khusus berdasarkan jenis layanan
        if ($request->jenis == 'Merek') {
            $rules['nama_merek'] = 'required';
            $rules['file_logo'] = 'required|file|mimes:jpg,jpeg,png|max:2048';
        } elseif ($request->jenis == 'Hak Cipta') {
            $rules['judul_ciptaan'] = 'required';
            $rules['file_karya'] = 'required|file|mimes:mp3,pdf,mp4,doc,docx|max:20480';
        }

        $request->validate($rules);

        // --- CEK KUOTA LAGI (Backend Validation) ---
        if ($request->kategori == 'Fasilitasi') {
            $jumlahFasilitasi = Pengajuan::where('kategori', 'Fasilitasi')
                                ->where('tahun', date('Y'))
                                ->count();
            if ($jumlahFasilitasi >= 50) {
                return back()->with('error', 'Mohon maaf, kuota Fasilitasi tahun ini sudah penuh.');
            }
        }

        // 2. Siapkan Data Dasar
        $data = [
            'user_id' => Auth::id(),
            'jenis' => $request->jenis,
            'deskripsi_karya' => $request->deskripsi_karya,
            'status' => 'Diajukan',
            'kategori' => $request->kategori, // SIMPAN KATEGORI YANG BENAR
            'tahun' => date('Y'),
            'tahapan_proses' => ($request->kategori == 'Fasilitasi') ? 'Verifikasi Berkas' : null,
        ];

        // 3. Proses Upload File (Helper Upload)
        if ($request->hasFile('file_ktp')) $data['file_ktp'] = $request->file('file_ktp')->store('dokumen_ktp', 'public');
        if ($request->hasFile('file_npwp')) $data['file_npwp'] = $request->file('file_npwp')->store('dokumen_npwp', 'public');
        if ($request->hasFile('file_surat_permohonan')) $data['file_surat_permohonan'] = $request->file('file_surat_permohonan')->store('dokumen_permohonan', 'public');
        if ($request->hasFile('file_cv')) $data['file_cv'] = $request->file('file_cv')->store('dokumen_cv', 'public');
        if ($request->hasFile('file_surat_umk')) $data['file_surat_umk'] = $request->file('file_surat_umk')->store('dokumen_umk', 'public');
        if ($request->hasFile('file_foto_produk')) $data['file_foto_produk'] = $request->file('file_foto_produk')->store('dokumen_produk', 'public');

        // 4. Upload Khusus
        if ($request->jenis == 'Merek') {
            $data['nama_merek'] = $request->nama_merek;
            if ($request->hasFile('file_logo')) {
                $data['file_logo'] = $request->file('file_logo')->store('dokumen_logo', 'public');
            }
        } elseif ($request->jenis == 'Hak Cipta') {
            $data['nama_merek'] = $request->judul_ciptaan; // Simpan judul sebagai nama pengajuan
            $data['judul_ciptaan'] = $request->judul_ciptaan;
            if ($request->hasFile('file_karya')) {
                $data['file_karya'] = $request->file('file_karya')->store('dokumen_karya', 'public');
            }
        }

        // 6. Simpan ke Database
        Pengajuan::create($data);

        return redirect()->route('dashboard')->with('success', 'Pengajuan berhasil dikirim! Silakan tunggu verifikasi admin.');
    }

    /**
     * Menampilkan detail pengajuan.
     */
    public function show(Pengajuan $pengajuan)
    {
        $user = Auth::user();
        
        // Logika Akses: Pemilik OR Admin OR Pimpinan
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

        // Hapus data
        $pengajuan->delete();

        return redirect()->route('dashboard')->with('success', 'Pengajuan berhasil dibatalkan dan dihapus.');
    }
}