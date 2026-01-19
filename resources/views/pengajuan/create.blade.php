<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Pengajuan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Pengajuan Baru</h1>
                <p class="text-gray-600">Isi formulir di bawah untuk mengajukan Hak Kekayaan Intelektual Anda</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white shadow-lg sm:rounded-xl p-8">
                <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="pengajuanForm">
                    @csrf

                    <!-- Nama Merek -->
                    <div>
                        <label for="nama_merek" class="block text-sm font-semibold text-gray-900 mb-2">
                            Nama Merek / Karya <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="nama_merek" 
                            name="nama_merek" 
                            value="{{ old('nama_merek') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_merek') border-red-500 @enderror"
                            placeholder="Contoh: Logo XYZ, Inovasi A"
                            required>
                        @error('nama_merek')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 15.586l-6.687-6.687a1 1 0 00-1.414 1.414l7.394 7.394a1 1 0 001.414 0l8.794-8.794z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Jenis HKI -->
                    <div>
                        <label for="jenis" class="block text-sm font-semibold text-gray-900 mb-2">
                            Jenis HKI <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="jenis" 
                            name="jenis"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jenis') border-red-500 @enderror"
                            required>
                            <option value="">-- Pilih Jenis HKI --</option>
                            <option value="Merek" {{ old('jenis') === 'Merek' ? 'selected' : '' }}>Merek</option>
                            <option value="Hak Cipta" {{ old('jenis') === 'Hak Cipta' ? 'selected' : '' }}>Hak Cipta</option>
                            <option value="Desain Industri" {{ old('jenis') === 'Desain Industri' ? 'selected' : '' }}>Desain Industri</option>
                        </select>
                        @error('jenis')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 15.586l-6.687-6.687a1 1 0 00-1.414 1.414l7.394 7.394a1 1 0 001.414 0l8.794-8.794z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Deskripsi Karya -->
                    <div>
                        <label for="deskripsi_karya" class="block text-sm font-semibold text-gray-900 mb-2">
                            Deskripsi Karya <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="deskripsi_karya" 
                            name="deskripsi_karya"
                            rows="5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('deskripsi_karya') border-red-500 @enderror"
                            placeholder="Jelaskan secara detail tentang karya/merek Anda. Minimal 20 karakter."
                            required>{{ old('deskripsi_karya') }}</textarea>
                        <p class="mt-2 text-xs text-gray-500">Minimal 20 karakter, maksimal 1000 karakter</p>
                        @error('deskripsi_karya')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 15.586l-6.687-6.687a1 1 0 00-1.414 1.414l7.394 7.394a1 1 0 001.414 0l8.794-8.794z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- File Uploads Section -->
                    <div class="border-t-2 border-gray-200 pt-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Dokumen yang Diperlukan</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- File Logo -->
                            <div>
                                <label for="file_logo" class="block text-sm font-semibold text-gray-900 mb-3">
                                    📷 Upload Logo / Desain
                                </label>
                                <div class="relative">
                                    <input 
                                        type="file" 
                                        id="file_logo" 
                                        name="file_logo"
                                        accept=".jpg,.jpeg,.png,.gif"
                                        class="sr-only"
                                        onchange="validateFileSize(this, 'logoLabel', 'logoError')">
                                    <label for="file_logo" id="logoLabel" class="flex items-center justify-center w-full px-6 py-8 border-2 border-dashed border-blue-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition">
                                        <div class="text-center">
                                            <svg class="mx-auto h-10 w-10 text-blue-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-8l-3.172-3.172a4 4 0 00-5.656 0L28 28M9 20h.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <p class="mt-3 text-sm font-medium text-gray-900">
                                                <span class="text-blue-600 hover:text-blue-700">Klik untuk upload</span> atau drag
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">JPG, PNG, GIF (Maks 2MB)</p>
                                        </div>
                                    </label>
                                </div>
                                <div id="logoError" class="mt-2"></div>
                                @error('file_logo')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- File KTP -->
                            <div>
                                <label for="file_ktp" class="block text-sm font-semibold text-gray-900 mb-3">
                                    🪪 Upload KTP / Identitas
                                </label>
                                <div class="relative">
                                    <input 
                                        type="file" 
                                        id="file_ktp" 
                                        name="file_ktp"
                                        accept=".jpg,.jpeg,.png,.pdf"
                                        class="sr-only"
                                        onchange="validateFileSize(this, 'ktpLabel', 'ktpError')">
                                    <label for="file_ktp" id="ktpLabel" class="flex items-center justify-center w-full px-6 py-8 border-2 border-dashed border-blue-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition">
                                        <div class="text-center">
                                            <svg class="mx-auto h-10 w-10 text-blue-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-8l-3.172-3.172a4 4 0 00-5.656 0L28 28M9 20h.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <p class="mt-3 text-sm font-medium text-gray-900">
                                                <span class="text-blue-600 hover:text-blue-700">Klik untuk upload</span> atau drag
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">JPG, PNG, PDF (Maks 2MB)</p>
                                        </div>
                                    </label>
                                </div>
                                <div id="ktpError" class="mt-2"></div>
                                @error('file_ktp')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- File Surat UMK -->
                        <div class="mt-8">
                            <label for="file_surat_umk" class="block text-sm font-semibold text-gray-900 mb-3">
                                📄 Surat Pernyataan UMK (PDF/JPG) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="file" 
                                    id="file_surat_umk" 
                                    name="file_surat_umk"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    class="sr-only"
                                    onchange="validateFileSize(this, 'umkLabel', 'umkError')"
                                    required>
                                <label for="file_surat_umk" id="umkLabel" class="flex items-center justify-center w-full px-6 py-8 border-2 border-dashed border-green-300 rounded-lg cursor-pointer hover:border-green-500 hover:bg-green-50 transition">
                                    <div class="text-center">
                                        <svg class="mx-auto h-10 w-10 text-green-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-8l-3.172-3.172a4 4 0 00-5.656 0L28 28M9 20h.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <p class="mt-3 text-sm font-medium text-gray-900">
                                            <span class="text-green-600 hover:text-green-700">Klik untuk upload</span> atau drag
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Maks 2MB)</p>
                                    </div>
                                </label>
                            </div>
                            <div id="umkError" class="mt-2"></div>
                            <p class="text-xs text-gray-600 mt-2">⚠️ Wajib menyertakan surat pernyataan UMK sesuai format untuk mendapatkan diskon.</p>
                            @error('file_surat_umk')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-4 pt-8 border-t-2 border-gray-200">
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="inline-flex items-center px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out shadow-lg hover:shadow-xl">
                            <span id="btnText">💾 Simpan Pengajuan</span>
                            <svg id="spinner" class="hidden w-5 h-5 ml-2 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                        <a 
                            href="{{ route('dashboard') }}" 
                            class="px-8 py-3 bg-gray-200 hover:bg-gray-300 text-gray-900 font-semibold rounded-lg transition duration-150 ease-in-out">
                            ← Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    const MAX_FILE_SIZE = 2 * 1024 * 1024; // 2MB in bytes
    const MAX_FILE_SIZE_MB = 2;

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    function validateFileSize(input, labelId, errorId) {
        const label = document.getElementById(labelId);
        const errorDiv = document.getElementById(errorId);
        const file = input.files[0];

        errorDiv.innerHTML = '';

        if (!file) return;

        const fileName = file.name;
        const fileSize = file.size;

        if (fileSize > MAX_FILE_SIZE) {
            const fileSizeMB = formatFileSize(fileSize);
            errorDiv.innerHTML = `
                <div class="p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="font-medium">Ukuran file terlalu besar!</p>
                        <p class="text-sm mt-1">Ukuran: ${fileSizeMB} (Maksimal: ${MAX_FILE_SIZE_MB}MB)</p>
                    </div>
                </div>
            `;
            input.value = '';
            return;
        }

        const labelContent = label.querySelector('div');
        labelContent.innerHTML = `
            <div class="text-center">
                <svg class="mx-auto h-10 w-10 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="mt-3 text-sm font-medium text-green-700">${fileName}</p>
                <p class="text-xs text-gray-500 mt-1">${formatFileSize(fileSize)}</p>
            </div>
        `;
    }

    document.getElementById('pengajuanForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        const spinner = document.getElementById('spinner');
        const btnText = document.getElementById('btnText');
        
        submitBtn.disabled = true;
        spinner.classList.remove('hidden');
        btnText.textContent = 'Menyimpan...';
    });
</script>
</x-app-layout>
