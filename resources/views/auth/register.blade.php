<x-guest-layout>
    <div class="min-h-screen flex overflow-hidden">
        
        <div class="hidden lg:flex lg:w-1/2 bg-yellow-500 relative justify-center items-center order-2">
            {{-- Background berbeda untuk register --}}
            <img src="https://images.unsplash.com/photo-1599708153386-fa2e272a1df5?q=80&w=2000&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover mix-blend-multiply opacity-60" 
                 alt="Kerajinan Tangan">
            
            <div class="relative z-10 text-center px-10">
                <h2 class="text-4xl font-bold text-white mb-4">Bergabunglah Bersama Kami</h2>
                <p class="text-yellow-100 text-lg">Daftarkan karya Anda dan dapatkan perlindungan<br>hukum yang layak.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 bg-white flex flex-col justify-center px-6 sm:px-8 md:px-12 lg:px-24 py-12 sm:py-16 overflow-y-auto order-1">
            
            <div class="mb-8 flex-shrink-0">
                <a href="/" class="inline-flex items-center gap-3 mb-6 group">
                    {{-- Ganti kotak biru "L" dengan Logo Kepri --}}
                    <img src="{{ asset('img/logo-kepri.png') }}" alt="Logo Kepri" class="w-12 h-auto drop-shadow-md flex-shrink-0">
                    
                    {{-- Teks LAKID di sebelahnya --}}
                    <div class="flex flex-col">
                        <span class="font-bold text-xl text-blue-900 leading-none">LAKID <span class="text-yellow-500">Kepri</span></span>
                        <span class="text-[10px] text-gray-500 tracking-wider font-semibold">DINAS PARIWISATA PROV. KEPRI</span>
                    </div>
                </a>
                <h3 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h3>
                <p class="text-gray-500 text-sm mt-2">Lengkapi data diri Anda untuk memulai pendaftaran HKI.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4 w-full max-w-md">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input id="name" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Sesuai KTP" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input id="email" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input id="password" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <input id="password_confirmation" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        {{ __('Daftar') }}
                    </button>
                </div>

                <div class="text-center mt-8">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-800">Masuk disini</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>