<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight">
            {{ __('Buat Pengajuan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ 
        kategori: '{{ old('kategori', $kategori) }}', 
        jenis: '{{ old('jenis', ($kategori == 'Fasilitasi' ? 'Merek' : 'Merek')) }}' 
    }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Tombol Kembali --}}
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 font-medium mb-6 transition">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Batal & Kembali
            </a>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-8">
                    
                    {{-- =============================================== --}}
                    {{-- ALERT ERROR VALIDASI --}}
                    {{-- =============================================== --}}
                    @if ($errors->any())
                        <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg shadow-sm animate-pulse">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div>
                                    <h3 class="font-bold text-lg mb-1">Gagal Mengirim Pengajuan!</h3>
                                    <p class="text-sm font-semibold mb-2">Mohon periksa kesalahan berikut:</p>
                                    <ul class="list-disc list-inside text-sm space-y-1 ml-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Alert Info Kategori --}}
                    <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mb-8 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    Anda sedang mengajukan jalur: <strong class="uppercase" x-text="kategori"></strong>.
                                    <span x-show="kategori == 'Fasilitasi'">Biaya ditanggung penuh oleh Dinas.</span>
                                    <span x-show="kategori == 'Mandiri'">Anda akan mendapatkan Surat Rekomendasi Dinas.</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        {{-- Hidden Input Kategori (Dikirim ke Controller) --}}
                        <input type="hidden" name="kategori" x-model="kategori">

                        {{-- PILIHAN KATEGORI (Tab Switcher) --}}
                        <div class="flex justify-center mb-8">
                            <div class="bg-gray-100 p-1.5 rounded-xl inline-flex shadow-inner">
                                <button type="button" @click="kategori = 'Mandiri'" 
                                    :class="{'bg-white shadow-sm text-gray-900': kategori === 'Mandiri', 'text-gray-500 hover:text-gray-700': kategori !== 'Mandiri'}"
                                    class="px-6 py-2.5 rounded-lg text-sm font-bold transition flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Surat Rekomendasi
                                </button>
                                <button type="button" @click="kategori = 'Fasilitasi'; jenis = 'Merek'" 
                                    :class="{'bg-blue-600 shadow-sm text-white': kategori === 'Fasilitasi', 'text-gray-500 hover:text-gray-700': kategori !== 'Fasilitasi'}"
                                    class="px-6 py-2.5 rounded-lg text-sm font-bold transition flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                                    Fasilitasi
                                </button>
                            </div>
                        </div>

                        {{-- PILIHAN JENIS (Merek / Hak Cipta) - HANYA MANDIRI --}}
                        <div x-show="kategori === 'Mandiri'" class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Pengajuan</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="cursor-pointer border rounded-lg p-4 flex items-center gap-3 hover:bg-gray-50 transition" :class="{'border-blue-500 ring-1 ring-blue-500 bg-blue-50': jenis === 'Merek'}">
                                    <input type="radio" name="jenis" value="Merek" x-model="jenis" class="text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <span class="block font-bold text-gray-900">Merek Dagang</span>
                                        <span class="text-xs text-gray-500">Untuk Brand, Logo, Nama Usaha</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer border rounded-lg p-4 flex items-center gap-3 hover:bg-gray-50 transition" :class="{'border-blue-500 ring-1 ring-blue-500 bg-blue-50': jenis === 'Hak Cipta'}">
                                    <input type="radio" name="jenis" value="Hak Cipta" x-model="jenis" class="text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <span class="block font-bold text-gray-900">Hak Cipta</span>
                                        <span class="text-xs text-gray-500">Untuk Karya Seni, Buku, Lagu, dll</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- JIKA FASILITASI, OTOMATIS MEREK (HIDDEN INPUT) --}}
                        <div x-show="kategori === 'Fasilitasi'">
                            <input type="hidden" name="jenis" value="Merek">
                            <div class="p-4 bg-yellow-50 text-yellow-800 text-sm rounded-lg mb-6 border border-yellow-200 flex items-start gap-3">
                                <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span><strong>Catatan:</strong> Tahun ini program Fasilitasi Dinas hanya tersedia untuk <strong>Pendaftaran Merek</strong>.</span>
                            </div>
                        </div>

                        {{-- 1. DATA PEMOHON (READONLY) --}}
                        <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm group">
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-500"></div>
                            
                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 border-b border-gray-100 pb-4 gap-4">
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-900 flex items-center gap-2">
                                            <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            </span>
                                            1. Data Pemohon
                                        </h3>
                                        <p class="text-xs text-gray-500 mt-1 ml-10">Data diambil otomatis dari profil akun Anda.</p>
                                    </div>
                                    <a href="{{ route('profile.edit') }}" class="text-xs font-bold text-blue-600 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-full transition flex items-center gap-1 group-hover:shadow-sm">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        Ubah Data
                                    </a>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8 text-sm">
                                    <div class="flex items-start gap-3">
                                        <div class="mt-0.5 text-gray-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                                        <div><span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Nama Lengkap</span><span class="font-bold text-gray-900 text-base">{{ Auth::user()->name }}</span></div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div class="mt-0.5 text-gray-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg></div>
                                        <div><span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">NIK / No KTP</span><span class="font-bold text-gray-900 text-base font-mono">{{ Auth::user()->no_ktp ?? '-' }}</span></div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div class="mt-0.5 text-gray-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></div>
                                        <div><span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Email</span><span class="font-bold text-gray-900 text-base">{{ Auth::user()->email }}</span></div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div class="mt-0.5 text-gray-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg></div>
                                        <div><span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">No WhatsApp</span><span class="font-bold text-gray-900 text-base font-mono">{{ Auth::user()->no_hp ?? '-' }}</span></div>
                                    </div>
                                    <div class="md:col-span-2 flex items-start gap-3 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                        <div class="mt-0.5 text-gray-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></div>
                                        <div><span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Alamat Lengkap (Sesuai KTP)</span><span class="font-medium text-gray-800 leading-relaxed">{{ Auth::user()->alamat_ktp ?? '-' }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 2. DOKUMEN IDENTITAS (Upload KTP & TTD) --}}
                        <div class="border-t pt-8">
                            <h3 class="font-bold text-lg text-gray-900 mb-6 flex items-center gap-2">
                                <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                </span>
                                2. Dokumen Identitas
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Scan KTP Pemohon (Wajib)</label>
                                    <input type="file" name="file_ktp" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg cursor-pointer transition focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                
                                {{-- INPUT TANDA TANGAN (KHUSUS FASILITASI) --}}
                                <div x-show="kategori === 'Fasilitasi'">
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Scan/Foto Tanda Tangan (Wajib)</label>
                                    <input type="file" name="file_ttd" 
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg cursor-pointer transition focus:ring-blue-500 focus:border-blue-500" 
                                           accept=".jpg,.jpeg,.png"
                                           :required="kategori === 'Fasilitasi'">
                                    <p class="text-xs text-gray-500 mt-1">Tanda tangan di kertas putih, lalu foto/scan. Format JPG/PNG (Max 2MB).</p>
                                </div>

                                {{-- Surat Permohonan: Hanya Muncul Jika Mandiri --}}
                                <div x-show="kategori === 'Mandiri'">
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Surat Permohonan (Wajib)</label>
                                    <input type="file" name="file_surat_permohonan" 
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg cursor-pointer transition" 
                                           :required="kategori === 'Mandiri'">
                                    <p class="text-xs text-gray-500 mt-1">Sesuai format yang disediakan Dinas.</p>
                                </div>
                            </div>
                        </div>

                        {{-- 3. DOKUMEN TAMBAHAN (HANYA MANDIRI) --}}
                        <div x-show="kategori === 'Mandiri'" class="border-t pt-8 mt-6">
                            <h3 class="font-bold text-lg text-gray-900 mb-4">3. Dokumen Pendukung (Mandiri)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">NPWP</label>
                                    <input type="file" name="file_npwp" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 border border-gray-300 rounded cursor-pointer">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">CV / Profil Usaha</label>
                                    <input type="file" name="file_cv" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 border border-gray-300 rounded cursor-pointer">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pernyataan UMK</label>
                                    <input type="file" name="file_surat_umk" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 border border-gray-300 rounded cursor-pointer">
                                </div>
                            </div>
                        </div>

                        {{-- 4. DATA KHUSUS FASILITASI (8 FIELD BARU - MENGGUNAKAN HELPER OLD) --}}
                        <div x-show="kategori === 'Fasilitasi'" class="border-t pt-8 mt-6">
                            <div class="bg-blue-50/50 p-6 rounded-xl border border-blue-100">
                                <h3 class="font-bold text-lg text-blue-900 mb-6 flex items-center gap-2">
                                    <span class="w-8 h-8 rounded-full bg-blue-200 text-blue-800 flex items-center justify-center text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                    </span>
                                    3. Data Detail Ekonomi Kreatif
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    
                                    {{-- 1. Sub Sektor --}}
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Sub Sektor Ekraf</label>
                                        <select name="subsektor_ekraf" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Sub Sektor</option>
                                            @foreach(['Arsitektur', 'Desain Interior', 'Desain Komunikasi Visual', 'Desain Produk', 'Fashion', 'Film Animasi Video', 'Fotografi', 'Kriya/Kerajinan', 'Kuliner', 'Musik', 'Aplikasi', 'Pengembangan Permainan', 'Penerbitan', 'Periklanan', 'TV dan Radio', 'Seni Pertunjukan', 'Seni Rupa'] as $opt)
                                                <option value="{{ $opt }}" {{ old('subsektor_ekraf') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- 2. Lokasi Usaha --}}
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Lokasi Usaha</label>
                                        <select name="lokasi_usaha" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Kota/Kabupaten</option>
                                            @foreach(['Kota Tanjungpinang', 'Kota Batam', 'Kabupaten Bintan', 'Kabupaten Karimun', 'Kabupaten Kepulauan Anambas', 'Kabupaten Lingga', 'Kabupaten Natuna'] as $opt)
                                                <option value="{{ $opt }}" {{ old('lokasi_usaha') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- 3. Hasil Produk --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Hasil Produk Usaha</label>
                                        <input type="text" name="hasil_produk" value="{{ old('hasil_produk') }}" placeholder="Contoh: Batik, Bros Sisik Ikan, Kerupuk Atom" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    {{-- 4. Modal Usaha --}}
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Modal Usaha (Non Tanah/Bangunan)</label>
                                        <select name="modal_usaha" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="< 1 Miliar" {{ old('modal_usaha') == '< 1 Miliar' ? 'selected' : '' }}>< Rp. 1.000.000.000,-</option>
                                            <option value="1 Miliar - 5 Miliar" {{ old('modal_usaha') == '1 Miliar - 5 Miliar' ? 'selected' : '' }}>Rp. 1.000.000.000,- sd Rp. 5.000.000.000,-</option>
                                            <option value="> 5 Miliar" {{ old('modal_usaha') == '> 5 Miliar' ? 'selected' : '' }}>> Rp. 5.000.000.000,-</option>
                                        </select>
                                    </div>

                                    {{-- 5. Tenaga Kerja --}}
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Jumlah Tenaga Kerja (Orang)</label>
                                        <input type="number" name="jumlah_tenaga_kerja" value="{{ old('jumlah_tenaga_kerja') }}" min="1" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    {{-- 6. Pemasaran --}}
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Pemasaran & Distribusi</label>
                                        <select name="pemasaran_distribusi" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                            @foreach(['Dalam Provinsi Kepri' => 'Di dalam wilayah Provinsi Kepulauan Riau', 'Luar Provinsi Kepri' => 'Di luar wilayah Provinsi Kepulauan Riau', 'Dalam & Luar Kepri' => 'Di dalam dan di luar wilayah Kepulauan Riau', 'Ekspor' => 'Di dalam negeri dan luar negeri'] as $val => $label)
                                                <option value="{{ $val }}" {{ old('pemasaran_distribusi') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- 7. Omzet --}}
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Pendapatan Bersih (Omzet/Bulan)</label>
                                        <select name="omzet_bulanan" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="< 25 Juta" {{ old('omzet_bulanan') == '< 25 Juta' ? 'selected' : '' }}>< Rp. 25.000.000,- /bulan</option>
                                            <option value="25 Juta - 200 Juta" {{ old('omzet_bulanan') == '25 Juta - 200 Juta' ? 'selected' : '' }}>Rp. 25.000.000,- sd Rp. 200.000.000,- /bulan</option>
                                            <option value="> 200 Juta" {{ old('omzet_bulanan') == '> 200 Juta' ? 'selected' : '' }}>> Rp. 200.000.000,- /bulan</option>
                                        </select>
                                    </div>

                                    {{-- 8. Usulan Nama (Textarea) --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-bold text-gray-700 mb-1">3 Usulan Nama Usaha/Merek</label>
                                        <textarea name="usulan_nama_merek" rows="3" placeholder="1. Nama Pertama&#10;2. Nama Kedua&#10;3. Nama Ketiga" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('usulan_nama_merek') }}</textarea>
                                        <p class="text-xs text-gray-500 mt-1">Kami akan melakukan pengecekan ketersediaan nama di DJKI.</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- 5. INFORMASI KARYA / MEREK (KHUSUS MANDIRI) --}}
                        <div x-show="kategori === 'Mandiri'" class="border-t pt-8 mt-6">
                            <h3 class="font-bold text-lg text-gray-900 mb-4 flex items-center gap-2">
                                <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </span>
                                4. Detail Kekayaan Intelektual (Mandiri)
                            </h3>
                            
                            <div class="grid grid-cols-1 gap-6">
                                <div x-show="jenis === 'Merek'">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Merek / Brand</label>
                                    <input type="text" name="nama_merek" value="{{ old('nama_merek') }}" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div x-show="jenis === 'Hak Cipta'">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Ciptaan</label>
                                    <input type="text" name="nama_merek" value="{{ old('nama_merek') }}" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Buku Panduan Belajar">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat Karya/Usaha</label>
                                    <textarea name="deskripsi_karya" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi_karya') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- 6. UPLOAD FILE KARYA (LOGO / SAMPLE) --}}
                        <div class="border-t pt-8 mt-6">
                            <h3 class="font-bold text-lg text-gray-900 mb-4 flex items-center gap-2">
                                <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </span>
                                <span x-text="kategori === 'Fasilitasi' ? '4. File Visual & Produk' : '5. File Visual'"></span>
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- INPUT LOGO --}}
                                <div x-show="jenis === 'Merek'">
                                    <label class="block text-sm font-bold text-gray-700 mb-1">
                                        Upload Logo Merek
                                        <span x-show="kategori === 'Fasilitasi'" class="text-gray-400 font-normal text-xs ml-1">(Tidak Wajib)</span>
                                    </label>
                                    <input type="file" name="file_logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded cursor-pointer">
                                </div>

                                {{-- INPUT FOTO PRODUK (Diubah Labelnya untuk Fasilitasi) --}}
                                <div x-show="jenis === 'Merek'">
                                    <label class="block text-sm font-bold text-gray-700 mb-1">
                                        <span x-show="kategori === 'Fasilitasi'">Foto Produk Kemasan Siap Jual (Min. 3)</span>
                                        <span x-show="kategori === 'Mandiri'">Foto Produk / Tempat Usaha</span>
                                    </label>
                                    <input type="file" name="file_foto_produk" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded cursor-pointer" accept=".jpg,.jpeg,.png,.pdf">
                                    <p class="text-xs text-gray-500 mt-1">Gabungkan foto dalam 1 file PDF/JPG jika lebih dari satu.</p>
                                </div>

                                {{-- INPUT KARYA CIPTA (Hanya Mandiri) --}}
                                <div x-show="jenis === 'Hak Cipta'">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">File Contoh Ciptaan</label>
                                    <input type="file" name="file_karya" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded cursor-pointer">
                                    <p class="text-xs text-gray-500 mt-1">PDF/MP3/MP4 (Max 5MB)</p>
                                </div>
                            </div>
                        </div>

                        {{-- TOMBOL SUBMIT --}}
                        <div class="border-t pt-8 mt-6 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform transition hover:scale-105 flex items-center gap-2">
                                <span>Kirim Pengajuan</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>