<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight">
            {{ __('Verifikasi Pengajuan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Tombol Kembali --}}
            <div class="mb-8">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 font-medium transition group">
                    <div class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center mr-3 group-hover:border-blue-300 group-hover:text-blue-600 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </div>
                    <span class="text-sm">Kembali ke Dashboard</span>
                </a>
            </div>

            <div class="space-y-10">
                
                {{-- KARTU 1: HEADER & STATUS --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8 relative">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-500"></div>
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide mb-3 border {{ $pengajuan->kategori == 'Fasilitasi' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-indigo-50 text-indigo-700 border-indigo-200' }}">
                                {{ $pengajuan->kategori == 'Fasilitasi' ? 'Program Fasilitasi Dinas' : 'Permohonan Rekomendasi' }}
                            </span>
                            <h1 class="text-3xl font-extrabold text-gray-900 leading-tight">
                                {{ $pengajuan->kategori == 'Fasilitasi' ? 'Pengajuan Ekraf' : $pengajuan->nama_merek }}
                            </h1>
                            <p class="text-sm text-gray-500 mt-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Tanggal Masuk: <span class="font-medium text-gray-700">{{ $pengajuan->created_at->format('d F Y, H:i') }} WIB</span>
                            </p>
                        </div>
                        
                        {{-- Status Badge Besar --}}
                        <div class="flex flex-col items-end">
                            <span class="text-xs text-gray-400 uppercase tracking-wide font-bold mb-2">Status Saat Ini</span>
                            @php
                                $colors = [
                                    'Draft' => 'bg-gray-100 text-gray-800 border-gray-200',
                                    'Diajukan' => 'bg-blue-100 text-blue-800 border-blue-200',
                                    'Ditinjau' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                                    'Disetujui' => 'bg-green-100 text-green-800 border-green-200',
                                    'Ditolak' => 'bg-red-100 text-red-800 border-red-200',
                                ];
                                $colorClass = $colors[$pengajuan->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-6 py-2.5 rounded-xl text-base font-bold border {{ $colorClass }} shadow-sm">
                                {{ $pengajuan->status }}
                            </span>

                            @if($pengajuan->kategori == 'Fasilitasi')
                                <div class="mt-4 text-right bg-gray-50 px-4 py-2 rounded-lg border border-gray-100">
                                    <span class="text-[10px] text-gray-400 uppercase tracking-wide font-bold block mb-1">Posisi Tahapan</span>
                                    <div class="text-sm font-bold text-blue-600 flex items-center justify-end gap-1">
                                        {{ $pengajuan->tahapan_proses ?? 'Verifikasi Internal' }}
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- KARTU 2: DATA DIRI PEMOHON --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                    <div class="px-8 py-6 bg-gray-50/50 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-bold text-gray-900 flex items-center gap-3 text-lg">
                            <span class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-sm font-bold">1</span>
                            Data Diri Pemohon
                        </h3>
                    </div>
                    <div class="p-8">
                        {{-- GRID dengan GAP yang diperbaiki --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-10">
                            <div>
                                <span class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Nama Lengkap</span>
                                <span class="text-gray-900 font-medium text-base block">{{ $pengajuan->user->name }}</span>
                            </div>
                            <div>
                                <span class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">NIK / No KTP</span>
                                <span class="text-gray-900 font-medium text-base block">{{ $pengajuan->user->no_ktp ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Email</span>
                                <span class="text-gray-900 font-medium text-base block">{{ $pengajuan->user->email }}</span>
                            </div>
                            <div>
                                <span class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">No WhatsApp</span>
                                <span class="text-gray-900 font-medium text-base block">{{ $pengajuan->user->no_hp ?? '-' }}</span>
                            </div>
                            <div class="md:col-span-2">
                                <span class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Alamat Lengkap</span>
                                <span class="text-gray-900 font-medium text-base leading-relaxed block bg-gray-50 p-4 rounded-lg border border-gray-100">{{ $pengajuan->user->alamat_ktp ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KARTU 3: DATA PENGAJUAN (FASILITASI / MANDIRI) --}}
                @if($pengajuan->kategori == 'Fasilitasi')
                    
                    {{-- FASILITASI: DATA EKONOMI KREATIF --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-blue-100 ring-1 ring-blue-50/50">
                        <div class="px-8 py-6 bg-blue-50/30 border-b border-blue-50 flex items-center justify-between">
                            <h3 class="font-bold text-blue-900 flex items-center gap-3 text-lg">
                                <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm font-bold">2</span>
                                Detail Data Ekonomi Kreatif
                            </h3>
                        </div>
                        <div class="p-8">
                            {{-- GRID dengan GAP yang diperbaiki --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-10">
                                <div>
                                    <span class="block text-[11px] font-semibold text-blue-400 uppercase tracking-wider mb-1.5">Sub Sektor</span>
                                    <span class="text-gray-900 font-medium text-base block">{{ $pengajuan->subsektor_ekraf }}</span>
                                </div>
                                <div>
                                    <span class="block text-[11px] font-semibold text-blue-400 uppercase tracking-wider mb-1.5">Lokasi Usaha</span>
                                    <span class="text-gray-900 font-medium text-base block">{{ $pengajuan->lokasi_usaha }}</span>
                                </div>
                                <div>
                                    <span class="block text-[11px] font-semibold text-blue-400 uppercase tracking-wider mb-1.5">Produk Utama</span>
                                    <span class="text-gray-900 font-medium text-base block">{{ $pengajuan->hasil_produk }}</span>
                                </div>
                                <div>
                                    <span class="block text-[11px] font-semibold text-blue-400 uppercase tracking-wider mb-1.5">Tenaga Kerja</span>
                                    <span class="text-gray-900 font-medium text-base block">{{ $pengajuan->jumlah_tenaga_kerja }} Orang</span>
                                </div>
                                <div>
                                    <span class="block text-[11px] font-semibold text-blue-400 uppercase tracking-wider mb-1.5">Modal Usaha</span>
                                    <span class="text-gray-900 font-medium text-base block">{{ $pengajuan->modal_usaha }}</span>
                                </div>
                                <div>
                                    <span class="block text-[11px] font-semibold text-blue-400 uppercase tracking-wider mb-1.5">Omzet / Bulan</span>
                                    <span class="text-gray-900 font-medium text-base block">{{ $pengajuan->omzet_bulanan }}</span>
                                </div>
                                <div class="md:col-span-2">
                                    <span class="block text-[11px] font-semibold text-blue-400 uppercase tracking-wider mb-1.5">Pemasaran & Distribusi</span>
                                    <span class="text-gray-900 font-medium text-base leading-relaxed block">{{ $pengajuan->pemasaran_distribusi }}</span>
                                </div>
                            </div>

                            {{-- 3 USULAN NAMA MEREK (VERTIKAL LIST / MENURUN ke BAWAH) --}}
                            <div class="mt-8 pt-6 border-t border-gray-100">
                                <span class="block text-[11px] font-semibold text-blue-400 uppercase tracking-wider mb-3">3 Usulan Nama Merek</span>
                                @php
                                    // Split by newline, comma, atau numbering
                                    $merek_raw = $pengajuan->usulan_nama_merek;
                                    // Pisahkan berdasarkan enter atau koma
                                    $merek_list = preg_split('/[\n,]+/', $merek_raw);
                                    $merek_list = array_filter(array_map('trim', $merek_list));
                                    // Hilangkan numbering seperti "1.", "2.", dll
                                    $merek_list = array_map(function($item) {
                                        return preg_replace('/^\d+[\.\)]\s*/', '', $item);
                                    }, $merek_list);
                                @endphp
                                <div class="space-y-2">
                                    @foreach($merek_list as $index => $merek)
                                        <div class="flex items-center gap-3 bg-blue-50/50 px-4 py-2.5 rounded-lg border border-blue-100">
                                            <span class="flex-shrink-0 w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold">{{ $index + 1 }}</span>
                                            <span class="text-gray-900 font-medium text-base">{{ $merek }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-xs text-gray-400 mt-3 italic">*Nama-nama di atas akan dicek ketersediaannya di DJKI.</p>
                            </div>
                        </div>
                    </div>

                @else
                    
                    {{-- MANDIRI: DATA KARYA --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200">
                        <div class="px-8 py-6 bg-gray-50/50 border-b border-gray-100">
                            <h3 class="font-bold text-gray-900 text-lg">Deskripsi / Sinopsis Karya</h3>
                        </div>
                        <div class="p-8">
                            <div class="text-gray-800 leading-relaxed text-sm bg-gray-50 p-6 rounded-xl border border-gray-100">
                                {{ $pengajuan->deskripsi_karya }}
                            </div>
                        </div>
                    </div>

                @endif

                {{-- KARTU 4: VERIFIKASI BERKAS --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200">
                    <div class="px-8 py-6 bg-gray-50/50 border-b border-gray-100">
                        <h3 class="font-bold text-gray-900 flex items-center gap-3 text-lg">
                            <span class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-sm font-bold">3</span>
                            Verifikasi Kelengkapan Berkas
                        </h3>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            
                            {{-- 1. KTP (Semua) --}}
                            <div class="border rounded-xl p-5 hover:bg-gray-50 transition flex flex-col justify-between group h-full">
                                <div class="mb-4">
                                    <span class="block text-xs font-bold text-gray-400 uppercase mb-1">Dokumen Wajib</span>
                                    <span class="font-bold text-gray-900">KTP Pemohon</span>
                                </div>
                                <a href="{{ asset('storage/'.$pengajuan->file_ktp) }}" target="_blank" class="text-center w-full block bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-700 text-xs font-bold py-2 rounded-lg transition">
                                    Lihat File
                                </a>
                            </div>

                            @if($pengajuan->kategori == 'Fasilitasi')
                                {{-- KHUSUS FASILITASI --}}
                                @if($pengajuan->file_ttd)
                                <div class="border rounded-xl p-5 hover:bg-gray-50 transition flex flex-col justify-between group h-full">
                                    <div class="mb-4">
                                        <span class="block text-xs font-bold text-gray-400 uppercase mb-1">Tanda Tangan</span>
                                        <span class="font-bold text-gray-900">Scan TTD</span>
                                    </div>
                                    <a href="{{ asset('storage/'.$pengajuan->file_ttd) }}" target="_blank" class="text-center w-full block bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-700 text-xs font-bold py-2 rounded-lg transition">Lihat File</a>
                                </div>
                                @endif

                                @if($pengajuan->file_foto_produk)
                                <div class="border rounded-xl p-5 hover:bg-gray-50 transition flex flex-col justify-between group h-full">
                                    <div class="mb-4">
                                        <span class="block text-xs font-bold text-gray-400 uppercase mb-1">Visual</span>
                                        <span class="font-bold text-gray-900">Foto Produk</span>
                                    </div>
                                    <a href="{{ asset('storage/'.$pengajuan->file_foto_produk) }}" target="_blank" class="text-center w-full block bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-700 text-xs font-bold py-2 rounded-lg transition">Lihat File</a>
                                </div>
                                @endif

                                @if($pengajuan->file_logo)
                                <div class="border rounded-xl p-5 hover:bg-gray-50 transition flex flex-col justify-between group h-full">
                                    <div class="mb-4">
                                        <span class="block text-xs font-bold text-gray-400 uppercase mb-1">Visual</span>
                                        <span class="font-bold text-gray-900">Logo Merek</span>
                                    </div>
                                    <a href="{{ asset('storage/'.$pengajuan->file_logo) }}" target="_blank" class="text-center w-full block bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-700 text-xs font-bold py-2 rounded-lg transition">Lihat File</a>
                                </div>
                                @endif

                            @else
                                {{-- KHUSUS MANDIRI --}}
                                <div class="border rounded-xl p-5 hover:bg-gray-50 transition flex flex-col justify-between group h-full">
                                    <div class="mb-4">
                                        <span class="block text-xs font-bold text-gray-600 uppercase mb-1">Dokumen Wajib</span>
                                        <span class="font-bold text-gray-900">Surat Permohonan</span>
                                    </div>
                                    <a href="{{ asset('storage/'.$pengajuan->file_surat_permohonan) }}" target="_blank" class="text-center w-full block bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-700 text-xs font-bold py-2 rounded-lg transition">Lihat File</a>
                                </div>

                                @if($pengajuan->file_npwp)
                                <div class="border rounded-xl p-5 hover:bg-gray-50 transition flex flex-col justify-between group h-full">
                                    <div class="mb-4">
                                        <span class="block text-xs font-bold text-gray-600 uppercase mb-1">Legalitas</span>
                                        <span class="font-bold text-gray-900">NPWP</span>
                                    </div>
                                    <a href="{{ asset('storage/'.$pengajuan->file_npwp) }}" target="_blank" class="text-center w-full block bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-700 text-xs font-bold py-2 rounded-lg transition">Lihat File</a>
                                </div>
                                @endif

                                @if($pengajuan->file_cv)
                                <div class="border rounded-xl p-5 hover:bg-gray-50 transition flex flex-col justify-between group h-full">
                                    <div class="mb-4">
                                        <span class="block text-xs font-bold text-gray-600 uppercase mb-1">Legalitas</span>
                                        <span class="font-bold text-gray-900">CV / Profil</span>
                                    </div>
                                    <a href="{{ asset('storage/'.$pengajuan->file_cv) }}" target="_blank" class="text-center w-full block bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-700 text-xs font-bold py-2 rounded-lg transition">Lihat File</a>
                                </div>
                                @endif

                                @if($pengajuan->file_surat_umk)
                                <div class="border rounded-xl p-5 hover:bg-gray-50 transition flex flex-col justify-between group h-full">
                                    <div class="mb-4">
                                        <span class="block text-xs font-bold text-gray-600 uppercase mb-1">Legalitas</span>
                                        <span class="font-bold text-gray-900">Surat UMK</span>
                                    </div>
                                    <a href="{{ asset('storage/'.$pengajuan->file_surat_umk) }}" target="_blank" class="text-center w-full block bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-700 text-xs font-bold py-2 rounded-lg transition">Lihat File</a>
                                </div>
                                @endif

                                @if($pengajuan->jenis == 'Merek')
                                    <div class="border rounded-xl p-5 hover:bg-gray-50 transition flex flex-col justify-between group h-full">
                                        <div class="mb-4">
                                            <span class="block text-xs font-bold text-gray-600 uppercase mb-1">Visual</span>
                                            <span class="font-bold text-gray-900">Logo Merek</span>
                                        </div>
                                        <a href="{{ asset('storage/'.$pengajuan->file_logo) }}" target="_blank" class="text-center w-full block bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-700 text-xs font-bold py-2 rounded-lg transition">Lihat File</a>
                                    </div>
                                    <div class="border rounded-xl p-5 hover:bg-gray-50 transition flex flex-col justify-between group h-full">
                                        <div class="mb-4">
                                            <span class="block text-xs font-bold text-gray-600 uppercase mb-1">Visual</span>
                                            <span class="font-bold text-gray-900">Foto Usaha</span>
                                        </div>
                                        <a href="{{ asset('storage/'.$pengajuan->file_foto_produk) }}" target="_blank" class="text-center w-full block bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-700 text-xs font-bold py-2 rounded-lg transition">Lihat File</a>
                                    </div>
                                @else
                                    <div class="border rounded-xl p-5 hover:bg-gray-50 transition flex flex-col justify-between group h-full">
                                        <div class="mb-4">
                                            <span class="block text-xs font-bold text-gray-600 uppercase mb-1">Visual</span>
                                            <span class="font-bold text-gray-900">File Ciptaan</span>
                                        </div>
                                        <a href="{{ asset('storage/'.$pengajuan->file_karya) }}" target="_blank" class="text-center w-full block bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-700 text-xs font-bold py-2 rounded-lg transition">Lihat File</a>
                                    </div>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>

                {{-- KARTU 5: PANEL VERIFIKASI ADMIN (LIGHT MODE & CLEAN) --}}
                <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-lg mt-8 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-gray-800"></div>
                    <h4 class="text-xl font-bold mb-8 flex items-center gap-3 text-gray-900">
                        <span class="w-8 h-8 bg-gray-900 text-white rounded-full flex items-center justify-center text-sm">🛠</span>
                        Panel Verifikasi Dinas
                    </h4>
                    
                    <form action="{{ route('admin.updateStatus', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        {{-- LOGIKA TRACKING FASILITASI (LIGHT MODE) --}}
                        @if($pengajuan->kategori == 'Fasilitasi')
                            <div class="mb-8 bg-blue-50 border border-blue-100 rounded-xl p-6">
                                <h5 class="font-bold text-blue-800 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    Update Tracking Fasilitasi
                                </h5>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Posisi Tahapan Saat Ini</label>
                                        <select name="tahapan_proses" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="Verifikasi Internal" {{ ($pengajuan->tahapan_proses ?? 'Verifikasi Internal') == 'Verifikasi Internal' ? 'selected' : '' }}>1. Verifikasi Internal</option>
                                            <option value="Pendaftaran DJKI" {{ ($pengajuan->tahapan_proses) == 'Pendaftaran DJKI' ? 'selected' : '' }}>2. Proses DJKI</option>
                                            <option value="Selesai" {{ ($pengajuan->tahapan_proses) == 'Selesai' ? 'selected' : '' }}>3. Selesai (Sertifikat)</option>
                                        </select>
                                    </div>
                                    <div class="flex items-end">
                                        @if($pengajuan->status == 'Disetujui')
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg transition shadow-md w-full md:w-auto">Simpan Tahapan</button>
                                        @else
                                            <div class="text-xs text-gray-500 bg-white p-3 rounded border border-gray-200 w-full flex items-center gap-2">
                                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                Setujui pengajuan terlebih dahulu.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- TOMBOL APPROVAL (JIKA BELUM FINAL) --}}
                        @if($pengajuan->status != 'Disetujui')
                            <div class="mb-8">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Catatan Admin (Opsional)</label>
                                <textarea name="catatan_admin" rows="3" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Berikan catatan perbaikan jika ada...">{{ $pengajuan->catatan_admin }}</textarea>
                            </div>
                            
                            {{-- Upload Surat Rekomendasi (Hanya Mandiri) --}}
                            @if($pengajuan->kategori == 'Mandiri')
                                <div class="mb-8 bg-gray-50 p-6 rounded-xl border border-gray-200">
                                    <label class="block text-sm font-bold text-gray-900 mb-2">Upload Surat Rekomendasi (PDF)</label>
                                    <input type="file" name="file_surat_rekomendasi" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-800 file:text-white hover:file:bg-gray-700 cursor-pointer">
                                    <p class="text-xs text-gray-500 mt-2">*Wajib diupload jika menyetujui pengajuan mandiri.</p>
                                </div>
                            @endif

                            <div class="flex gap-4 pt-2">
                                <button type="submit" name="status" value="Disetujui" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl shadow-lg transition flex justify-center items-center gap-2 hover:-translate-y-0.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Setujui Pengajuan
                                </button>
                                <button type="submit" name="status" value="Ditolak" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-xl shadow-lg transition flex justify-center items-center gap-2 hover:-translate-y-0.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Tolak
                                </button>
                            </div>
                        @else
                            <div class="text-center p-8 bg-green-50 rounded-xl border border-green-200">
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 text-green-600">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-green-800 mb-2">Pengajuan Telah Disetujui</h3>
                                <p class="text-green-600 mb-6">Proses verifikasi telah selesai dilakukan.</p>
                                
                                @if($pengajuan->kategori == 'Mandiri' && $pengajuan->file_surat_rekomendasi)
                                    <a href="{{ asset('storage/'.$pengajuan->file_surat_rekomendasi) }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-white text-green-700 rounded-lg font-bold hover:bg-green-50 transition shadow-sm border border-green-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        Download Surat Rekomendasi
                                    </a>
                                @endif
                            </div>
                        @endif
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>