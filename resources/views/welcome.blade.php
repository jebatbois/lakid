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
        .hero-gradient { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); }
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
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-bold text-gray-700 hover:text-blue-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="hidden sm:block text-sm font-bold text-gray-600 hover:text-blue-600 transition">Masuk</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm px-6 py-3 bg-blue-600 text-white rounded-full font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-600/30 transform hover:-translate-y-0.5">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION (Modern & Bold) --}}
    <section class="relative pt-16 pb-24 lg:pt-32 lg:pb-40 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            
            {{-- Badge --}}
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-bold mb-8 border border-blue-100 shadow-sm animate-fade-in-up">
                <span class="flex h-2 w-2 rounded-full bg-blue-600 mr-2"></span>
                Fasilitasi HKI Resmi Pemerintah
            </div>

            {{-- Headline --}}
            <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 tracking-tight mb-6 leading-tight">
                Lindungi Karya, <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Raih Masa Depan.</span>
            </h1>

            {{-- Subheadline --}}
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 mb-10 leading-relaxed">
                Platform digital Dinas Pariwisata Kepulauan Riau untuk mendapatkan <strong>Surat Rekomendasi HKI</strong>. Permudah pendaftaran Merek & Hak Cipta Anda ke Kemenkumham.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="px-8 py-4 text-lg font-bold rounded-full text-white bg-blue-600 hover:bg-blue-700 shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
                    Ajukan Rekomendasi 🚀
                </a>
                <a href="#layanan" class="px-8 py-4 text-lg font-bold rounded-full text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 shadow-sm transition">
                    Pelajari Syarat
                </a>
            </div>

            {{-- Stats (Opsional / Pemanis) --}}
            <div class="mt-16 pt-8 border-t border-gray-100 flex justify-center gap-8 md:gap-16 grayscale opacity-70 hover:grayscale-0 transition duration-500">
                <div class="text-center">
                    <p class="text-3xl font-bold text-gray-900">Gratis</p>
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Biaya Rekomendasi</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-gray-900">Cepat</p>
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Proses Verifikasi</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-gray-900">Resmi</p>
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Dinas Pariwisata</p>
                </div>
            </div>
        </div>

        {{-- Background Decoration (Abstract blobs) --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10 opacity-40 pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-20 right-10 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-32 left-1/2 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
        </div>
    </section>

    {{-- SECTION LAYANAN (Bento Grid Style) --}}
    <section id="layanan" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Pusat Informasi & Layanan</h2>
                <p class="text-lg text-gray-500 max-w-2xl mx-auto">Kami menyediakan template surat dan panduan lengkap agar proses pendaftaran HKI Anda berjalan mulus.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- CARD 1: MEREK --}}
                <div class="group bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center font-bold text-2xl mb-6 group-hover:scale-110 transition">®</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Layanan Merek</h3>
                    <p class="text-gray-500 mb-8 leading-relaxed">Panduan lengkap bagi UMKM untuk melindungi nama brand, logo, dan identitas usaha.</p>
                    
                    <ul class="space-y-4">
                        <li>
                            <button @click="showModalMerek = true" class="w-full flex items-center justify-between p-3 rounded-xl bg-white border border-gray-200 hover:border-blue-500 hover:text-blue-600 transition group/btn shadow-sm">
                                <span class="font-bold text-sm">📄 Syarat Pendaftaran</span>
                                <span class="text-gray-400 group-hover/btn:text-blue-500">→</span>
                            </button>
                        </li>
                        <li>
                            <a href="https://pdki-indonesia.dgip.go.id" target="_blank" class="w-full flex items-center justify-between p-3 rounded-xl bg-white border border-gray-200 hover:border-blue-500 hover:text-blue-600 transition group/btn shadow-sm">
                                <span class="font-bold text-sm">🔍 Cek Database Merek</span>
                                <span class="text-gray-400 group-hover/btn:text-blue-500">↗</span>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- CARD 2: HAK CIPTA --}}
                <div class="group bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 bg-yellow-100 text-yellow-600 rounded-2xl flex items-center justify-center font-bold text-2xl mb-6 group-hover:scale-110 transition">©</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Layanan Hak Cipta</h3>
                    <p class="text-gray-500 mb-8 leading-relaxed">Perlindungan otomatis untuk karya seni, musik, buku, film, foto, dan program komputer.</p>
                    
                    <ul class="space-y-4">
                        <li>
                            <button @click="showModalInfoCipta = true" class="w-full flex items-center justify-between p-3 rounded-xl bg-white border border-gray-200 hover:border-yellow-500 hover:text-yellow-600 transition group/btn shadow-sm">
                                <span class="font-bold text-sm">ℹ️ Modul Hak Cipta</span>
                                <span class="text-gray-400 group-hover/btn:text-yellow-500">→</span>
                            </button>
                        </li>
                        <li>
                            <button @click="showModalCipta = true" class="w-full flex items-center justify-between p-3 rounded-xl bg-white border border-gray-200 hover:border-yellow-500 hover:text-yellow-600 transition group/btn shadow-sm">
                                <span class="font-bold text-sm">📄 Syarat Pencatatan</span>
                                <span class="text-gray-400 group-hover/btn:text-yellow-500">→</span>
                            </button>
                        </li>
                    </ul>
                </div>

                {{-- CARD 3: DOKUMEN --}}
                <div class="group bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center font-bold text-2xl mb-6 group-hover:scale-110 transition">⬇️</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Unduh Dokumen</h3>
                    <p class="text-gray-500 mb-8 leading-relaxed">Kumpulan template surat pernyataan dan permohonan yang siap pakai.</p>
                    
                    <ul class="space-y-4">
                        <li>
                            <a href="https://docs.google.com/document/d/1kexSPXukQdSxaWx_6bVUvyxw8c9h3srR/edit" target="_blank" class="w-full flex items-center justify-between p-3 rounded-xl bg-white border border-gray-200 hover:border-green-500 hover:text-green-600 transition group/btn shadow-sm">
                                <span class="font-bold text-sm">📥 Template Surat UMK</span>
                                <span class="text-gray-400 group-hover/btn:text-green-500">↓</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://docs.google.com/document/d/1IsENGH7Fwhz6c9IF72Wckozs3E_osLeKMgZSgvJE1jA/edit" target="_blank" class="w-full flex items-center justify-between p-3 rounded-xl bg-white border border-gray-200 hover:border-green-500 hover:text-green-600 transition group/btn shadow-sm">
                                <span class="font-bold text-sm">📥 Surat Permohonan</span>
                                <span class="text-gray-400 group-hover/btn:text-green-500">↓</span>
                            </a>
                        </li>
                    </ul>
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

    {{-- ========================================== --}}
    {{-- AREA MODAL (SAMA SEPERTI DASHBOARD)        --}}
    {{-- (Copy Paste Modal Code dari Bantuan.blade) --}}
    {{-- Saya sertakan ringkasannya agar file lengkap --}}
    {{-- ========================================== --}}

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
                </div>
                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse"><button @click="showModalCipta = false" class="inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-100 sm:mt-0 sm:w-auto">Tutup</button></div>
            </div>
        </div>
    </div>

</body>
</html>