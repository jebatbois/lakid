<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Syarat & Ketentuan - LAKID Kepri</title>
    <link rel="icon" href="{{ asset('img/logo-kepri.png') }}" type="image/png">

    {{-- Font Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen py-12 px-4 sm:px-6 lg:px-8 flex justify-center items-start">

    <div class="max-w-4xl w-full bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        
        {{-- Header Decoration --}}
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-8 md:p-12 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 rounded-full bg-white opacity-10 blur-2xl"></div>
            
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl mb-6 text-3xl shadow-sm">
                📜
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">Syarat & Ketentuan</h1>
            <p class="text-gray-300 mt-2 text-sm font-medium uppercase tracking-widest">Penggunaan Aplikasi LAKID</p>
        </div>

        {{-- Content Area --}}
        <div class="p-8 md:p-12 space-y-8">
            
            {{-- Tombol Kembali --}}
            <div>
                <a href="/" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-gray-900 transition group">
                    <span class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center mr-2 group-hover:bg-gray-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </span>
                    Kembali ke Beranda
                </a>
            </div>

            <div class="border-t border-gray-100 pt-6 text-gray-600 leading-relaxed">
                <p class="text-lg mb-8">
                    Selamat datang di LAKID Kepri. Dengan mengakses atau menggunakan aplikasi ini, Anda setuju untuk mematuhi ketentuan berikut:
                </p>

                {{-- Poin 1 --}}
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-gray-600 text-sm font-extrabold">1</span>
                        Kelayakan Pengguna
                    </h3>
                    <p class="pl-10">
                        Layanan ini dikhususkan bagi <strong>Pelaku Ekonomi Kreatif (Ekraf)</strong> dan <strong>UMKM</strong> yang berdomisili atau memiliki usaha di wilayah Provinsi Kepulauan Riau.
                    </p>
                </div>

                {{-- Poin 2 --}}
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-gray-600 text-sm font-extrabold">2</span>
                        Keaslian Dokumen
                    </h3>
                    <div class="pl-10">
                        <p class="mb-2">Pengguna wajib mengunggah dokumen yang <strong>asli, sah, dan terbaru</strong>.</p>
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg text-sm text-red-700">
                            <strong>Peringatan:</strong> Pemalsuan dokumen dapat mengakibatkan pembatalan rekomendasi secara sepihak dan potensi sanksi hukum sesuai peraturan perundang-undangan yang berlaku.
                        </div>
                    </div>
                </div>

                {{-- Poin 3 --}}
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-gray-600 text-sm font-extrabold">3</span>
                        Status Surat Rekomendasi
                    </h3>
                    <div class="pl-10 space-y-3">
                        <p>
                            Surat Rekomendasi yang diterbitkan oleh Dinas Pariwisata Provinsi Kepulauan Riau berfungsi sebagai syarat administrasi untuk mendapatkan <strong>keringanan biaya (insentif)</strong> pendaftaran HKI.
                        </p>
                        <p class="bg-yellow-50 p-4 rounded-lg border border-yellow-200 text-yellow-800 text-sm font-semibold">
                            ⚠️ Surat Rekomendasi ini TIDAK MENJAMIN sertifikat HKI/Merek Anda pasti terbit. Keputusan akhir penerbitan sertifikat HKI adalah kewenangan penuh Direktorat Jenderal Kekayaan Intelektual (DJKI) Kemenkumham RI.
                        </p>
                    </div>
                </div>

                {{-- Poin 4 --}}
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-gray-600 text-sm font-extrabold">4</span>
                        Hak Intelektual Karya
                    </h3>
                    <p class="pl-10">
                        Pengguna menjamin bahwa karya atau merek yang didaftarkan adalah murni hasil ciptaan sendiri dan tidak melanggar hak cipta atau merek milik orang lain. Dinas Pariwisata tidak bertanggung jawab atas sengketa HKI yang timbul di kemudian hari.
                    </p>
                </div>
            </div>

            {{-- Footer Note --}}
            <div class="text-center mt-12 pt-8 border-t border-gray-100">
                <button onclick="window.print()" class="text-gray-400 hover:text-gray-900 font-bold text-sm flex items-center justify-center gap-2 mx-auto transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Halaman Ini
                </button>
            </div>

        </div>
    </div>
</body>
</html>