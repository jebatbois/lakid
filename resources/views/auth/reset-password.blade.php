<x-guest-layout>
    <div class="flex flex-col items-center pt-6 sm:pt-0">
        
        <div class="mb-6">
            <a href="/">
                <img src="{{ asset('img/logo-kepri.png') }}" class="w-20 h-auto drop-shadow-sm" alt="Logo">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-2 px-6 py-6 bg-white shadow-lg overflow-hidden sm:rounded-lg border border-gray-100">
            
            <div class="text-center mb-6">
                <h2 class="text-xl font-bold text-gray-900">Atur Ulang Kata Sandi</h2>
                <p class="text-sm text-gray-600 mt-1">Silakan buat kata sandi baru untuk akun Anda.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <x-input-label for="email" :value="__('Alamat Email')" />
                    <x-text-input id="email" class="block mt-1 w-full bg-gray-50" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" readonly />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Kata Sandi Baru')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition">
                        {{ __('Simpan Kata Sandi Baru') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>