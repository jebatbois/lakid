<x-guest-layout>
    <div class="flex flex-col items-center pt-6 sm:pt-0">
        
        <div class="mb-6">
            <a href="/">
                <img src="{{ asset('img/logo-kepri.png') }}" class="w-20 h-auto drop-shadow-sm" alt="Logo">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-2 px-6 py-6 bg-white shadow-lg overflow-hidden sm:rounded-lg border border-gray-100">
            
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-yellow-50 mb-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900">Verifikasi Email Anda</h2>
                <p class="text-sm text-gray-600 mt-2 text-justify">
                    Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda.
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded text-center border border-green-200">
                    {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                </div>
            @endif

            <div class="mt-6 flex flex-col gap-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition">
                        {{ __('Kirim Ulang Email Verifikasi') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                        {{ __('Keluar / Logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>