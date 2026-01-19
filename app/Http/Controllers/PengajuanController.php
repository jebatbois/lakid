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
    public function store(Request $request): RedirectResponse
    {
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
            'file_surat_umk' => [
                'nullable',
                'file',
                'mimes:pdf,jpeg,png,jpg',
                'max:2048',
            ],
        ], [
            'nama_merek.required' => 'Nama merek/karya wajib diisi.',
            'nama_merek.max' => 'Nama merek/karya tidak boleh lebih dari 255 karakter.',
            'jenis.required' => 'Jenis HKI wajib dipilih.',
            'jenis.in' => 'Jenis HKI tidak valid.',
            'deskripsi_karya.required' => 'Deskripsi karya wajib diisi.',
            'deskripsi_karya.min' => 'Deskripsi karya minimal 20 karakter.',
            'file_logo.image' => 'File logo harus berupa gambar.',
            'file_logo.mimes' => 'Format file logo harus JPEG, PNG, JPG, atau GIF.',
            'file_logo.max' => 'Ukuran file logo tidak boleh lebih dari 2MB.',
            'file_ktp.mimes' => 'Format file KTP harus JPEG, PNG, JPG, atau PDF.',
            'file_ktp.max' => 'Ukuran file KTP tidak boleh lebih dari 2MB.',
            'file_surat_umk.file' => 'File surat UMK harus berupa file.',
            'file_surat_umk.mimes' => 'Format file surat UMK harus PDF, JPEG, PNG, atau JPG.',
            'file_surat_umk.max' => 'Ukuran file surat UMK tidak boleh lebih dari 2MB.',
        ]);

        $pengajuan_data = [
            'user_id' => Auth::id(),
            'nama_merek' => $validated['nama_merek'],
            'jenis' => $validated['jenis'],
            'deskripsi_karya' => $validated['deskripsi_karya'],
            'status' => 'Draft',
        ];

        // Handle file uploads
        if ($request->hasFile('file_logo')) {
            $pengajuan_data['file_logo'] = $request->file('file_logo')
                ->store('uploads', 'public');
        }

        if ($request->hasFile('file_ktp')) {
            $pengajuan_data['file_ktp'] = $request->file('file_ktp')
                ->store('uploads', 'public');
        }

        if ($request->hasFile('file_surat_umk')) {
            $pengajuan_data['file_surat_umk'] = $request->file('file_surat_umk')
                ->store('uploads', 'public');
        }

        Pengajuan::create($pengajuan_data);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Pengajuan berhasil dibuat dan disimpan sebagai Draft.');
    }

    /**
     * Display the specified pengajuan.
     */
    public function show(Pengajuan $pengajuan): View
    {
        // Authorization: user can only view their own pengajuans
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('pengajuan.show', compact('pengajuan'));
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
    public function destroy(Pengajuan $pengajuan): RedirectResponse
    {
        // Authorization
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        if ($pengajuan->status !== 'Draft') {
            abort(403, 'Hanya pengajuan Draft yang dapat dihapus.');
        }

        // Delete files
        if ($pengajuan->file_logo) {
            Storage::disk('public')->delete($pengajuan->file_logo);
        }

        if ($pengajuan->file_ktp) {
            Storage::disk('public')->delete($pengajuan->file_ktp);
        }

        $pengajuan->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Pengajuan berhasil dihapus.');
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
}
