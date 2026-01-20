<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('img/logo-kepri.png') }}" type="image/png">

        {{-- Font Kekinian: Plus Jakarta Sans --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
    </head>
    <body class="text-gray-900 antialiased">
        <div class="min-h-screen flex bg-white">
            
            {{-- BAGIAN KIRI: Form Login (40%) --}}
            <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white w-full lg:w-[480px]">
                <div class="mx-auto w-full max-w-sm lg:w-96">
                    <div class="mb-10">
                        <img class="h-16 w-auto" src="{{ asset('img/logo-kepri.png') }}" alt="Logo">
                        <h2 class="mt-6 text-3xl font-extrabold text-gray-900 tracking-tight">
                            Selamat Datang, <br> <span class="text-blue-600">Kreator Kepri!</span> 👋
                        </h2>
                        <p class="mt-2 text-sm text-gray-600">
                            Masuk untuk mulai melindungi karya dan merekmu.
                        </p>
                    </div>

                    {{ $slot }}
                    
                    <div class="mt-8 text-center text-xs text-gray-400">
                        &copy; {{ date('Y') }} Dinas Pariwisata Prov. Kepri. <br>Layanan HKI Digital (LAKID).
                    </div>
                </div>
            </div>

            {{-- BAGIAN Kanan: Visual (60%) --}}
            <div class="hidden lg:block relative w-0 flex-1">
                {{-- Gambar Background (Bisa diganti foto pemandangan Kepri atau Abstrak) --}}
                <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=1964&auto=format&fit=crop" alt="Abstract Art">
                
                {{-- Overlay Gradient --}}
                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 to-purple-900/40 mix-blend-multiply"></div>
                
                {{-- Quote Inspiratif --}}
                <div class="absolute bottom-0 left-0 p-12 text-white">
                    <blockquote class="text-2xl font-bold italic mb-4">
                        "Kreativitas adalah kecerdasan yang bersenang-senang."
                    </blockquote>
                    <p class="font-medium">– Albert Einstein</p>
                </div>
            </div>
            
        </div>
    </body>
</html>