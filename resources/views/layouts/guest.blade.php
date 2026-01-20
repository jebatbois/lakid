<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LAKID Kepri') }}</title>
        <link rel="icon" href="{{ asset('img/logo-kepri.png') }}" type="image/png">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
    </head>
    <body class="bg-white text-gray-900 antialiased h-screen overflow-hidden">
        
        <div class="flex w-full h-full">
            
            {{-- BAGIAN KIRI: Scrollable Form Area --}}
            <div class="w-full lg:w-[45%] h-full flex flex-col bg-white overflow-y-auto custom-scrollbar relative z-10">
                <div class="flex-1 flex flex-col justify-center px-6 sm:px-12 lg:px-20 py-12">
                    <div class="w-full max-w-md mx-auto">
                        {{-- Slot Konten (Header & Form masuk di sini) --}}
                        {{ $slot }}
                    </div>
                </div>

                {{-- Footer Tetap --}}
                <div class="py-6 text-center text-xs text-gray-400">
                    &copy; {{ date('Y') }} LAKID - Dinas Pariwisata Prov. Kepri.
                </div>
            </div>

            {{-- BAGIAN KANAN: Fixed Visual Area --}}
            <div class="hidden lg:block w-[55%] h-full relative overflow-hidden bg-blue-900">
                <img class="absolute inset-0 h-full w-full object-cover opacity-80" 
                     src="https://images.unsplash.com/photo-1634153721382-7d3d193155e8?q=80&w=2070&auto=format&fit=crop" 
                     alt="Creative Background">
                
                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-purple-900/50 to-transparent mix-blend-multiply"></div>
                
                <div class="absolute bottom-0 left-0 p-16 text-white z-20 max-w-2xl">
                    <div class="mb-6">
                         <span class="px-3 py-1 bg-white/10 backdrop-blur border border-white/20 rounded-full text-xs font-bold tracking-wider uppercase">Inovasi Daerah</span>
                    </div>
                    <blockquote class="text-4xl font-extrabold leading-tight mb-6 drop-shadow-lg">
                        "Lindungi ide kreatifmu hari ini, untuk nilai ekonomi yang abadi di masa depan."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="h-1 w-12 bg-blue-400 rounded-full"></div>
                        <p class="font-medium text-blue-100">Dinas Pariwisata Prov. Kepri</p>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>