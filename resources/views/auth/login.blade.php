<x-guest-layout>
    <div class="mb-10">
        <img class="h-14 w-auto mb-6" src="{{ asset('img/logo-kepri.png') }}" alt="Logo">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">
            Selamat Datang <br> Kembali! 👋
        </h2>
        <p class="text-gray-500">
            Masuk untuk melanjutkan pengelolaan aset HKI Anda.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Alamat Email</label>
            <input id="email" name="email" type="email" required autofocus
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm placeholder-gray-400"
                   value="{{ old('email') }}" placeholder="contoh@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Kata Sandi</label>
            <input id="password" name="password" type="password" required autocomplete="current-password"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm placeholder-gray-400"
                   placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition">Lupa sandi?</a>
            @endif
        </div>

        <div class="pt-2 space-y-4">
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-500/30 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:-translate-y-0.5">
                Masuk Sekarang
            </button>
            
            <div class="relative flex py-2 items-center">
                <div class="flex-grow border-t border-gray-200"></div>
                <span class="flex-shrink-0 mx-4 text-gray-400 text-xs uppercase font-bold">Belum punya akun?</span>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>

            <a href="{{ route('register') }}" class="w-full flex justify-center py-3.5 px-4 border-2 border-gray-200 rounded-xl text-sm font-bold text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-300 focus:outline-none transition">
                Daftar Akun Baru
            </a>
        </div>
    </form>
</x-guest-layout>