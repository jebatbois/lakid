<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LAKID - Dinas Pariwisata Kepri</title>
    <link rel="icon" href="{{ asset('img/logo-kepri.png') }}" type="image/png">
    
    {{-- Font Modern: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
        [x-cloak] { display: none !important; }
    </style>
</head>

{{-- Inisialisasi State AlpineJS di Body --}}
<body class="antialiased bg-gray-50 text-gray-800" 
      x-data="{ showModalMerek: false, showModalCipta: false, showModalFile: false, showModalInfoCipta: false }">

    {{-- NAVBAR (Sticky & Glass Effect) --}}
    <nav class="glass-nav border-b border-white/40 sticky top-0 z-40 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                {{-- Logo Area --}}
                <div class="flex items-center gap-3 group cursor-pointer" onclick="window.scrollTo(0,0)">
                    <img src="{{ asset('img/logo-kepri.png') }}" alt="Logo Kepri" class="w-10 h-auto group-hover:scale-110 transition duration-300">
                    <div class="flex flex-col">
                        <span class="font-extrabold text-2xl text-gray-900 tracking-tight leading-none">LAKID<span class="text-blue-600">.</span></span>
                        <span class="text-[10px] text-gray-500 font-bold tracking-widest uppercase mt-0.5">Dinas Pariwisata Kepri</span>
                    </div>
                </div>

                {{-- Menu Kanan --}}
                <div class="flex flex-wrap items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-bold text-gray-700 hover:text-blue-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-blue-600 transition mr-2">Masuk</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm sm:px-6 sm:py-3 px-3 py-2 flex-shrink-0 bg-blue-600 text-white rounded-full font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-600/30 transform hover:-translate-y-0.5">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

     {{-- HERO SECTION (Photo Background Kepri) --}}
    <section class="relative pt-24 pb-32 lg:pt-40 lg:pb-56 overflow-hidden">
        
        {{-- 1. BACKGROUND IMAGE --}}
        <div class="absolute inset-0 -z-20">
            <img src="{{ asset('img/hero.jpg') }}" 
                 alt="Keindahan Kepulauan Riau" 
                 class="w-full h-full object-cover scale-105 animate-slow-zoom">
        </div>

        {{-- 2. OVERLAY GRADIENT --}}
        <div class="absolute inset-0 bg-gradient-to-b from-blue-950/90 via-blue-900/60 to-gray-50 -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            
            {{-- Badge --}}
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-900/50 text-blue-100 text-sm font-bold mb-8 border border-blue-400/30 backdrop-blur-md shadow-sm">
                <span class="flex h-2 w-2 rounded-full bg-blue-400 mr-2 animate-pulse"></span>
                Layanan HKI Resmi Pemerintah
            </div>

            {{-- Headline --}}
            <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-6 leading-tight drop-shadow-lg">
                Lindungi Karya, <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-cyan-200">Tingkatkan Nilai Ekonomi.</span>
            </h1>

            {{-- Subheadline (Copywriting Baru) --}}
            <p class="mt-4 max-w-2xl mx-auto text-xl text-blue-100 mb-10 leading-relaxed font-medium drop-shadow">
                Platform resmi Dinas Pariwisata Provinsi Kepulauan Riau.
                {{-- Span ini akan jadi baris baru HANYA di layar Desktop (md ke atas) --}}
                <span class="md:block mt-1">
                    Akses program <strong>Fasilitasi Pendaftaran HKI</strong> atau ajukan <strong>Surat Rekomendasi</strong> untuk keringanan biaya secara mandiri.
                </span>
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                {{-- Tombol Utama --}}
                <a href="{{ route('register') }}" class="px-8 py-4 text-lg font-bold rounded-full text-blue-900 bg-white shadow-md hover:shadow-xl transition transform hover:-translate-y-0.5">
                    Mulai Mendaftar
                </a>
                {{-- Tombol Kedua (Butuh Bantuan?) --}}
                <a href="#bantuan" class="px-6 py-3 text-lg font-bold rounded-full text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition">Butuh Bantuan?</a>
            </div>

        </div>
    </section>

    {{-- STATISTIK SECTION (FLAT & CLEAN) --}}
    {{-- Added mt-12 to add distinct separation --}}
    <section id="statistik" class="bg-white py-20 border-b border-gray-100 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Dampak Nyata Program</h2>
                <p class="text-lg text-gray-500 mt-3 max-w-2xl mx-auto">Membangun ekosistem ekonomi kreatif yang terlindungi dan berdaya saing di Kepulauan Riau.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                
                {{-- Stat 1: Total --}}
                <div class="group p-6 rounded-2xl hover:bg-blue-50 transition duration-300">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 text-blue-600 mb-6 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div class="text-5xl md:text-6xl font-black text-gray-900 mb-2 tracking-tight">
                        {{ $totalFasilitasi ?? '0' }}<span class="text-blue-600 text-4xl align-top">+</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Total Terfasilitasi</h3>
                    <p class="text-sm text-gray-500 font-medium mt-1">Pelaku Ekraf Sejak 2024</p>
                </div>

                {{-- Stat 2: Merek --}}
                <div class="group p-6 rounded-2xl hover:bg-orange-50 transition duration-300">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-orange-100 text-orange-600 mb-6 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    </div>
                    <div class="text-5xl md:text-6xl font-black text-gray-900 mb-2 tracking-tight">
                        {{ $totalMerek ?? '0' }}
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Merek Dagang</h3>
                    <p class="text-sm text-gray-500 font-medium mt-1">UMKM Terlindungi</p>
                </div>

                {{-- Stat 3: Hak Cipta --}}
                <div class="group p-6 rounded-2xl hover:bg-purple-50 transition duration-300">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-purple-100 text-purple-600 mb-6 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div class="text-5xl md:text-6xl font-black text-gray-900 mb-2 tracking-tight">
                        {{ $totalHakCipta ?? '0' }}
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Hak Cipta</h3>
                    <p class="text-sm text-gray-500 font-medium mt-1">Karya Tercatat Resmi</p>
                </div>

            </div>
        </div>
    </section>

    {{-- SECTION LAYANAN & BANTUAN (GREY BACKGROUND) --}}
    {{-- HELP / GUIDE SECTION (visible via #bantuan) --}}
    <section id="bantuan" class="py-24 bg-white relative border-b border-gray-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-6">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2">Panduan Singkat Penggunaan</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Ikuti langkah singkat berikut untuk mendaftarkan akun, memilih layanan, dan mengajukan permohonan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200 shadow-sm">
                    <h3 class="font-bold text-lg text-gray-900 mb-3">1. Registrasi & Profil</h3>
                    <p class="text-sm text-gray-600 mb-2">Daftar akun, verifikasi email, lalu lengkapi biodata (NIK, WA, alamat).</p>
                    <p class="text-xs text-yellow-800 bg-yellow-50 p-2 rounded">Biodata harus lengkap untuk mengajukan permohonan.</p>
                </div>

                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200 shadow-sm">
                    <h3 class="font-bold text-lg text-gray-900 mb-3">2. Pilih Layanan</h3>
                    <p class="text-sm text-gray-600 mb-2">Di Dashboard pilih antara <strong>Fasilitasi</strong> (khusus merek) atau <strong>Jalur Mandiri</strong> (Surat Rekomendasi untuk keringanan PNBP).</p>
                </div>

                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200 shadow-sm">
                    <h3 class="font-bold text-lg text-gray-900 mb-3">3. Isi Formulir & Upload</h3>
                    <p class="text-sm text-gray-600 mb-2">Unggah KTP, tanda tangan, file karya/logo, dan dokumen pendukung sesuai jenis layanan.</p>
                </div>

                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200 shadow-sm">
                    <h3 class="font-bold text-lg text-gray-900 mb-3">4. Pantau Status</h3>
                    <p class="text-sm text-gray-600 mb-2">Cek status pengajuan di Dashboard. Jika butuh bantuan, hubungi admin via Dashboard kontak.</p>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="#layanan" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-full font-bold hover:bg-blue-700 transition shadow">Lihat Layanan & Dokumen</a>
            </div>
        </div>
    </section>

    <section id="layanan" class="py-24 bg-gray-50 relative border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Pusat Informasi & Layanan</h2>
                <p class="text-lg text-gray-500 max-w-2xl mx-auto">Kami menyediakan panduan lengkap dan template dokumen untuk mempermudah proses pendaftaran HKI Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- KOLOM 1: LAYANAN MEREK (BIRU) --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col">
                    <div class="p-6 border-t-4 border-blue-500 flex-grow flex flex-col">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-2xl">®</div>
                            <h3 class="text-xl font-bold text-gray-900">Layanan Merek</h3>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Panduan untuk melindungi identitas usaha seperti Nama Brand, Logo, dan Simbol Dagang.</p>
                        
                        <ul class="space-y-3 mb-6">
                            <li>
                                <button @click="showModalMerek = true" class="flex items-center text-gray-600 hover:text-blue-600 transition group text-sm w-full text-left outline-none focus:outline-none font-medium p-2 hover:bg-blue-50 rounded-lg">
                                    <span class="w-8 h-8 rounded-full bg-gray-100 group-hover:bg-blue-100 flex items-center justify-center mr-3 text-xs">📄</span>
                                    Alur & Syarat Pendaftaran
                                </button>
                            </li>
                            <li>
                                <a href="https://pdki-indonesia.dgip.go.id" target="_blank" class="flex items-center text-gray-600 hover:text-blue-600 transition group text-sm font-medium p-2 hover:bg-blue-50 rounded-lg">
                                    <span class="w-8 h-8 rounded-full bg-gray-100 group-hover:bg-blue-100 flex items-center justify-center mr-3 text-xs">🔍</span>
                                    Cek Ketersediaan Merek
                                </a>
                            </li>
                            <li>
                                <a href="https://skm.dgip.go.id/" target="_blank" class="flex items-center text-gray-600 hover:text-blue-600 transition group text-sm font-medium p-2 hover:bg-blue-50 rounded-lg">
                                    <span class="w-8 h-8 rounded-full bg-gray-100 group-hover:bg-blue-100 flex items-center justify-center mr-3 text-xs">🏷️</span>
                                    Cek Kelas Merek (Klasifikasi)
                                </a>
                            </li>
                        </ul>

                        <div class="mt-auto pt-4 border-t border-gray-100"></div>
                    </div>
                </div>

                {{-- KOLOM 2: LAYANAN HAK CIPTA (KUNING) --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col">
                    <div class="p-6 border-t-4 border-yellow-500 flex-grow flex flex-col">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center font-bold text-2xl">©</div>
                            <h3 class="text-xl font-bold text-gray-900">Layanan Hak Cipta</h3>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Perlindungan untuk karya seni, sastra, musik, film, foto, dan program komputer.</p>
                        
                        <ul class="space-y-3 mb-6">
                            <li>
                                <button @click="showModalInfoCipta = true" class="flex items-center text-gray-600 hover:text-yellow-600 transition group text-sm w-full text-left outline-none focus:outline-none font-medium p-2 hover:bg-yellow-50 rounded-lg">
                                    <span class="w-8 h-8 rounded-full bg-gray-100 group-hover:bg-yellow-100 flex items-center justify-center mr-3 text-xs">ℹ️</span>
                                    Apa itu Hak Cipta?
                                </button>
                            </li>
                            <li>
                                <button @click="showModalCipta = true" class="flex items-center text-gray-600 hover:text-yellow-600 transition group text-sm w-full text-left outline-none focus:outline-none font-medium p-2 hover:bg-yellow-50 rounded-lg">
                                    <span class="w-8 h-8 rounded-full bg-gray-100 group-hover:bg-yellow-100 flex items-center justify-center mr-3 text-xs">📄</span>
                                    Syarat Pencatatan
                                </button>
                            </li>
                            <li>
                                <button @click="showModalFile = true" class="flex items-center text-gray-600 hover:text-yellow-600 transition group text-sm w-full text-left outline-none focus:outline-none font-medium p-2 hover:bg-yellow-50 rounded-lg">
                                    <span class="w-8 h-8 rounded-full bg-gray-100 group-hover:bg-yellow-100 flex items-center justify-center mr-3 text-xs">📂</span>
                                    Format File Karya
                                </button>
                            </li>
                        </ul>

                        <div class="mt-auto pt-4 border-t border-gray-100"></div>
                    </div>
                </div>

                {{-- KOLOM 3: DOKUMEN & WA (HIJAU) --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col">
                    <div class="p-6 border-t-4 border-green-500 flex-grow flex flex-col">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold text-2xl">⬇️</div>
                            <h3 class="text-xl font-bold text-gray-900">Dokumen & Bantuan</h3>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Unduh template surat wajib dan hubungi kami jika mengalami kendala.</p>
                        
                        <ul class="space-y-3 mb-6">
                            {{-- Link UMK --}}
                            <li>
                                <a href="https://docs.google.com/document/d/1kexSPXukQdSxaWx_6bVUvyxw8c9h3srR/edit" target="_blank" class="flex items-center text-gray-600 hover:text-green-600 transition group text-sm font-medium p-2 hover:bg-green-50 rounded-lg">
                                    <span class="w-8 h-8 rounded-full bg-gray-100 group-hover:bg-green-100 flex items-center justify-center mr-3 text-xs">📥</span>
                                    Template Surat UMK
                                </a>
                            </li>
                            {{-- Link Hak Cipta --}}
                            <li>
                                <a href="https://docs.google.com/document/d/1KW8QYdNyRw1t1EhZ5XBwRT_GfyO6BTOf/edit" target="_blank" class="flex items-center text-gray-600 hover:text-green-600 transition group text-sm font-medium p-2 hover:bg-green-50 rounded-lg">
                                    <span class="w-8 h-8 rounded-full bg-gray-100 group-hover:bg-green-100 flex items-center justify-center mr-3 text-xs">📥</span>
                                    Template Surat Hak Cipta
                                </a>
                            </li>
                            {{-- Link Rekomendasi --}}
                            <li>
                                <a href="https://docs.google.com/document/d/1IsENGH7Fwhz6c9IF72Wckozs3E_osLeKMgZSgvJE1jA/edit" target="_blank" class="flex items-center text-gray-600 hover:text-green-600 transition group text-sm font-medium p-2 hover:bg-green-50 rounded-lg">
                                    <span class="w-8 h-8 rounded-full bg-gray-100 group-hover:bg-green-100 flex items-center justify-center mr-3 text-xs">📥</span>
                                    Surat Permohonan Rekom
                                </a>
                            </li>
                        </ul>

                        {{-- TOMBOL WA (Sticky Bottom di dalam card) --}}
                        <div class="mt-auto pt-4 border-t border-gray-100">
                            <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center justify-center w-full px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition font-bold shadow-md hover:shadow-lg group">
                                <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                Konsultasi via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- FOOTER (Clean & Simple) --}}
    <footer class="bg-gray-900 text-white py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center items-center gap-3 mb-6">
                <img src="{{ asset('img/logo-kepri.png') }}" alt="Logo" class="w-10 h-auto grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition">
                <span class="text-2xl font-bold tracking-tight">LAKID.</span>
            </div>
            <p class="text-gray-500 text-sm mb-8 max-w-md mx-auto">
                Layanan Fasilitasi Kekayaan Intelektual Digital.<br>
                Dinas Pariwisata Provinsi Kepulauan Riau.
            </p>
            <div class="flex justify-center gap-6 text-sm font-medium text-gray-400">
                <a href="{{ route('privacy') }}" class="hover:text-white transition">Kebijakan Privasi</a>
                <a href="{{ route('terms') }}" class="hover:text-white transition">Syarat & Ketentuan</a>
                <a href="https://wa.me/6281234567890" target="_blank" class="hover:text-white transition">Hubungi Kami</a>
            </div>
            <p class="mt-8 text-xs text-gray-600">&copy; {{ date('Y') }} Pemerintah Prov. Kepri. All rights reserved.</p>
        </div>
    </footer>

    {{-- AREA MODAL --}}
    
    {{-- 1. MODAL INFO CIPTA --}}
    <div x-show="showModalInfoCipta" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" @click="showModalInfoCipta = false"></div>
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border-t-8 border-yellow-500">
                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b">
                    <h3 class="text-xl font-extrabold leading-6 text-gray-900">Apa Itu Hak Cipta?</h3>
                    <button @click="showModalInfoCipta = false" class="text-gray-400 hover:text-red-500 focus:outline-none"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
                <div class="px-6 py-6 space-y-4">
                    <div class="bg-yellow-50 p-4 rounded-lg text-sm text-gray-800 border-l-4 border-yellow-400"><strong>Definisi:</strong> Hak eksklusif pencipta yang timbul secara otomatis setelah karya diwujudkan dalam bentuk nyata dan dipublikasikan.</div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border p-4 rounded-lg hover:bg-gray-50"><h4 class="font-bold text-gray-900 mb-1">✨ Hak Moral</h4><p class="text-xs text-gray-600">Hak untuk dicantumkan namanya & melarang perubahan karya.</p></div>
                        <div class="border p-4 rounded-lg hover:bg-gray-50"><h4 class="font-bold text-gray-900 mb-1">💰 Hak Ekonomi</h4><p class="text-xs text-gray-600">Hak mendapatkan royalti atau manfaat ekonomi dari penggunaan karya.</p></div>
                    </div>
                    <h4 class="font-bold text-gray-900 mt-4 border-b pb-2">Masa Berlaku Pelindungan</h4>
                    <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1"><li><strong>Seumur Hidup + 70 Tahun:</strong> Buku, Lagu, Lukisan, Tari, Drama.</li><li><strong>50 Tahun sejak Publikasi:</strong> Fotografi, Program Komputer, Sinematografi.</li></ul>
                    <h4 class="font-bold text-gray-900 mt-4 border-b pb-1">Biaya PNBP (Online)</h4><ul class="list-disc pl-5 text-sm text-gray-700 space-y-1"><li><strong>UMK / Litbang:</strong> Rp 200.000 / permohonan.</li><li><strong>Umum:</strong> Rp 400.000 / permohonan.</li></ul>
                </div>
                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse gap-2">
                    <button @click="showModalInfoCipta = false" class="inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-100 sm:mt-0 sm:w-auto">Tutup</button>
                    <a href="https://drive.google.com/file/d/13tB17EpZVLirdLm9aZJ-WHQeSfliyiiO/view" target="_blank" class="inline-flex w-full justify-center rounded-lg bg-yellow-600 px-4 py-2 text-sm font-bold text-white shadow-sm hover:bg-yellow-700 sm:mt-0 sm:w-auto flex items-center gap-2">Download Modul (PDF)</a>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. MODAL MEREK --}}
    <div x-show="showModalMerek" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" @click="showModalMerek = false"></div>
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border-t-8 border-blue-600">
                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b">
                    <h3 class="text-xl font-extrabold leading-6 text-gray-900">Alur & Syarat Pendaftaran Merek</h3>
                    <button @click="showModalMerek = false" class="text-gray-400 hover:text-red-500 focus:outline-none"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
                <div class="px-6 py-6 space-y-6">
                    <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">1</div></div><div><h4 class="text-lg font-bold text-gray-900">Cek Merek & Klasifikasi</h4><p class="text-sm text-gray-600 mt-1">Pastikan merek belum terdaftar. Tentukan kelas (Jasa/Barang).</p></div></div>
                    <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">2</div></div><div><h4 class="text-lg font-bold text-gray-900">Etiket Merek (Logo)</h4><p class="text-sm text-gray-600 mt-1">File logo format <strong>JPG</strong> (rekomendasi: 9x9 cm).</p></div></div>
                    <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">3</div></div><div><h4 class="text-lg font-bold text-gray-900">Data Pemilik</h4><p class="text-sm text-gray-600 mt-1">Scan KTP dan NPWP (JPG/PDF).</p></div></div>
                    <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">4</div></div><div><h4 class="text-lg font-bold text-gray-900">Tanda Tangan Digital</h4><p class="text-sm text-gray-600 mt-1">Foto tanda tangan di kertas putih (JPG).</p></div></div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">5</div></div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Surat Pernyataan UMK</h4>
                            <p class="text-sm text-gray-600 mt-1">Isi, TTD Materai, Scan (JPG/PDF).</p>
                            <a href="https://docs.google.com/document/d/1kexSPXukQdSxaWx_6bVUvyxw8c9h3srR/edit" target="_blank" class="text-sm text-blue-600 font-bold hover:underline mt-1 block">Download Template UMK &rarr;</a>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse"><button @click="showModalMerek = false" class="inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-100 sm:mt-0 sm:w-auto">Tutup</button></div>
            </div>
        </div>
    </div>

    {{-- 3. MODAL SYARAT CIPTA --}}
    <div x-show="showModalCipta" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" @click="showModalCipta = false"></div>
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border-t-8 border-yellow-500">
                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b">
                    <h3 class="text-xl font-extrabold leading-6 text-gray-900">Alur & Syarat Hak Cipta</h3>
                    <button @click="showModalCipta = false" class="text-gray-400 hover:text-red-500 focus:outline-none"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
                <div class="px-6 py-6 space-y-6">
                    <p class="text-center text-yellow-800 font-semibold bg-yellow-100 p-3 rounded-lg border border-yellow-200">"Jangan lupa publikasi karya, biar otomatis dapat hak cipta!"</p>
                    <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 text-yellow-600 font-bold">1</div></div><div><h4 class="text-lg font-bold text-gray-900">Identitas Pencipta</h4><p class="text-sm text-gray-600 mt-1">Scan/Foto KTP & NPWP (JPG/PDF).</p></div></div>
                    <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 text-yellow-600 font-bold">2</div></div><div><h4 class="text-lg font-bold text-gray-900">Identitas Pemegang Hak</h4><p class="text-sm text-gray-600 mt-1">Scan KTP & NPWP.</p></div></div>
                    <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 text-yellow-600 font-bold">3</div></div><div><h4 class="text-lg font-bold text-gray-900">File Contoh Ciptaan</h4><p class="text-sm text-gray-600 mt-1">Format sesuai jenis karya.</p></div></div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 text-yellow-600 font-bold">4</div></div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Surat Pernyataan Keaslian</h4>
                            <p class="text-sm text-gray-600 mt-1">Download, Isi, TTD Materai, Scan.</p>
                            <a href="https://docs.google.com/document/d/1KW8QYdNyRw1t1EhZ5XBwRT_GfyO6BTOf/edit" target="_blank" class="text-sm text-yellow-600 font-bold hover:underline mt-1 block">Download Template Pernyataan &rarr;</a>
                        </div>
                    </div>
                    <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 text-yellow-600 font-bold">5</div></div><div><h4 class="text-lg font-bold text-gray-900">Isi Formulir Digital</h4><p class="text-sm text-gray-600 mt-1">Siapkan data: Judul, Deskripsi, Tgl Publikasi.</p></div></div>
                </div>
                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse"><button @click="showModalCipta = false" class="inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-100 sm:mt-0 sm:w-auto">Tutup</button></div>
            </div>
        </div>
    </div>

    {{-- 4. MODAL JENIS FILE --}}
    <div x-show="showModalFile" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" @click="showModalFile = false"></div>
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl border-t-8 border-purple-500">
                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b">
                    <h3 class="text-xl font-extrabold leading-6 text-gray-900">Jenis & Format File Karya Cipta</h3>
                    <button @click="showModalFile = false" class="text-gray-400 hover:text-red-500 focus:outline-none"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
                <div class="px-6 py-6"><div class="overflow-x-auto"><table class="min-w-full divide-y divide-gray-200 border"><thead class="bg-gray-100"><tr><th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Jenis Ciptaan</th><th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">File Contoh Ciptaan</th><th class="px-4 py-2 text-center text-xs font-bold text-gray-700 uppercase">Format</th></tr></thead><tbody class="bg-white divide-y divide-gray-200 text-sm"><tr><td class="px-4 py-2 font-medium">Buku</td><td class="px-4 py-2">Cover, Daftar Isi, Daftar Pustaka</td><td class="px-4 py-2 text-center bg-gray-50">PDF</td></tr><tr><td class="px-4 py-2 font-medium">Program Komputer</td><td class="px-4 py-2">Cover, Program, Manual Book</td><td class="px-4 py-2 text-center bg-gray-50">PDF</td></tr><tr><td class="px-4 py-2 font-medium">Ceramah, Pidato, Kuliah</td><td class="px-4 py-2">Rekaman, Video</td><td class="px-4 py-2 text-center bg-gray-50">MP4 / PDF</td></tr><tr><td class="px-4 py-2 font-medium">Alat Peraga (Edukasi)</td><td class="px-4 py-2">Foto dan Buku Panduan</td><td class="px-4 py-2 text-center bg-gray-50">PDF</td></tr><tr><td class="px-4 py-2 font-medium">Lagu / Musik</td><td class="px-4 py-2">Rekaman / Partitur (Notasi)</td><td class="px-4 py-2 text-center bg-gray-50">MP3 / PDF</td></tr><tr><td class="px-4 py-2 font-medium">Drama, Tari, Pewayangan</td><td class="px-4 py-2">Video / Rekaman</td><td class="px-4 py-2 text-center bg-gray-50">MP4</td></tr><tr><td class="px-4 py-2 font-medium">Seni Rupa (Lukis, Ukir, Batik, Patung)</td><td class="px-4 py-2">Foto / Gambar</td><td class="px-4 py-2 text-center bg-gray-50">JPG</td></tr><tr><td class="px-4 py-2 font-medium">Arsitektur, Peta</td><td class="px-4 py-2">Foto / Gambar</td><td class="px-4 py-2 text-center bg-gray-50">JPG / PDF</td></tr><tr><td class="px-4 py-2 font-medium">Fotografi</td><td class="px-4 py-2">Foto / Gambar</td><td class="px-4 py-2 text-center bg-gray-50">JPG</td></tr><tr><td class="px-4 py-2 font-medium">Sinematografi</td><td class="px-4 py-2">Video, Naskah (Sinopsis)</td><td class="px-4 py-2 text-center bg-gray-50">MP4</td></tr><tr><td class="px-4 py-2 font-medium">Terjemahan / Tafsir</td><td class="px-4 py-2">Dokumen</td><td class="px-4 py-2 text-center bg-gray-50">PDF</td></tr></tbody></table><p class="mt-4 text-xs text-gray-500">*Ukuran maksimal file contoh ciptaan adalah 20 MB.</p></div></div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"><button @click="showModalFile = false" class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Tutup</button></div>
            </div>
        </div>
    </div>

</body>
</html>