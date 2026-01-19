<x-guest-layout>
    <div class="flex h-screen overflow-hidden">
        
        <div class="hidden lg:flex lg:w-1/2 bg-blue-600 relative justify-center items-center">
            {{-- Background Image dengan Overlay Biru --}}
            <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?q=80&w=2000&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover mix-blend-multiply opacity-60" 
                 alt="Background Kepri">
            
            <div class="relative z-10 text-center px-10">
                <h2 class="text-4xl font-bold text-white mb-4">Selamat Datang di LAKID</h2>
                <p class="text-blue-100 text-lg">Layanan Kekayaan Intelektual Digital<br>Provinsi Kepulauan Riau.</p>
            </div>
            
            {{-- Dekorasi Pola Garis --}}
            <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-blue-900/50 to-transparent"></div>
        </div>

        <div class="w-full lg:w-1/2 bg-white flex flex-col justify-center px-8 md:px-16 lg:px-24 py-10 overflow-y-auto">
            
            <div class="mb-8">
                <a href="/" class="inline-flex items-center gap-3 mb-6 group">
                    {{-- Ganti kotak biru "L" dengan Logo Kepri --}}
                    <img src="{{ asset('img/logo-kepri.png') }}" alt="Logo Kepri" class="w-9 h-auto drop-shadow-md">
                    
                    {{-- Teks LAKID di sebelahnya --}}
                    <div class="flex flex-col">
                        <span class="font-bold text-xl text-blue-900 leading-none">LAKID <span class="text-yellow-500">Kepri</span></span>
                        <span class="text-[10px] text-gray-500 tracking-wider font-semibold">DINAS PARIWISATA PROV. KEPRI</span>
                    </div>
                </a>
                                <h3 class="text-2xl font-bold text-gray-900">Masuk ke Akun Anda</h3>
                <p class="text-gray-500 text-sm mt-2">Silakan masukkan email dan password untuk melanjutkan.</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3" 
                           type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3" 
                           type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:text-blue-800 font-medium" href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                        </a>
                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        {{ __('Masuk') }}
                    </button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-800">Daftar sekarang</a>
                    </p>
                </div>
            </form>
            
            <div class="mt-10 pt-6 border-t border-gray-100 text-center text-xs text-gray-400">
                &copy; 2026 Dinas Pariwisata Prov. Kepulauan Riau
            </div>
        </div>
    </div>
</x-guest-layout>