<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil & Biodata') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi akun dan alamat email Anda. Data ini akan digunakan otomatis untuk pengajuan HKI.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Nama Lengkap --}}
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap (Sesuai KTP)')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Nomor KTP (NIK) --}}
        <div>
            <x-input-label for="no_ktp" :value="__('Nomor KTP (NIK)')" />
            <x-text-input id="no_ktp" name="no_ktp" type="number" class="mt-1 block w-full" :value="old('no_ktp', $user->no_ktp)" required placeholder="16 digit NIK" />
            <x-input-error class="mt-2" :messages="$errors->get('no_ktp')" />
        </div>

        {{-- Nomor WhatsApp --}}
        <div>
            <x-input-label for="no_hp" :value="__('Nomor WhatsApp Aktif')" />
            <x-text-input id="no_hp" name="no_hp" type="number" class="mt-1 block w-full" :value="old('no_hp', $user->no_hp)" required placeholder="Contoh: 08123456789" />
            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
        </div>

        {{-- Alamat Sesuai KTP --}}
        <div>
            <x-input-label for="alamat_ktp" :value="__('Alamat Lengkap (Sesuai KTP)')" />
            <textarea id="alamat_ktp" name="alamat_ktp" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('alamat_ktp', $user->alamat_ktp) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('alamat_ktp')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan Profil') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>