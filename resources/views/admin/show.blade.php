<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight">
            {{ __('Verifikasi Pengajuan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Tombol Kembali --}}
            <div class="mb-4">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 font-medium transition">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-8">
                    
                    {{-- HEADER INFORMASI --}}
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-gray-100 pb-6 mb-6 gap-4">
                        <div>
                            {{-- Label Dinamis --}}
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                                {{ $pengajuan->jenis == 'Merek' ? 'Nama Merek' : 'Judul Ciptaan' }}
                            </p>
                            <h1 class="text-3xl font-extrabold text-gray-900">{{ $pengajuan->nama_merek }}</h1>
                            
                            <div class="flex items-center gap-2 mt-2">
                                <span class="bg-gray-100 text-gray-800 text-xs font-bold px-2.5 py-0.5 rounded border border-gray-200 flex items-center gap-1">
                                    {{ $pengajuan->jenis == 'Merek' ? '®' : '©' }} {{ $pengajuan->jenis }}
                                </span>
                                <span class="text-gray-500 text-sm">Pemohon: <strong class="text-gray-700">{{ $pengajuan->user->name }}</strong> ({{ $pengajuan->user->email }})</span>
                                
                                {{-- Badge Kategori --}}
                                @if($pengajuan->kategori == 'Fasilitasi')
                                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded border border-blue-200">
                                        Fasilitasi
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-0.5 rounded border border-yellow-200">
                                        Mandiri
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Status Badge --}}
                        <div class="flex flex-col items-end">
                            <span class="text-xs text-gray-500 uppercase tracking-wide font-bold mb-1">Status Utama</span>
                            @php
                                $colors = [
                                    'Draft' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    'Diajukan' => 'bg-blue-100 text-blue-800 border-blue-200',
                                    'Ditinjau' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                                    'Disetujui' => 'bg-green-100 text-green-800 border-green-200',
                                    'Ditolak' => 'bg-red-100 text-red-800 border-red-200',
                                ];
                                $colorClass = $colors[$pengajuan->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-4 py-1 rounded-full text-sm font-bold border {{ $colorClass }}">
                                {{ $pengajuan->status }}
                            </span>

                            @if($pengajuan->kategori == 'Fasilitasi')
                                <div class="mt-2 text-right">
                                    <span class="text-[10px] text-gray-400 uppercase tracking-wide font-bold">Posisi Tahapan</span>
                                    <div class="text-sm font-semibold text-blue-600">
                                        {{ $pengajuan->tahapan_proses ?? 'Verifikasi Internal' }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">
                            {{ $pengajuan->jenis == 'Merek' ? 'Deskripsi Usaha' : 'Sinopsis / Deskripsi Ciptaan' }}
                        </h3>
                        <div class="bg-gray-50 rounded-lg p-4 text-gray-800 border border-gray-200 leading-relaxed">
                            {{ $pengajuan->deskripsi_karya }}
                        </div>
                    </div>

                    {{-- GRID FILE BERKAS (DINAMIS) --}}
                    <div class="mb-10">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            Verifikasi Kelengkapan Berkas
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            
                            {{-- 1. LOGO vs FILE KARYA --}}
                            @if($pengajuan->jenis == 'Merek')
                                <div class="border rounded-lg p-4 hover:bg-gray-50 transition bg-blue-50/30 border-blue-100">
                                    <span class="block text-xs font-bold text-blue-600 uppercase mb-2">Logo Merek</span>
                                    @if($pengajuan->file_logo)
                                        <div class="mb-3 h-32 bg-white rounded overflow-hidden flex items-center justify-center border">
                                            <img src="{{ asset('storage/'.$pengajuan->file_logo) }}" class="h-full w-full object-contain">
                                        </div>
                                        <a href="{{ asset('storage/'.$pengajuan->file_logo) }}" target="_blank" class="text-blue-600 text-sm font-bold hover:underline flex items-center justify-center gap-1">Lihat Logo</a>
                                    @else
                                        <span class="text-red-500 text-sm italic font-bold">Tidak ada file</span>
                                    @endif
                                </div>
                            @else
                                <div class="border rounded-lg p-4 hover:bg-gray-50 transition bg-yellow-50/30 border-yellow-100">
                                    <span class="block text-xs font-bold text-yellow-700 uppercase mb-2">File Ciptaan (Sampel)</span>
                                    <div class="mb-3 h-32 bg-white rounded flex items-center justify-center border text-yellow-500">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                                    </div>
                                    @if($pengajuan->file_karya)
                                        <a href="{{ asset('storage/'.$pengajuan->file_karya) }}" target="_blank" class="text-blue-600 text-sm font-bold hover:underline flex items-center justify-center gap-1">Download Karya</a>
                                    @else
                                        <span class="text-red-500 text-sm italic font-bold">Tidak ada file</span>
                                    @endif
                                </div>
                            @endif

                            {{-- 2. KTP (Umum) --}}
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                <span class="block text-xs font-bold text-gray-500 uppercase mb-2">KTP Pemohon</span>
                                <div class="mb-3 h-32 bg-gray-100 rounded flex items-center justify-center border text-gray-400">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                </div>
                                <a href="{{ asset('storage/'.$pengajuan->file_ktp) }}" target="_blank" class="text-blue-600 text-sm font-bold hover:underline flex items-center justify-center gap-1">Lihat KTP</a>
                            </div>

                            {{-- 3. NPWP (Umum) --}}
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                <span class="block text-xs font-bold text-gray-500 uppercase mb-2">NPWP</span>
                                <div class="mb-3 h-32 bg-gray-100 rounded flex items-center justify-center border text-gray-400">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                </div>
                                <a href="{{ asset('storage/'.$pengajuan->file_npwp) }}" target="_blank" class="text-blue-600 text-sm font-bold hover:underline flex items-center justify-center gap-1">Lihat NPWP</a>
                            </div>

                            {{-- 4. SURAT PERMOHONAN --}}
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                <span class="block text-xs font-bold text-gray-500 uppercase mb-2">Surat Permohonan</span>
                                <div class="mb-3 h-32 bg-gray-100 rounded flex items-center justify-center border text-gray-400">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <a href="{{ asset('storage/'.$pengajuan->file_surat_permohonan) }}" target="_blank" class="text-blue-600 text-sm font-bold hover:underline flex items-center justify-center gap-1">Lihat Surat</a>
                            </div>

                            {{-- 5. CV / PROFIL (DINAMIS) --}}
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                <span class="block text-xs font-bold text-gray-500 uppercase mb-2">
                                    {{ $pengajuan->jenis == 'Merek' ? 'CV Perusahaan' : 'Profil Pencipta' }}
                                </span>
                                <div class="mb-3 h-32 bg-gray-100 rounded flex items-center justify-center border text-gray-400">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <a href="{{ asset('storage/'.$pengajuan->file_cv) }}" target="_blank" class="text-blue-600 text-sm font-bold hover:underline flex items-center justify-center gap-1">Lihat CV</a>
                            </div>

                            {{-- 6. SURAT PERNYATAAN (DINAMIS) --}}
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                <span class="block text-xs font-bold text-gray-500 uppercase mb-2">
                                    {{ $pengajuan->jenis == 'Merek' ? 'Surat UMK' : 'Surat Keaslian' }}
                                </span>
                                <div class="mb-3 h-32 bg-gray-100 rounded flex items-center justify-center border text-gray-400">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <a href="{{ asset('storage/'.$pengajuan->file_surat_umk) }}" target="_blank" class="text-blue-600 text-sm font-bold hover:underline flex items-center justify-center gap-1">Lihat Surat</a>
                            </div>

                            {{-- 7. FOTO PRODUK / DOKUMENTASI (DINAMIS) --}}
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                <span class="block text-xs font-bold text-gray-500 uppercase mb-2">
                                    {{ $pengajuan->jenis == 'Merek' ? 'Foto Produk' : 'Dokumentasi/Cover' }}
                                </span>
                                @if($pengajuan->file_foto_produk)
                                    <div class="mb-3 h-32 bg-gray-100 rounded overflow-hidden flex items-center justify-center border relative group">
                                        <img src="{{ asset('storage/'.$pengajuan->file_foto_produk) }}" class="h-full w-full object-cover">
                                    </div>
                                    <a href="{{ asset('storage/'.$pengajuan->file_foto_produk) }}" target="_blank" class="text-blue-600 text-sm font-bold hover:underline flex items-center justify-center gap-1">Lihat Foto</a>
                                @else
                                    <div class="mb-3 h-32 bg-gray-100 rounded flex items-center justify-center border text-gray-400">
                                        <span class="text-xs italic">File Kosong</span>
                                    </div>
                                    <span class="text-red-500 text-xs font-bold text-center block">Wajib Upload Ulang</span>
                                @endif
                            </div>

                        </div>
                    </div>

                    {{-- FORM VERIFIKASI ADMIN --}}
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span class="w-6 h-6 bg-gray-800 text-white rounded-full flex items-center justify-center text-xs">🛠</span>
                            Panel Verifikasi Dinas
                        </h4>
                        
                        <form action="{{ route('admin.updateStatus', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            
                            {{-- ========================================== --}}
                            {{-- LOGIKA KHUSUS: PENGATURAN TAHAPAN FASILITASI --}}
                            {{-- ========================================== --}}
                            @if($pengajuan->kategori == 'Fasilitasi')
                                <div class="mb-6 bg-white border border-blue-200 rounded-lg p-5 shadow-sm">
                                    <h5 class="font-bold text-blue-800 mb-2 flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        Update Tracking Fasilitasi
                                    </h5>
                                    <p class="text-sm text-gray-600 mb-4">
                                        Atur progres pengajuan ini agar Pemohon dapat memantau proses secara realtime.
                                    </p>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Posisi Tahapan Saat Ini</label>
                                            <select name="tahapan_proses" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm">
                                                <option value="Verifikasi Internal" {{ ($pengajuan->tahapan_proses ?? 'Verifikasi Internal') == 'Verifikasi Internal' ? 'selected' : '' }}>
                                                    1. Verifikasi Berkas Internal
                                                </option>
                                                <option value="Pendaftaran DJKI" {{ ($pengajuan->tahapan_proses) == 'Pendaftaran DJKI' ? 'selected' : '' }}>
                                                    2. Sedang Proses di DJKI
                                                </option>
                                                <option value="Selesai" {{ ($pengajuan->tahapan_proses) == 'Selesai' ? 'selected' : '' }}>
                                                    3. Selesai (Sertifikat Terbit)
                                                </option>
                                            </select>
                                        </div>
                                        <div class="flex items-end">
                                            @if($pengajuan->status == 'Disetujui')
                                                {{-- Jika sudah disetujui, munculkan tombol update khusus tracking --}}
                                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow transition text-sm">
                                                    Simpan Tahapan
                                                </button>
                                            @else
                                                <div class="text-xs text-gray-500 italic p-2 bg-gray-50 rounded border border-gray-100">
                                                    Tekan tombol "Setujui" di bawah untuk menyimpan perubahan tahapan ini bersamaan.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- ========================================== --}}
                            {{-- LOGIKA UTAMA: APPROVAL / REJECTION --}}
                            {{-- ========================================== --}}
                            @if($pengajuan->status != 'Disetujui')
                                <div class="mb-6 bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-bold text-gray-900 mb-2">
                                        1. Upload Surat Rekomendasi (PDF)
                                        <span class="font-normal text-gray-500 text-xs ml-1">(Wajib jika menyetujui)</span>
                                    </label>
                                    <input type="file" name="file_surat_rekomendasi" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 border border-gray-300 rounded cursor-pointer">
                                </div>
                                
                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">2. Catatan untuk Pemohon (Opsional)</label>
                                    <textarea name="catatan_admin" rows="3" class="w-full rounded-md border-gray-300 shadow-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Berkas lengkap. Surat rekomendasi telah diterbitkan.">{{ $pengajuan->catatan_admin }}</textarea>
                                </div>
                                
                                <div class="flex gap-4 border-t border-gray-200 pt-4">
                                    <button type="submit" name="status" value="Disetujui" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow transition flex justify-center items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Setujui & Proses
                                    </button>
                                    <button type="submit" name="status" value="Ditolak" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg shadow transition flex justify-center items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Tolak Pengajuan
                                    </button>
                                </div>
                            @else
                                {{-- JIKA SUDAH DISETUJUI (READ ONLY MODE UNTUK FILE) --}}
                                <div class="mt-6 text-center p-6 bg-green-50 rounded-lg border border-green-200">
                                    <h3 class="text-lg font-bold text-green-800 flex justify-center items-center gap-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Pengajuan Sudah Disetujui
                                    </h3>
                                    <p class="text-green-700 mb-4 mt-2">Surat rekomendasi telah diterbitkan dan dikirim ke pemohon.</p>
                                    
                                    @if($pengajuan->file_surat_rekomendasi)
                                        <a href="{{ asset('storage/'.$pengajuan->file_surat_rekomendasi) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white border border-green-300 rounded-md font-semibold text-green-700 hover:bg-green-100 shadow-sm transition">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Cek Surat Rekomendasi
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>