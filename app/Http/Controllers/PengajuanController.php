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
    public function index()
    {
        $user = Auth::user();

        if ($user->email === 'admin@lakid.kepri.prov.go.id' || $user->usertype === 'admin' || $user->id === 1) {
            return redirect()->route('admin.dashboard');
        }
        
        $jumlahFasilitasi = Pengajuan::where('kategori', 'Fasilitasi')->where('tahun', date('Y'))->count();
        $kuotaMaksimal = 50;
        $sisaKuota = max(0, $kuotaMaksimal - $jumlahFasilitasi);
        $kuotaPenuh = $jumlahFasilitasi >= $kuotaMaksimal;

        $pengajuans = Pengajuan::where('user_id', $user->id)->latest()->get();

        $totalArsip = Archive::count();
        $totalSistem = Pengajuan::where('status', '!=', 'Draft')->count();
        $totalFasilitasiGlobal = $totalArsip + $totalSistem;

        return view('dashboard', compact('pengajuans', 'kuotaPenuh', 'sisaKuota', 'totalFasilitasiGlobal'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if (empty($user->no_ktp) || empty($user->alamat_ktp) || empty($user->no_hp)) {
            return redirect()->route('profile.edit')
                ->with('warning', 'Mohon lengkapi Biodata (NIK, Alamat, No WA) di Profil Anda sebelum membuat pengajuan.');
        }

        $kategori = $request->query('kategori', 'Mandiri');
        return view('pengajuan.create', compact('kategori'));
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'kategori' => 'required|in:Mandiri,Fasilitasi',
            'file_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];

        if ($request->kategori == 'Fasilitasi') {
            $request->merge(['jenis' => 'Merek']); 
            
            $rules['subsektor_ekraf'] = 'required|string';
            $rules['lokasi_usaha'] = 'required|string';
            $rules['hasil_produk'] = 'required|string';
            $rules['modal_usaha'] = 'required|string';
            $rules['jumlah_tenaga_kerja'] = 'required|integer';
            $rules['pemasaran_distribusi'] = 'required|string';
            $rules['omzet_bulanan'] = 'required|string';
            $rules['usulan_nama_merek'] = 'required|string';

            $rules['file_logo'] = 'nullable|file|mimes:jpg,jpeg,png|max:2048';
            // UPDATE: Tambahkan PDF di sini (Max 5MB)
            $rules['file_foto_produk'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'; 
            $rules['file_ttd'] = 'required|file|mimes:jpg,jpeg,png|max:2048'; 

        } else {
            // Mandiri
            $rules['jenis'] = 'required|in:Merek,Hak Cipta';
            $rules['nama_merek'] = 'required|string|max:255';
            $rules['deskripsi_karya'] = 'required|string';
            $rules['file_surat_permohonan'] = 'required|file|mimes:pdf|max:2048';
            
            $rules['file_npwp'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048';
            $rules['file_cv'] = 'nullable|file|mimes:pdf|max:2048';
            $rules['file_surat_umk'] = 'nullable|file|mimes:pdf|max:2048';
            
            if ($request->jenis == 'Merek') {
                $rules['file_logo'] = 'required|file|mimes:jpg,jpeg,png|max:2048';
                // UPDATE: Tambahkan PDF di sini juga
                $rules['file_foto_produk'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
            } else {
                $rules['file_karya'] = 'required|file|mimes:pdf,mp3,mp4,jpg,jpeg,png|max:5120';
            }
        }

        $request->validate($rules);

        // Upload File
        $fileKtp = $request->file('file_ktp')->store('dokumen/ktp', 'public');
        
        $fileTtd = $request->hasFile('file_ttd') ? $request->file('file_ttd')->store('dokumen/ttd', 'public') : null; 

        $fileSuratPermohonan = $request->hasFile('file_surat_permohonan') ? $request->file('file_surat_permohonan')->store('dokumen/surat_permohonan', 'public') : null;
        $fileNpwp = $request->hasFile('file_npwp') ? $request->file('file_npwp')->store('dokumen/npwp', 'public') : null;
        $fileLogo = $request->hasFile('file_logo') ? $request->file('file_logo')->store('dokumen/logo', 'public') : null;
        $fileKarya = $request->hasFile('file_karya') ? $request->file('file_karya')->store('dokumen/karya', 'public') : null;
        $fileCv = $request->hasFile('file_cv') ? $request->file('file_cv')->store('dokumen/cv', 'public') : null;
        $fileSuratUmk = $request->hasFile('file_surat_umk') ? $request->file('file_surat_umk')->store('dokumen/surat_umk', 'public') : null;
        $fileFotoProduk = $request->hasFile('file_foto_produk') ? $request->file('file_foto_produk')->store('dokumen/foto_produk', 'public') : null;

        $namaMerek = $request->nama_merek;
        $deskripsi = $request->deskripsi_karya;

        if($request->kategori == 'Fasilitasi') {
            $namaMerek = 'Pengajuan Fasilitasi Ekraf'; 
            $deskripsi = $request->hasil_produk;
        }

        Pengajuan::create([
            'user_id' => Auth::id(),
            'kategori' => $request->kategori,
            'jenis' => ($request->kategori == 'Fasilitasi') ? 'Merek' : $request->jenis,
            'nama_merek' => $namaMerek ?? '-',
            'deskripsi_karya' => $deskripsi ?? '-',
            'tahun' => date('Y'),
            'status' => 'Draft',
            'tahapan_proses' => 'Verifikasi Internal',
            
            'file_ktp' => $fileKtp,
            'file_ttd' => $fileTtd,
            'file_npwp' => $fileNpwp,
            'file_surat_permohonan' => $fileSuratPermohonan,
            'file_logo' => $fileLogo,
            'file_karya' => $fileKarya,
            'file_cv' => $fileCv,
            'file_surat_umk' => $fileSuratUmk,
            'file_foto_produk' => $fileFotoProduk,

            'subsektor_ekraf' => $request->subsektor_ekraf,
            'lokasi_usaha' => $request->lokasi_usaha,
            'hasil_produk' => $request->hasil_produk,
            'modal_usaha' => $request->modal_usaha,
            'jumlah_tenaga_kerja' => $request->jumlah_tenaga_kerja,
            'pemasaran_distribusi' => $request->pemasaran_distribusi,
            'omzet_bulanan' => $request->omzet_bulanan,
            'usulan_nama_merek' => $request->usulan_nama_merek,
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan berhasil dibuat! Status saat ini: Draft.');
    }

    public function show(Pengajuan $pengajuan)
    {
        $user = Auth::user();
        $isOwner = $pengajuan->user_id === $user->id;
        $isAdmin = ($user->usertype == 'admin' || $user->id == 1 || $user->email == 'admin@lakid.kepri.prov.go.id');

        if (! $isOwner && ! $isAdmin) {
            abort(403, 'Anda tidak memiliki akses.');
        }
        return view('pengajuan.show', compact('pengajuan'));
    }

    public function destroy(Pengajuan $pengajuan)
    {
        if ($pengajuan->user_id !== Auth::id()) abort(403);
        if ($pengajuan->status == 'Disetujui' || $pengajuan->status == 'Ditolak') return back()->with('error', 'Gagal.');

        $files = [$pengajuan->file_logo, $pengajuan->file_karya, $pengajuan->file_ktp, $pengajuan->file_ttd, $pengajuan->file_npwp, $pengajuan->file_surat_permohonan, $pengajuan->file_cv, $pengajuan->file_surat_umk, $pengajuan->file_foto_produk];
        foreach ($files as $file) {
            if ($file && Storage::disk('public')->exists($file)) Storage::disk('public')->delete($file);
        }
        $pengajuan->delete();
        return redirect()->route('dashboard')->with('success', 'Pengajuan dihapus.');
    }
}