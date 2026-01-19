<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LAKID - Dinas Pariwisata Kepri</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-800 font-figtree">

    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3">
                    {{-- Ganti src ini dengan logo asli nanti --}}
                    <img src="{{ asset('img/logo-kepri.png') }}" alt="Logo Kepri" class="w-10 h-auto">
                    <div class="flex flex-col">
                        <span class="font-bold text-xl text-blue-900 leading-tight">LAKID <span class="text-yellow-500">Kepri</span></span>
                        <span class="text-[10px] text-gray-500 tracking-wider">DINAS PARIWISATA PROV. KEPRI</span>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            {{-- Kalau sudah login, arahkan ke dashboard yang sesuai role --}}
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
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Lindungi Karya &</span>
                            <span class="block text-blue-600 xl:inline">Merek Anda Sekarang</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Layanan Kekayaan Intelektual Digital (LAKID) Provinsi Kepulauan Riau. Fasilitasi pendaftaran Merek dan Hak Cipta gratis untuk pelaku Ekonomi Kreatif.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start gap-3">
                            <div class="rounded-md shadow">
                                <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg">
                                    Ajukan HKI
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
        {{-- Background Image Placeholder --}}
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-gray-100 flex items-center justify-center">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full opacity-80" src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1632&q=80" alt="Creative team">
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
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4 text-2xl">®</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Layanan Merek</h3>
                        <p class="text-gray-500 text-sm mb-6">Informasi bagi pelaku usaha yang ingin mendaftarkan brand/logo produk.</p>
                        
                        <ul class="space-y-3">
                            <li>
                                <a href="#" class="flex items-center text-gray-600 hover:text-blue-600 transition group">
                                    <span class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-blue-100 flex items-center justify-center mr-3 text-xs">📄</span>
                                    Syarat Pendaftaran
                                </a>
                            </li>
                            <li>
                                <a href="https://pdki-indonesia.dgip.go.id" target="_blank" class="flex items-center text-gray-600 hover:text-blue-600 transition group">
                                    <span class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-blue-100 flex items-center justify-center mr-3 text-xs">🔍</span>
                                    Cek Pangkalan Data KI
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-600 hover:text-blue-600 transition group">
                                    <span class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-blue-100 flex items-center justify-center mr-3 text-xs">🏷️</span>
                                    Cek Kelas Merek (1-45)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition overflow-hidden border-t-4 border-yellow-500">
                    <div class="p-6">
                        <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mb-4 text-2xl">©</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Layanan Hak Cipta</h3>
                        <p class="text-gray-500 text-sm mb-6">Untuk karya seni, musik, buku, film, dan karya kreatif lainnya.</p>
                        
                        <ul class="space-y-3">
                            <li>
                                <a href="#" class="flex items-center text-gray-600 hover:text-yellow-600 transition group">
                                    <span class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-yellow-100 flex items-center justify-center mr-3 text-xs">📄</span>
                                    Syarat Pencatatan
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-600 hover:text-yellow-600 transition group">
                                    <span class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-yellow-100 flex items-center justify-center mr-3 text-xs">📂</span>
                                    Jenis File Karya
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-600 hover:text-yellow-600 transition group">
                                    <span class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-yellow-100 flex items-center justify-center mr-3 text-xs">ℹ️</span>
                                    Informasi Hak Cipta
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition overflow-hidden border-t-4 border-green-500">
                    <div class="p-6">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-4 text-2xl">⬇️</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Dokumen & Bantuan</h3>
                        <p class="text-gray-500 text-sm mb-6">Unduh template surat dan hubungi kami jika ada kendala.</p>
                        
                        <ul class="space-y-3">
                            <li>
                                <a href="#" class="flex items-center text-gray-600 hover:text-green-600 transition group">
                                    <span class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-green-100 flex items-center justify-center mr-3 text-xs">📥</span>
                                    Download Surat Pernyataan
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-600 hover:text-green-600 transition group">
                                    <span class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-green-100 flex items-center justify-center mr-3 text-xs">📥</span>
                                    Surat Permohonan Rekom
                                </a>
                            </li>
                         <li class="pt-4 mt-4 border-t border-gray-100">
    <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center justify-center w-full px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition font-bold shadow-md group">
        {{-- Ikon WhatsApp --}}
        <svg class="w-6 h-6 mr-2 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
        Konsultasi via WhatsApp
    </a>
</li>