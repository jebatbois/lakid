<x-guest-layout>
    <div class="flex flex-col items-center pt-6 sm:pt-0">
        
        {{-- Logo di Atas Card --}}
        <div class="mb-6">
            <a href="/">
                <img src="{{ asset('img/logo-kepri.png') }}" class="w-20 h-auto drop-shadow-sm" alt="Logo">
            </a>
        </div>

        {{-- Card Putih (Wadah Utama) --}}
        <div class="w-full sm:max-w-md mt-2 px-6 py-6 bg-white shadow-lg overflow-hidden sm:rounded-lg border border-gray-100">
            
            {{-- Header --}}
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-50 mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11.536 19.464a1.5 1.5 0 01-1.06.439H8v-4H6v-4h.939a1.5 1.5 0 011.06-.44l2.658-2.659a6 6 0 015.343-4.96z"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900">Lupa Kata Sandi?</h2>
                <p class="text-sm text-gray-600 mt-2">
                    Masukkan email yang terdaftar, kami akan mengirimkan link untuk mereset password Anda.
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Alamat Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="contoh@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        Kirim Link Reset Password
                    </button>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-blue-600 font-medium transition">
                        &larr; Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>