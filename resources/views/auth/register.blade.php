<x-guest-layout>
    <div class="mb-10">
        <img class="h-14 w-auto mb-6" src="{{ asset('img/logo-kepri.png') }}" alt="Logo">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">
            Halo, Kreator Baru! 🚀
        </h2>
        <p class="text-gray-500">
            Daftarkan diri Anda untuk mulai melindungi karya cipta dan merek usaha.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
            <input id="name" name="name" type="text" required autofocus
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm placeholder-gray-400"
                   value="{{ old('name') }}" placeholder="Sesuai KTP">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email Aktif</label>
            <input id="email" name="email" type="email" required
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm placeholder-gray-400"
                   value="{{ old('email') }}" placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Kata Sandi</label>
            <input id="password" name="password" type="password" required
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm placeholder-gray-400"
                   placeholder="Min. 8 karakter">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-1">Ulangi Kata Sandi</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm placeholder-gray-400"
                   placeholder="Konfirmasi sandi">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4 space-y-4">
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-500/30 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:-translate-y-0.5">
                Daftar Sekarang
            </button>

            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-800 transition">Masuk di sini</a>
                </p>
            </div>
        </div>
    </form>
</x-guest-layout>