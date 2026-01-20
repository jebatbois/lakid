<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kebijakan Privasi - LAKID Kepri</title>
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
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 md:p-12 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 rounded-full bg-white opacity-10 blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-32 h-32 rounded-full bg-white opacity-10 blur-2xl"></div>
            
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl mb-6 text-3xl shadow-sm">
                🔒
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">Kebijakan Privasi</h1>
            <p class="text-blue-100 mt-2 text-sm font-medium uppercase tracking-widest">Layanan Kekayaan Intelektual Digital</p>
        </div>

        {{-- Content Area --}}
        <div class="p-8 md:p-12 space-y-8">
            
            {{-- Tombol Kembali --}}
            <div>
                <a href="/" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-blue-600 transition group">
                    <span class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center mr-2 group-hover:bg-blue-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </span>
                    Kembali ke Beranda
                </a>
            </div>

            <div class="border-t border-gray-100 pt-6">
                <p class="text-sm text-gray-400 font-bold mb-6">Terakhir diperbarui: <span class="text-gray-600">{{ date('d F Y') }}</span></p>

                <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed">
                    <p class="text-lg">
                        Dinas Pariwisata Provinsi Kepulauan Riau ("Kami") berkomitmen untuk melindungi privasi Anda saat menggunakan aplikasi <strong>Layanan Kekayaan Intelektual Digital (LAKID)</strong>.
                    </p>

                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 text-sm">1</span>
                            Data yang Kami Kumpulkan
                        </h3>
                        <p class="pl-10">Kami mengumpulkan data pribadi yang Anda berikan secara sukarela saat melakukan pendaftaran akun atau pengajuan rekomendasi, meliputi:</p>
                        <ul class="pl-14 list-disc space-y-2 mt-2">
                            <li>Identitas Diri (Nama Lengkap, NIK, Alamat sesuai KTP).</li>
                            <li>Kontak (Nomor Telepon/WhatsApp, Alamat Email).</li>
                            <li>Dokumen Pendukung (Scan KTP, NPWP, Contoh Karya/Logo).</li>
                        </ul>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 text-sm">2</span>
                            Penggunaan Data
                        </h3>
                        <p class="pl-10">Data Anda hanya digunakan untuk kepentingan verifikasi pendaftaran HKI dan penerbitan Surat Rekomendasi Dinas. Kami menjamin:</p>
                        <ul class="pl-14 list-disc space-y-2 mt-2">
                            <li>Data tidak akan dijual atau disebarluaskan kepada pihak ketiga untuk tujuan komersial.</li>
                            <li>Data hanya diteruskan kepada instansi terkait (DJKI Kemenkumham) jika diperlukan untuk proses pendaftaran lanjutan.</li>
                        </ul>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 text-sm">3</span>
                            Keamanan Data
                        </h3>
                        <p class="pl-10">
                            Kami menerapkan langkah-langkah keamanan teknis untuk melindungi data Anda dari akses yang tidak sah. Dokumen yang Anda unggah disimpan dalam server yang aman.
                        </p>
                    </div>
                </div>
            </div>
            
            {{-- Footer Note --}}
            <div class="bg-gray-50 rounded-xl p-6 text-center text-sm text-gray-500 mt-8">
                Jika Anda memiliki pertanyaan mengenai kebijakan ini, silakan hubungi kami melalui <a href="#" class="text-blue-600 font-bold hover:underline">Kontak Layanan</a>.
            </div>

        </div>
    </div>
</body>
</html>