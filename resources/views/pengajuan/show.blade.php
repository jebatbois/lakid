<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight">
            {{ __('Detail Pengajuan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            {{-- TOMBOL NAVIGASI ATAS --}}
            <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
                {{-- Tombol Kembali --}}
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 font-medium transition self-start md:self-auto">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Dashboard
                </a>

                {{-- TOMBOL BATAL AJUKAN (Hanya muncul jika status Diajukan/Draft) --}}
                @if($pengajuan->status == 'Diajukan' || $pengajuan->status == 'Draft')
                    <form action="{{ route('pengajuan.destroy', $pengajuan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan ini? Data dan file akan dihapus permanen.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 font-bold py-2 px-4 rounded-lg border border-red-200 shadow-sm transition flex items-center gap-2 text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Batalkan & Hapus Pengajuan
                        </button>
                    </form>
                @endif
            </div>

            {{-- 1. INFORMASI UTAMA & STATUS --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-8 mb-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-gray-100 pb-6 mb-6 gap-4">
                    <div>
                        {{-- BADGE KATEGORI --}}
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wide mb-2 {{ $pengajuan->kategori == 'Fasilitasi' ? 'bg-blue-100 text-blue-800' : 'bg-indigo-100 text-indigo-800' }}">
                            {{ $pengajuan->kategori == 'Fasilitasi' ? 'Program Fasilitasi (Gratis)' : 'Jalur Mandiri (Rekomendasi)' }}
                        </span>

                        <h1 class="text-3xl font-extrabold text-gray-900">
                            {{ $pengajuan->kategori == 'Fasilitasi' ? 'Pengajuan Merek Ekraf' : $pengajuan->nama_merek }}
                        </h1>
                        <div class="flex items-center gap-3 mt-2">
                            <span class="text-sm text-gray-500">Diajukan pada: {{ $pengajuan->created_at->format('d F Y, H:i') }} WIB</span>
                        </div>
                    </div>
                    
                    {{-- Status Badge --}}
                    <div class="flex flex-col items-end">
                        <span class="text-xs text-gray-500 uppercase tracking-wide font-bold mb-1">Status Pengajuan</span>
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
                    </div>
                </div>

                {{-- ========================================================== --}}
                {{-- KONTEN KHUSUS BERDASARKAN KATEGORI --}}
                {{-- ========================================================== --}}

                @if($pengajuan->kategori == 'Fasilitasi')
                    
                    {{-- A. DATA DETAIL EKRAF (KHUSUS FASILITASI) --}}
                    <div class="bg-blue-50/50 rounded-xl p-6 border border-blue-100 mb-6">
                        <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Data Usaha Ekonomi Kreatif
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                            <div><span class="block text-xs font-bold text-blue-400 uppercase">Sub Sektor</span><span class="font-bold text-gray-900">{{ $pengajuan->subsektor_ekraf }}</span></div>
                            <div><span class="block text-xs font-bold text-blue-400 uppercase">Lokasi Usaha</span><span class="font-bold text-gray-900">{{ $pengajuan->lokasi_usaha }}</span></div>
                            <div><span class="block text-xs font-bold text-blue-400 uppercase">Produk Utama</span><span class="font-bold text-gray-900">{{ $pengajuan->hasil_produk }}</span></div>
                            <div><span class="block text-xs font-bold text-blue-400 uppercase">Tenaga Kerja</span><span class="font-bold text-gray-900">{{ $pengajuan->jumlah_tenaga_kerja }} Orang</span></div>
                            <div><span class="block text-xs font-bold text-blue-400 uppercase">Modal Usaha</span><span class="font-bold text-gray-900">{{ $pengajuan->modal_usaha }}</span></div>
                            <div><span class="block text-xs font-bold text-blue-400 uppercase">Omzet / Bulan</span><span class="font-bold text-gray-900">{{ $pengajuan->omzet_bulanan }}</span></div>
                            <div class="md:col-span-2"><span class="block text-xs font-bold text-blue-400 uppercase">Pemasaran</span><span class="font-bold text-gray-900">{{ $pengajuan->pemasaran_distribusi }}</span></div>
                        </div>

                        <div class="mt-6 p-4 bg-white rounded-lg border border-blue-200">
                            <h4 class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2">3 Usulan Nama Merek</h4>
                            <pre class="font-sans text-gray-800 whitespace-pre-line leading-relaxed text-sm font-medium">{{ $pengajuan->usulan_nama_merek }}</pre>
                        </div>
                    </div>

                @else
                    
                    {{-- B. DATA KARYA (KHUSUS MANDIRI) --}}
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm uppercase mb-2">Deskripsi / Sinopsis</h3>
                        <div class="bg-gray-50 p-4 rounded-lg text-gray-700 leading-relaxed border border-gray-200 text-sm">
                            {{ $pengajuan->deskripsi_karya }}
                        </div>
                    </div>

                @endif
            </div>

            {{-- 2. HASIL KELUARAN (SURAT REKOMENDASI - KHUSUS MANDIRI) --}}
            @if($pengajuan->status == 'Disetujui' && $pengajuan->file_surat_rekomendasi && $pengajuan->kategori == 'Mandiri')
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6 flex flex-col md:flex-row items-center justify-between gap-4 shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-green-900 text-lg">Selamat! Pengajuan Disetujui</h3>
                            <p class="text-green-700 text-sm">Surat rekomendasi Anda telah terbit. Silakan unduh untuk dibawa ke Kemenkumham.</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/'.$pengajuan->file_surat_rekomendasi) }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Download Surat Rekomendasi
                    </a>
                </div>
            @endif

            {{-- 3. JIKA DITOLAK (Feedback Admin) --}}
            @if($pengajuan->status == 'Ditolak')
                <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-6">
                    <h3 class="font-bold text-red-900 text-lg mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Alasan Penolakan / Catatan Perbaikan
                    </h3>
                    <p class="text-red-700 bg-white p-4 rounded border border-red-100">
                        {{ $pengajuan->catatan_admin ?? 'Tidak ada catatan dari admin.' }}
                    </p>
                </div>
            @endif

            {{-- 4. TIMELINE TRACKING (HANYA MUNCUL DI FASILITASI) --}}
            @if($pengajuan->kategori == 'Fasilitasi')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-8 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-8 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Tracking Progres
                    </h3>

                    @php
                        $step1 = true;
                        $step2 = in_array($pengajuan->tahapan_proses, ['Pendaftaran DJKI', 'Selesai']);
                        $step3 = $pengajuan->tahapan_proses == 'Selesai';
                    @endphp

                    <div class="w-full">
                        <div class="relative px-4">
                            
                            {{-- GARIS DIHAPUS SESUAI REQUEST --}}

                            <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start gap-8 sm:gap-0">
                                
                                {{-- Step 1 --}}
                                <div class="flex flex-row sm:flex-col items-center gap-4 sm:gap-4 group w-full sm:w-auto">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center border-2 
                                        {{ $step1 ? 'bg-blue-600 border-blue-600 text-white' : 'bg-white border-gray-300 text-gray-400' }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div class="text-left sm:text-center sm:w-40 pt-2 sm:pt-0">
                                        <p class="text-sm font-bold {{ $step1 ? 'text-blue-900' : 'text-gray-500' }}">Verifikasi Dinas</p>
                                        <p class="text-xs text-gray-500 mt-1">Pengecekan berkas internal</p>
                                    </div>
                                </div>

                                {{-- Step 2 --}}
                                <div class="flex flex-row sm:flex-col items-center gap-4 sm:gap-4 group w-full sm:w-auto">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center border-2 transition-colors duration-300
                                        {{ $step2 ? 'bg-blue-600 border-blue-600 text-white' : 'bg-white border-gray-300 text-gray-400' }}">
                                        @if($step2)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        @else
                                            <span class="font-bold text-sm">2</span>
                                        @endif
                                    </div>
                                    <div class="text-left sm:text-center sm:w-40 pt-2 sm:pt-0">
                                        <p class="text-sm font-bold {{ $step2 ? 'text-blue-900' : 'text-gray-500' }}">Proses DJKI</p>
                                        <p class="text-xs text-gray-500 mt-1">Input ke sistem Kemenkumham</p>
                                    </div>
                                </div>

                                {{-- Step 3 --}}
                                <div class="flex flex-row sm:flex-col items-center gap-4 sm:gap-4 group w-full sm:w-auto">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center border-2 transition-colors duration-300
                                        {{ $step3 ? 'bg-green-500 border-green-500 text-white' : 'bg-white border-gray-300 text-gray-400' }}">
                                        @if($step3)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        @else
                                            <span class="font-bold text-sm">3</span>
                                        @endif
                                    </div>
                                    <div class="text-left sm:text-center sm:w-40 pt-2 sm:pt-0">
                                        <p class="text-sm font-bold {{ $step3 ? 'text-green-700' : 'text-gray-500' }}">Sertifikat Terbit</p>
                                        <p class="text-xs text-gray-500 mt-1">Proses selesai sepenuhnya</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- 5. BERKAS YANG DIUPLOAD --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-8">
                <h3 class="font-bold text-gray-900 text-lg mb-6 flex items-center gap-2 border-b pb-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Berkas Persyaratan Anda
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    {{-- 1. KTP (SEMUA) --}}
                    <div class="border rounded-lg p-4 bg-gray-50">
                        <span class="block text-xs font-bold text-gray-500 uppercase mb-2">KTP Pemohon</span>
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2 bg-white rounded border"><svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg></div>
                            <span class="text-sm text-gray-700 truncate">File KTP</span>
                        </div>
                        <a href="{{ asset('storage/'.$pengajuan->file_ktp) }}" target="_blank" class="text-blue-600 text-xs font-bold hover:underline">Lihat Dokumen</a>
                    </div>

                    @if($pengajuan->kategori == 'Fasilitasi')
                        
                        {{-- BERKAS KHUSUS FASILITASI --}}
                        
                        {{-- 2. TANDA TANGAN --}}
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <span class="block text-xs font-bold text-gray-500 uppercase mb-2">Tanda Tangan</span>
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-white rounded border"><svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></div>
                                <span class="text-sm text-gray-700 truncate">Scan TTD</span>
                            </div>
                            <a href="{{ asset('storage/'.$pengajuan->file_ttd) }}" target="_blank" class="text-blue-600 text-xs font-bold hover:underline">Lihat File</a>
                        </div>

                        {{-- 3. FOTO PRODUK (WAJIB DI FASILITASI) --}}
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <span class="block text-xs font-bold text-gray-500 uppercase mb-2">Foto Produk</span>
                            @if($pengajuan->file_foto_produk)
                                <div class="h-32 bg-white border rounded flex items-center justify-center overflow-hidden mb-2 relative group">
                                    <img src="{{ asset('storage/'.$pengajuan->file_foto_produk) }}" class="h-full w-full object-cover transition transform group-hover:scale-110">
                                </div>
                                <a href="{{ asset('storage/'.$pengajuan->file_foto_produk) }}" target="_blank" class="text-blue-600 text-xs font-bold hover:underline block text-center">Lihat Foto Penuh</a>
                            @endif
                        </div>

                        {{-- 4. LOGO (OPSIONAL DI FASILITASI) --}}
                        @if($pengajuan->file_logo)
                            <div class="border rounded-lg p-4 bg-gray-50">
                                <span class="block text-xs font-bold text-gray-500 uppercase mb-2">Logo Merek</span>
                                <div class="h-32 bg-white border rounded flex items-center justify-center overflow-hidden mb-2">
                                    <img src="{{ asset('storage/'.$pengajuan->file_logo) }}" class="h-full w-full object-contain">
                                </div>
                                <a href="{{ asset('storage/'.$pengajuan->file_logo) }}" target="_blank" class="text-blue-600 text-xs font-bold hover:underline block text-center">Lihat File</a>
                            </div>
                        @endif

                    @else
                        
                        {{-- BERKAS KHUSUS MANDIRI / REKOMENDASI --}}

                        {{-- 2. SURAT PERMOHONAN --}}
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <span class="block text-xs font-bold text-gray-500 uppercase mb-2">Surat Permohonan</span>
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-white rounded border"><svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></div>
                                <span class="text-sm text-gray-700 truncate">File Surat</span>
                            </div>
                            <a href="{{ asset('storage/'.$pengajuan->file_surat_permohonan) }}" target="_blank" class="text-blue-600 text-xs font-bold hover:underline">Lihat Dokumen</a>
                        </div>

                        {{-- 3. NPWP --}}
                        @if($pengajuan->file_npwp)
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <span class="block text-xs font-bold text-gray-500 uppercase mb-2">NPWP</span>
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-white rounded border"><svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg></div>
                                <span class="text-sm text-gray-700 truncate">File NPWP</span>
                            </div>
                            <a href="{{ asset('storage/'.$pengajuan->file_npwp) }}" target="_blank" class="text-blue-600 text-xs font-bold hover:underline">Lihat Dokumen</a>
                        </div>
                        @endif

                        {{-- 4. CV --}}
                        @if($pengajuan->file_cv)
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <span class="block text-xs font-bold text-gray-500 uppercase mb-2">CV / Profil</span>
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-white rounded border"><svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></div>
                                <span class="text-sm text-gray-700 truncate">Profil Usaha</span>
                            </div>
                            <a href="{{ asset('storage/'.$pengajuan->file_cv) }}" target="_blank" class="text-blue-600 text-xs font-bold hover:underline">Lihat Dokumen</a>
                        </div>
                        @endif

                        {{-- 5. SURAT UMK --}}
                        @if($pengajuan->file_surat_umk)
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <span class="block text-xs font-bold text-gray-500 uppercase mb-2">Surat UMK</span>
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-white rounded border"><svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></div>
                                <span class="text-sm text-gray-700 truncate">Bermaterai</span>
                            </div>
                            <a href="{{ asset('storage/'.$pengajuan->file_surat_umk) }}" target="_blank" class="text-blue-600 text-xs font-bold hover:underline">Lihat Dokumen</a>
                        </div>
                        @endif

                        {{-- 6. VISUAL KARYA (Merek / Ciptaan) --}}
                        @if($pengajuan->jenis == 'Merek')
                            <div class="border rounded-lg p-4 bg-gray-50">
                                <span class="block text-xs font-bold text-gray-500 uppercase mb-2">Logo Merek</span>
                                <div class="h-32 bg-white border rounded flex items-center justify-center overflow-hidden mb-2">
                                    <img src="{{ asset('storage/'.$pengajuan->file_logo) }}" class="h-full w-full object-contain">
                                </div>
                                <a href="{{ asset('storage/'.$pengajuan->file_logo) }}" target="_blank" class="text-blue-600 text-xs font-bold hover:underline">Lihat File Asli</a>
                            </div>
                        @else
                            <div class="border rounded-lg p-4 bg-gray-50">
                                <span class="block text-xs font-bold text-gray-500 uppercase mb-2">Sampel Ciptaan</span>
                                <div class="h-32 bg-white border rounded flex items-center justify-center mb-2">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                                </div>
                                <a href="{{ asset('storage/'.$pengajuan->file_karya) }}" target="_blank" class="text-blue-600 text-xs font-bold hover:underline">Download Sampel</a>
                            </div>
                        @endif

                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>