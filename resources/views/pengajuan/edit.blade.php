<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
                {{ __('Edit Pengajuan') }}
            </h2>
            <a href="{{ route('pengajuan.show', $pengajuan) }}" class="inline-flex items-center px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded">
                    <h3 class="font-semibold mb-2">❌ Terjadi kesalahan:</h3>
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pengajuan.update', $pengajuan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-8 space-y-8">
                    <!-- Nama Merek -->
                    <div class="border-t-2 border-slate-200 pt-6 first:border-t-0 first:pt-0">
                        <label for="nama_merek" class="block text-base font-semibold text-gray-900 mb-3">
                            📛 Nama Merek / Produk <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="text"
                            id="nama_merek"
                            name="nama_merek"
                            value="{{ old('nama_merek', $pengajuan->nama_merek) }}"
                            class="w-full px-4 py-3 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition @error('nama_merek') border-red-500 @enderror"
                            required>
                        @error('nama_merek')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis HKI -->
                    <div class="border-t-2 border-slate-200 pt-6">
                        <label for="jenis" class="block text-base font-semibold text-gray-900 mb-3">
                            🏷️ Jenis HKI <span class="text-red-600">*</span>
                        </label>
                        <select
                            id="jenis"
                            name="jenis"
                            class="w-full px-4 py-3 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition @error('jenis') border-red-500 @enderror"
                            required>
                            <option value="">-- Pilih Jenis HKI --</option>
                            <option value="Merek" @selected(old('jenis', $pengajuan->jenis) === 'Merek')>Merek</option>
                            <option value="Paten" @selected(old('jenis', $pengajuan->jenis) === 'Paten')>Paten</option>
                            <option value="Desain Industri" @selected(old('jenis', $pengajuan->jenis) === 'Desain Industri')>Desain Industri</option>
                            <option value="Hak Cipta" @selected(old('jenis', $pengajuan->jenis) === 'Hak Cipta')>Hak Cipta</option>
                        </select>
                        @error('jenis')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Karya -->
                    <div class="border-t-2 border-slate-200 pt-6">
                        <label for="deskripsi_karya" class="block text-base font-semibold text-gray-900 mb-3">
                            📝 Deskripsi Karya <span class="text-red-600">*</span>
                        </label>
                        <textarea
                            id="deskripsi_karya"
                            name="deskripsi_karya"
                            rows="5"
                            class="w-full px-4 py-3 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition @error('deskripsi_karya') border-red-500 @enderror"
                            required>{{ old('deskripsi_karya', $pengajuan->deskripsi_karya) }}</textarea>
                        @error('deskripsi_karya')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Logo -->
                    <div class="border-t-2 border-slate-200 pt-6">
                        <label for="file_logo" class="block text-base font-semibold text-gray-900 mb-3">
                            📷 File Logo / Desain (PNG, JPG - Max 2MB)
                        </label>
                        @if ($pengajuan->file_logo)
                            <div class="mb-4 p-4 bg-blue-50 border-2 border-blue-300 rounded-lg flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-2xl mr-3">🖼️</span>
                                    <div>
                                        <p class="text-sm font-medium text-blue-900">File saat ini:</p>
                                        <p class="text-sm text-blue-700">{{ basename($pengajuan->file_logo) }}</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($pengajuan->file_logo) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Lihat</a>
                            </div>
                        @endif
                        <div class="border-2 border-blue-300 border-dashed rounded-lg p-6 text-center hover:bg-blue-50 hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById('file_logo').click()">
                            <input
                                type="file"
                                id="file_logo"
                                name="file_logo"
                                accept="image/png,image/jpeg"
                                class="hidden"
                                onchange="validateFileSize(this, 2); updateFileName(this, 'logoName')">
                            <p class="text-gray-600 font-medium">Klik atau drag file di sini</p>
                            <p class="text-sm text-gray-500 mt-1">PNG, JPG - Maksimal 2MB</p>
                            <p class="text-xs text-gray-400 mt-2">Biarkan kosong jika tidak ingin mengubah</p>
                            <p id="logoName" class="text-sm text-blue-600 font-semibold mt-2"></p>
                        </div>
                        <p id="logoError" class="mt-2 text-sm text-red-600" style="display: none;"></p>
                        @error('file_logo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File KTP -->
                    <div class="border-t-2 border-slate-200 pt-6">
                        <label for="file_ktp" class="block text-base font-semibold text-gray-900 mb-3">
                            🪪 File KTP / Identitas (PNG, JPG - Max 2MB)
                        </label>
                        @if ($pengajuan->file_ktp)
                            <div class="mb-4 p-4 bg-blue-50 border-2 border-blue-300 rounded-lg flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-2xl mr-3">📄</span>
                                    <div>
                                        <p class="text-sm font-medium text-blue-900">File saat ini:</p>
                                        <p class="text-sm text-blue-700">{{ basename($pengajuan->file_ktp) }}</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($pengajuan->file_ktp) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Lihat</a>
                            </div>
                        @endif
                        <div class="border-2 border-blue-300 border-dashed rounded-lg p-6 text-center hover:bg-blue-50 hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById('file_ktp').click()">
                            <input
                                type="file"
                                id="file_ktp"
                                name="file_ktp"
                                accept="image/png,image/jpeg"
                                class="hidden"
                                onchange="validateFileSize(this, 2); updateFileName(this, 'ktpName')">
                            <p class="text-gray-600 font-medium">Klik atau drag file di sini</p>
                            <p class="text-sm text-gray-500 mt-1">PNG, JPG - Maksimal 2MB</p>
                            <p class="text-xs text-gray-400 mt-2">Biarkan kosong jika tidak ingin mengubah</p>
                            <p id="ktpName" class="text-sm text-blue-600 font-semibold mt-2"></p>
                        </div>
                        <p id="ktpError" class="mt-2 text-sm text-red-600" style="display: none;"></p>
                        @error('file_ktp')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="border-t-2 border-slate-200 pt-6 flex gap-3">
                        <button
                            type="submit"
                            class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition shadow-sm hover:shadow">
                            ✅ Simpan Perubahan
                        </button>
                        <a href="{{ route('pengajuan.show', $pengajuan) }}" class="flex-1 px-6 py-3 bg-slate-300 hover:bg-slate-400 text-slate-800 font-bold rounded-lg transition text-center shadow-sm hover:shadow">
                            ❌ Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateFileSize(input, maxMB) {
            const file = input.files[0];
            const maxBytes = maxMB * 1024 * 1024;
            const errorId = input.id === 'file_logo' ? 'logoError' : 'ktpError';
            const errorElement = document.getElementById(errorId);

            if (file && file.size > maxBytes) {
                errorElement.textContent = `❌ File terlalu besar. Maksimal ${maxMB}MB. Ukuran: ${(file.size / 1024 / 1024).toFixed(2)}MB`;
                errorElement.style.display = 'block';
                input.value = '';
            } else {
                errorElement.style.display = 'none';
            }
        }

        function updateFileName(input, nameId) {
            const nameElement = document.getElementById(nameId);
            if (input.files[0]) {
                nameElement.textContent = '✅ ' + input.files[0].name;
            } else {
                nameElement.textContent = '';
            }
        }
    </script>
</x-app-layout>
