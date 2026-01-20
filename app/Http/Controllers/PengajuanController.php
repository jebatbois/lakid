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
     * Show the form for creating a new pengajuan.
     */
    public function create(): View
    {
        $jenis_options = [
            'Merek',
            'Hak Cipta',
            'Desain Industri',
        ];

        return view('pengajuan.create', compact('jenis_options'));
    }

    /**
     * Store a newly created pengajuan in storage.
     */
public function store(Request $request)
{
    // 1. Validasi Input (Tambahkan field baru)
    $rules = [
        'jenis' => 'required',
        'deskripsi_karya' => 'required',
        // Dokumen Wajib Umum
        'file_ktp'              => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'file_npwp'             => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'file_surat_permohonan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'file_cv'               => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // CV maks 5MB
        'file_surat_umk'        => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'file_foto_produk'      => 'required|file|mimes:jpg,jpeg,png|max:5120', // Foto maks 5MB
    ];

    // Validasi Khusus
    if ($request->jenis == 'Merek') {
        $rules['nama_merek'] = 'required';
        $rules['file_logo'] = 'required|file|mimes:jpg,jpeg,png|max:2048';
    } elseif ($request->jenis == 'Hak Cipta') {
        $rules['judul_ciptaan'] = 'required';
        $rules['file_karya'] = 'required|file|mimes:mp3,pdf,mp4,doc,docx|max:20480';
    }

    $request->validate($rules);

    // 2. Siapkan Data Dasar
    $data = [
        'user_id' => Auth::id(),
        'jenis' => $request->jenis,
        'deskripsi_karya' => $request->deskripsi_karya,
        'status' => 'Diajukan', // Status awal
    ];

    // 3. Fungsi Helper Upload (Biar kodenya rapi)
    // Simpan file ke folder public storage
    if ($request->hasFile('file_ktp')) {
        $data['file_ktp'] = $request->file('file_ktp')->store('dokumen_ktp', 'public');
    }
    if ($request->hasFile('file_npwp')) {
        $data['file_npwp'] = $request->file('file_npwp')->store('dokumen_npwp', 'public');
    }
    if ($request->hasFile('file_surat_permohonan')) {
        $data['file_surat_permohonan'] = $request->file('file_surat_permohonan')->store('dokumen_permohonan', 'public');
    }
    if ($request->hasFile('file_cv')) {
        $data['file_cv'] = $request->file('file_cv')->store('dokumen_cv', 'public');
    }
    if ($request->hasFile('file_surat_umk')) {
        $data['file_surat_umk'] = $request->file('file_surat_umk')->store('dokumen_umk', 'public');
    }
    if ($request->hasFile('file_foto_produk')) {
        $data['file_foto_produk'] = $request->file('file_foto_produk')->store('dokumen_produk', 'public');
    }

    // 4. Upload Khusus Merek
    if ($request->jenis == 'Merek') {
        $data['nama_merek'] = $request->nama_merek;
        if ($request->hasFile('file_logo')) {
            $data['file_logo'] = $request->file('file_logo')->store('dokumen_logo', 'public');
        }
    }

    // 5. Upload Khusus Hak Cipta
    if ($request->jenis == 'Hak Cipta') {
        $data['nama_merek'] = $request->judul_ciptaan; // Simpan judul ke kolom nama_merek
        if ($request->hasFile('file_karya')) {
            $data['file_karya'] = $request->file('file_karya')->store('dokumen_karya', 'public');
        }
    }

    // 6. Simpan ke Database
    Pengajuan::create($data);

    return redirect()->route('dashboard')->with('success', 'Pengajuan berhasil dikirim! Silakan tunggu verifikasi admin.');
}

    /**
     * Show the form for editing a pengajuan.
     */
    public function edit(Pengajuan $pengajuan): View
    {
        // Authorization: only draft pengajuans can be edited
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        if ($pengajuan->status !== 'Draft') {
            abort(403, 'Hanya pengajuan Draft yang dapat diubah.');
        }

        $jenis_options = [
            'Merek',
            'Hak Cipta',
            'Desain Industri',
        ];

        return view('pengajuan.edit', compact('pengajuan', 'jenis_options'));
    }

    /**
     * Update the specified pengajuan in storage.
     */
    public function update(Request $request, Pengajuan $pengajuan): RedirectResponse
    {
        // Authorization
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        if ($pengajuan->status !== 'Draft') {
            abort(403, 'Hanya pengajuan Draft yang dapat diubah.');
        }

        $validated = $request->validate([
            'nama_merek' => [
                'required',
                'string',
                'max:255',
            ],
            'jenis' => [
                'required',
                'string',
                'in:Merek,Hak Cipta,Desain Industri',
            ],
            'deskripsi_karya' => [
                'required',
                'string',
                'min:20',
                'max:1000',
            ],
            'file_logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ],
            'file_ktp' => [
                'nullable',
                'file',
                'mimes:jpeg,png,jpg,pdf',
                'max:2048',
            ],
        ]);

        $update_data = [
            'nama_merek' => $validated['nama_merek'],
            'jenis' => $validated['jenis'],
            'deskripsi_karya' => $validated['deskripsi_karya'],
        ];

        // Handle file logo update
        if ($request->hasFile('file_logo')) {
            if ($pengajuan->file_logo) {
                Storage::disk('public')->delete($pengajuan->file_logo);
            }
            $update_data['file_logo'] = $request->file('file_logo')
                ->store('uploads', 'public');
        }

        // Handle file ktp update
        if ($request->hasFile('file_ktp')) {
            if ($pengajuan->file_ktp) {
                Storage::disk('public')->delete($pengajuan->file_ktp);
            }
            $update_data['file_ktp'] = $request->file('file_ktp')
                ->store('uploads', 'public');
        }

        $pengajuan->update($update_data);

        return redirect()
            ->route('pengajuan.show', $pengajuan)
            ->with('success', 'Pengajuan berhasil diperbarui.');
    }

    /**
     * Delete the specified pengajuan from storage.
     */
   public function destroy(Pengajuan $pengajuan)
    {
        // 1. Cek Kepemilikan (Security)
        if ($pengajuan->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // 2. Cek Status (Hanya boleh hapus jika belum diproses jauh)
        if ($pengajuan->status == 'Disetujui' || $pengajuan->status == 'Ditolak') {
            return back()->with('error', 'Pengajuan yang sudah selesai tidak dapat dibatalkan.');
        }

        // 3. Hapus File Fisik dari Storage (Agar server bersih)
        $files = [
            $pengajuan->file_logo,
            $pengajuan->file_karya,
            $pengajuan->file_ktp,
            $pengajuan->file_npwp,
            $pengajuan->file_surat_permohonan,
            $pengajuan->file_cv,
            $pengajuan->file_surat_umk,
            $pengajuan->file_foto_produk
        ];

        foreach ($files as $file) {
            if ($file && \Illuminate\Support\Facades\Storage::disk('public')->exists($file)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($file);
            }
        }

        // 4. Hapus Data dari Database
        $pengajuan->delete();

        return redirect()->route('dashboard')->with('success', 'Pengajuan berhasil dibatalkan dan dihapus.');
    }

    /**
     * Submit a draft pengajuan for review.
     */
    public function submit(Pengajuan $pengajuan): RedirectResponse
    {
        // Authorization
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        if ($pengajuan->status !== 'Draft') {
            abort(403, 'Hanya pengajuan Draft yang dapat diajukan.');
        }

        // Update status to Diajukan
        $pengajuan->update(['status' => 'Diajukan']);

        return redirect()
            ->route('pengajuan.show', $pengajuan)
            ->with('success', 'Pengajuan berhasil diajukan untuk ditinjau.');
    }

    /**
     * Menampilkan detail pengajuan spesifik untuk User pemiliknya.
     */
    public function show(Pengajuan $pengajuan)
    {
        // Ambil User yang sedang login
        $user = \Illuminate\Support\Facades\Auth::user();

        // LOGIKA KEAMANAN BARU:
        // Izinkan jika: 
        // 1. Dia adalah pemilik pengajuan (user_id sama)
        // 2. ATAU Dia adalah Admin (email admin)
        // 3. ATAU Dia adalah Pimpinan (email kadis)
        
        $isOwner = $pengajuan->user_id === $user->id;
        $isAdmin = $user->email === 'admin@lakid.kepri.prov.go.id';
        $isKadis = $user->email === 'kadis@lakid.kepri.prov.go.id';

        if (! $isOwner && ! $isAdmin && ! $isKadis) {
            abort(403, 'Anda tidak memiliki akses untuk melihat pengajuan ini.');
        }

        return view('pengajuan.show', compact('pengajuan'));
    }


}
