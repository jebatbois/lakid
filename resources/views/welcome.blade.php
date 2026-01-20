<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LAKID - Dinas Pariwisata Kepri</title>
    <link rel="icon" href="{{ asset('img/logo-kepri.png') }}" type="image/png">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Inisialisasi State AlpineJS di Body agar Modal bisa dipanggil dari mana saja --}}
<body class="antialiased bg-gray-50 text-gray-800 font-figtree" 
      x-data="{ showModalMerek: false, showModalCipta: false, showModalFile: false, showModalInfoCipta: false }">

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/logo-kepri.png') }}" alt="Logo Kepri" class="w-10 h-auto">
                    <div class="flex flex-col">
                        <span class="font-bold text-xl text-blue-900 leading-tight">LAKID <span class="text-yellow-500">Kepri</span></span>
                        <span class="text-[10px] text-gray-500 tracking-wider">DINAS PARIWISATA PROV. KEPRI</span>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm px-4 py-2 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 pt-20 px-4 sm:px-6 lg:px-8">
                <main class="mt-10 mx-auto max-w-7xl sm:mt-12 md:mt-16 lg:mt-20 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        {{-- Headline: Fokus ke "Fasilitasi & Rekomendasi" --}}
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Dapatkan Fasilitasi &</span>
                            <span class="block text-blue-600 xl:inline">Rekomendasi HKI Kepri</span>
                        </h1>
                        
                        {{-- Subheadline: Perjelas outputnya adalah "Surat Rekomendasi" --}}
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Layanan Kekayaan Intelektual Digital (LAKID). Ajukan permohonan <strong>Surat Rekomendasi Dinas Pariwisata</strong> untuk mendapatkan keringanan biaya pendaftaran Merek & Hak Cipta di Kemenkumham.
                        </p>
                        
                        {{-- Tombol CTA: Ubah jadi "Ajukan Rekomendasi" --}}
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start gap-3">
                            <div class="rounded-md shadow">
                                <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg">
                                    Ajukan Rekomendasi
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#layanan" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 md:py-4 md:text-lg">
                                    Panduan Layanan
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        {{-- Background Image --}}
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-gray-100 flex items-center justify-center">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full opacity-80" src="img/senggarang.JPG" alt="senggarang">
        </div>
    </section>

    <section id="layanan" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900">Pusat Informasi & Bantuan</h2>
                <p class="mt-4 text-lg text-gray-500">Semua yang Anda butuhkan sebelum mendaftar.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition overflow-hidden border-t-4 border-blue-500">
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-xl">®</div>
                            <h3 class="text-lg font-bold text-gray-900">Layanan Merek</h3>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Informasi bagi pelaku usaha yang ingin mendaftarkan brand/logo produk.</p>
                        
                        <ul class="space-y-3">
                            <li>
                                <button @click="showModalMerek = true" class="flex items-center text-gray-600 hover:text-blue-600 transition group text-sm w-full text-left outline-none focus:outline-none">
                                    <span class="w-6 h-6 rounded-full bg-gray-50 group-hover:bg-blue-100 flex items-center justify-center mr-3 text-xs">📄</span>
                                    Syarat Pendaftaran
                                </button>
                            </li>
                            <li>
                                <a href="https://pdki-indonesia.dgip.go.id" target="_blank" class="flex items-center text-gray-600 hover:text-blue-600 transition group text-sm">
                                    <span class="w-6 h-6 rounded-full bg-gray-50 group-hover:bg-blue-100 flex items-center justify-center mr-3 text-xs">🔍</span>
                                    Cek Pangkalan Data KI
                                </a>
                            </li>
                            <li>
                                <a href="https://skm.dgip.go.id/" target="_blank" class="flex items-center text-gray-600 hover:text-blue-600 transition group text-sm">
                                    <span class="w-6 h-6 rounded-full bg-gray-50 group-hover:bg-blue-100 flex items-center justify-center mr-3 text-xs">🏷️</span>
                                    Cek Kelas Merek (1-45)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition overflow-hidden border-t-4 border-yellow-500">
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-10 h-10 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center font-bold text-xl">©</div>
                            <h3 class="text-lg font-bold text-gray-900">Layanan Hak Cipta</h3>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Untuk karya seni, musik, buku, film, dan karya kreatif lainnya.</p>
                        
                        <ul class="space-y-3">
                            <li>
                                <button @click="showModalInfoCipta = true" class="flex items-center text-gray-600 hover:text-yellow-600 transition group text-sm w-full text-left outline-none focus:outline-none">
                                    <span class="w-6 h-6 rounded-full bg-gray-50 group-hover:bg-yellow-100 flex items-center justify-center mr-3 text-xs">ℹ️</span>
                                    Informasi & Modul Hak Cipta
                                </button>
                            </li>
                            <li>
                                <button @click="showModalCipta = true" class="flex items-center text-gray-600 hover:text-yellow-600 transition group text-sm w-full text-left outline-none focus:outline-none">
                                    <span class="w-6 h-6 rounded-full bg-gray-50 group-hover:bg-yellow-100 flex items-center justify-center mr-3 text-xs">📄</span>
                                    Syarat Pencatatan
                                </button>
                            </li>
                            <li>
                                <button @click="showModalFile = true" class="flex items-center text-gray-600 hover:text-yellow-600 transition group text-sm w-full text-left outline-none focus:outline-none">
                                    <span class="w-6 h-6 rounded-full bg-gray-50 group-hover:bg-yellow-100 flex items-center justify-center mr-3 text-xs">📂</span>
                                    Jenis File Karya
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition overflow-hidden border-t-4 border-green-500">
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold text-xl">⬇️</div>
                            <h3 class="text-lg font-bold text-gray-900">Dokumen & Bantuan</h3>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Unduh template surat dan hubungi kami jika ada kendala.</p>
                        
                        <ul class="space-y-3">
                            {{-- Link UMK --}}
                            <li>
                                <a href="https://docs.google.com/document/d/1kexSPXukQdSxaWx_6bVUvyxw8c9h3srR/edit" target="_blank" class="flex items-center text-gray-600 hover:text-green-600 transition group text-sm">
                                    <span class="w-6 h-6 rounded-full bg-gray-50 group-hover:bg-green-100 flex items-center justify-center mr-3 text-xs">📥</span>
                                    Download Template UMK
                                </a>
                            </li>
                            {{-- Link Hak Cipta --}}
                            <li>
                                <a href="https://docs.google.com/document/d/1KW8QYdNyRw1t1EhZ5XBwRT_GfyO6BTOf/edit" target="_blank" class="flex items-center text-gray-600 hover:text-green-600 transition group text-sm">
                                    <span class="w-6 h-6 rounded-full bg-gray-50 group-hover:bg-green-100 flex items-center justify-center mr-3 text-xs">📥</span>
                                    Download Surat Hak Cipta
                                </a>
                            </li>
                            {{-- Link Rekomendasi --}}
                            <li>
                                <a href="https://docs.google.com/document/d/1IsENGH7Fwhz6c9IF72Wckozs3E_osLeKMgZSgvJE1jA/edit" target="_blank" class="flex items-center text-gray-600 hover:text-green-600 transition group text-sm">
                                    <span class="w-6 h-6 rounded-full bg-gray-50 group-hover:bg-green-100 flex items-center justify-center mr-3 text-xs">📥</span>
                                    Surat Permohonan Rekom
                                </a>
                            </li>
                            <li class="pt-4 mt-4 border-t border-gray-100">
                                <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center justify-center w-full px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition font-bold shadow-md group">
                                    <svg class="w-6 h-6 mr-2 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                    Konsultasi via WhatsApp
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-10 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                
                {{-- Bagian Logo & Identitas (Updated) --}}
                <div class="mb-6 md:mb-0 flex items-center gap-4">
                    {{-- Logo Kepri --}}
                    <img src="{{ asset('img/logo-kepri.png') }}" alt="Logo Kepri" class="w-12 h-auto">
                    
                    {{-- Teks Dinas --}}
                    <div>
                        <span class="font-bold text-2xl block leading-none tracking-tight">LAKID</span>
                        <p class="text-gray-400 text-sm mt-1">Dinas Pariwisata Provinsi Kepulauan Riau</p>
                    </div>
                </div>

                {{-- Bagian Menu Footer (Berfungsi) --}}
                <div class="flex flex-wrap justify-center gap-6 text-sm">
                    <a href="{{ route('privacy') }}" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">Kebijakan Privasi</a>
                    <a href="{{ route('terms') }}" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">Syarat & Ketentuan</a>
                    {{-- Link Kontak mengarah ke Section Bantuan/WA --}}
                    <a href="#layanan" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">Kontak Kami</a>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-xs text-gray-500">
                &copy; {{ date('Y') }} Pemerintah Provinsi Kepulauan Riau. All rights reserved.
            </div>
        </div>
    </footer>

    {{-- ================= AREA MODAL (POP-UP) ================= --}}

    {{-- 1. MODAL INFORMASI HAK CIPTA --}}
    <div x-show="showModalInfoCipta" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" @click="showModalInfoCipta = false"></div>
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border-t-8 border-yellow-500">
                <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-between items-center">
                    <h3 class="text-xl font-bold leading-6 text-gray-900">Apa Itu Hak Cipta?</h3>
                    <button @click="showModalInfoCipta = false" class="text-gray-400 hover:text-gray-500 focus:outline-none"><span class="sr-only">Close</span><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
                <div class="px-4 py-5 sm:p-6 space-y-4">
                    <div class="bg-yellow-50 p-4 rounded-lg text-sm text-gray-700"><strong>Definisi:</strong> Hak eksklusif pencipta yang timbul secara otomatis setelah karya diwujudkan dalam bentuk nyata dan dipublikasikan.</div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4"><div class="border p-3 rounded"><h4 class="font-bold text-gray-900 mb-2">✨ Hak Moral</h4><p class="text-xs text-gray-600">Hak untuk dicantumkan namanya & melarang perubahan karya.</p></div><div class="border p-3 rounded"><h4 class="font-bold text-gray-900 mb-2">💰 Hak Ekonomi</h4><p class="text-xs text-gray-600">Hak mendapatkan royalti atau manfaat ekonomi dari penggunaan karya.</p></div></div>
                    <h4 class="font-bold text-gray-900 mt-4 border-b pb-1">Masa Berlaku Pelindungan</h4><ul class="list-disc pl-5 text-sm text-gray-700 space-y-1"><li><strong>Seumur Hidup + 70 Tahun:</strong> Buku, Lagu, Lukisan, Tari, Drama.</li><li><strong>50 Tahun sejak Publikasi:</strong> Fotografi, Program Komputer, Sinematografi.</li></ul>
                    <h4 class="font-bold text-gray-900 mt-4 border-b pb-1">Biaya PNBP (Online)</h4><ul class="list-disc pl-5 text-sm text-gray-700 space-y-1"><li><strong>UMK / Litbang:</strong> Rp 200.000 / permohonan.</li><li><strong>Umum:</strong> Rp 400.000 / permohonan.</li></ul>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                    <button @click="showModalInfoCipta = false" class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Tutup</button>
                    <a href="https://drive.google.com/file/d/13tB17EpZVLirdLm9aZJ-WHQeSfliyiiO/view" target="_blank" class="inline-flex w-full justify-center rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-700 sm:mt-0 sm:w-auto flex items-center gap-2">Download Modul (PDF)</a>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. MODAL SYARAT MEREK --}}
    <div x-show="showModalMerek" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" @click="showModalMerek = false"></div>
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border-t-8 border-blue-600">
                <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-between items-center"><h3 class="text-xl font-bold leading-6 text-gray-900">Alur & Syarat Pendaftaran Merek</h3><button @click="showModalMerek = false" class="text-gray-400 hover:text-gray-500 focus:outline-none"><span class="sr-only">Close</span><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button></div>
                <div class="px-4 py-5 sm:p-6 space-y-6">
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
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"><button @click="showModalMerek = false" class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Tutup</button></div>
            </div>
        </div>
    </div>

    {{-- 3. MODAL SYARAT HAK CIPTA --}}
    <div x-show="showModalCipta" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" @click="showModalCipta = false"></div>
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border-t-8 border-yellow-500">
                <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-between items-center"><h3 class="text-xl font-bold leading-6 text-gray-900">Alur & Syarat Hak Cipta</h3><button @click="showModalCipta = false" class="text-gray-400 hover:text-gray-500 focus:outline-none"><span class="sr-only">Close</span><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button></div>
                <div class="px-4 py-5 sm:p-6 space-y-6">
                    <p class="text-center text-yellow-600 font-semibold bg-yellow-50 p-2 rounded">"Jangan lupa publikasi karya, biar otomatis dapat hak cipta!"</p>
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
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"><button @click="showModalCipta = false" class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Tutup</button></div>
            </div>
        </div>
    </div>

    {{-- 4. MODAL JENIS FILE --}}
    <div x-show="showModalFile" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" @click="showModalFile = false"></div>
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl border-t-8 border-purple-500">
                <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-between items-center"><h3 class="text-xl font-bold leading-6 text-gray-900">Jenis & Format File Karya Cipta</h3><button @click="showModalFile = false" class="text-gray-400 hover:text-gray-500 focus:outline-none"><span class="sr-only">Close</span><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button></div>
                <div class="px-4 py-5 sm:p-6"><div class="overflow-x-auto"><table class="min-w-full divide-y divide-gray-200 border"><thead class="bg-gray-100"><tr><th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Jenis Ciptaan</th><th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">File Contoh Ciptaan</th><th class="px-4 py-2 text-center text-xs font-bold text-gray-700 uppercase">Format</th></tr></thead><tbody class="bg-white divide-y divide-gray-200 text-sm"><tr><td class="px-4 py-2 font-medium">Buku</td><td class="px-4 py-2">Cover, Daftar Isi, Daftar Pustaka</td><td class="px-4 py-2 text-center bg-gray-50">PDF</td></tr><tr><td class="px-4 py-2 font-medium">Program Komputer</td><td class="px-4 py-2">Cover, Program, Manual Book</td><td class="px-4 py-2 text-center bg-gray-50">PDF</td></tr><tr><td class="px-4 py-2 font-medium">Ceramah, Pidato, Kuliah</td><td class="px-4 py-2">Rekaman, Video</td><td class="px-4 py-2 text-center bg-gray-50">MP4 / PDF</td></tr><tr><td class="px-4 py-2 font-medium">Alat Peraga (Edukasi)</td><td class="px-4 py-2">Foto dan Buku Panduan</td><td class="px-4 py-2 text-center bg-gray-50">PDF</td></tr><tr><td class="px-4 py-2 font-medium">Lagu / Musik</td><td class="px-4 py-2">Rekaman / Partitur (Notasi)</td><td class="px-4 py-2 text-center bg-gray-50">MP4 / PDF</td></tr><tr><td class="px-4 py-2 font-medium">Drama, Tari, Pewayangan</td><td class="px-4 py-2">Video / Rekaman</td><td class="px-4 py-2 text-center bg-gray-50">MP4</td></tr><tr><td class="px-4 py-2 font-medium">Seni Rupa (Lukis, Ukir, Batik, Patung)</td><td class="px-4 py-2">Foto / Gambar</td><td class="px-4 py-2 text-center bg-gray-50">JPG</td></tr><tr><td class="px-4 py-2 font-medium">Arsitektur, Peta</td><td class="px-4 py-2">Foto / Gambar</td><td class="px-4 py-2 text-center bg-gray-50">JPG / PDF</td></tr><tr><td class="px-4 py-2 font-medium">Fotografi</td><td class="px-4 py-2">Foto / Gambar</td><td class="px-4 py-2 text-center bg-gray-50">JPG</td></tr><tr><td class="px-4 py-2 font-medium">Sinematografi</td><td class="px-4 py-2">Video, Naskah (Sinopsis)</td><td class="px-4 py-2 text-center bg-gray-50">MP4</td></tr><tr><td class="px-4 py-2 font-medium">Terjemahan / Tafsir</td><td class="px-4 py-2">Dokumen</td><td class="px-4 py-2 text-center bg-gray-50">PDF</td></tr></tbody></table><p class="mt-4 text-xs text-gray-500">*Ukuran maksimal file contoh ciptaan adalah 20 MB.</p></div></div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"><button @click="showModalFile = false" class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Tutup</button></div>
            </div>
        </div>
    </div>

</body>
</html>