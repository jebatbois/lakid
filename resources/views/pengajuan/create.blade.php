<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 leading-tight">
                {{ __('Buat Pengajuan Baru') }}
            </h2>
            {{-- Penanda Visual Agar User Tahu Sedang di Jalur Apa --}}
            <div class="px-4 py-1 rounded-full text-sm font-bold border {{ $kategori == 'Fasilitasi' ? 'bg-blue-100 text-blue-800 border-blue-200' : 'bg-indigo-100 text-indigo-800 border-indigo-200' }}">
                Jalur: {{ $kategori }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-8">
                
                {{-- 1. NOTIFIKASI ERROR --}}
                @if ($errors->any())
                    <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm" role="alert">
                        <div class="flex items-center mb-2">
                            <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <h3 class="font-bold text-red-800 text-lg">Gagal Menyimpan Pengajuan</h3>
                        </div>
                        <p class="text-red-700 mb-2">Mohon maaf, terdapat kesalahan pada isian Anda:</p>
                        <ul class="list-disc pl-8 text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- START FORM --}}
                <form action="{{ route('pengajuan.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data"
                      x-data="{ 
                          jenis: '{{ old('jenis', 'Merek') }}', 
                          submitting: false 
                      }" 
                      @submit="submitting = true">
                      
                      {{-- INPUT HIDDEN KATEGORI (WAJIB ADA) --}}
                      <input type="hidden" name="kategori" value="{{ $kategori }}">
                      
                    @csrf
    
    {{-- INPUT HIDDEN INI WAJIB ADA AGAR TIDAK SELALU MANDIRI --}}
    <input type="hidden" name="kategori" value="{{ $kategori }}">
    
    {{-- Penanda Visual di Form (Biar user yakin) --}}
    <div class="mb-6 p-4 rounded-lg border {{ $kategori == 'Fasilitasi' ? 'bg-blue-100 border-blue-200 text-blue-800' : 'bg-indigo-100 border-indigo-200 text-indigo-800' }}">
        <strong>Jalur Pendaftaran:</strong> {{ $kategori }}
        <span class="text-xs block mt-1">
            {{ $kategori == 'Fasilitasi' ? 'Biaya ditanggung Dinas (Gratis).' : 'Biaya Mandiri dengan Surat Rekomendasi.' }}
        </span>
    </div>

                    {{-- JENIS LAYANAN --}}
                    <div class="mb-8">
                        <label class="block text-gray-800 text-sm font-bold mb-3">Pilih Jenis Layanan HKI</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="cursor-pointer group">
                                <input type="radio" name="jenis" value="Merek" x-model="jenis" class="peer sr-only">
                                <div class="rounded-xl border-2 border-gray-200 p-4 hover:border-blue-400 peer-checked:border-blue-600 peer-checked:bg-blue-50 transition text-center h-full">
                                    <span class="block text-2xl mb-1">®</span>
                                    <span class="block font-bold text-gray-700 peer-checked:text-blue-800">Merek</span>
                                    <span class="text-xs text-gray-500">Logo, Brand, Nama Usaha</span>
                                </div>
                            </label>

                            <label class="cursor-pointer group">
                                <input type="radio" name="jenis" value="Hak Cipta" x-model="jenis" class="peer sr-only">
                                <div class="rounded-xl border-2 border-gray-200 p-4 hover:border-yellow-400 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 transition text-center h-full">
                                    <span class="block text-2xl mb-1">©</span>
                                    <span class="block font-bold text-gray-700 peer-checked:text-yellow-800">Hak Cipta</span>
                                    <span class="text-xs text-gray-500">Lagu, Buku, Film, Seni</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- DETAIL KHUSUS MEREK --}}
                    <div x-show="jenis === 'Merek'" x-transition class="bg-blue-50 p-6 rounded-xl border border-blue-100 mb-8 space-y-5">
                        <h3 class="font-bold text-blue-800 text-sm uppercase border-b border-blue-200 pb-2">Detail Merek</h3>
                        
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Merek / Brand <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_merek" value="{{ old('nama_merek') }}" 
                                   class="shadow-sm border-gray-300 rounded-md w-full focus:border-blue-500 focus:ring-blue-500" 
                                   placeholder="Contoh: Kripik Pedas Mak Ijah">
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Upload Logo (Etiket Merek) <span class="text-red-500">*</span></label>
                            <input type="file" name="file_logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer">
                            <p class="text-xs text-blue-600 mt-2 font-medium bg-blue-100/50 inline-block px-2 py-1 rounded">
                                ℹ️ Syarat: Format JPG/PNG. Maksimal 2 MB.
                            </p>
                        </div>
                    </div>

                    {{-- DETAIL KHUSUS HAK CIPTA --}}
                    <div x-show="jenis === 'Hak Cipta'" x-transition class="bg-yellow-50 p-6 rounded-xl border border-yellow-100 mb-8 space-y-5" style="display: none;">
                        <h3 class="font-bold text-yellow-800 text-sm uppercase border-b border-yellow-200 pb-2">Detail Ciptaan</h3>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Judul Ciptaan <span class="text-red-500">*</span></label>
                            <input type="text" name="judul_ciptaan" value="{{ old('judul_ciptaan') }}" 
                                   class="shadow-sm border-gray-300 rounded-md w-full focus:border-yellow-500 focus:ring-yellow-500" 
                                   placeholder="Contoh: Lagu 'Semangat Pagi', Buku 'Sejarah Melayu'">
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Upload File Ciptaan (Sampel) <span class="text-red-500">*</span></label>
                            <input type="file" name="file_karya" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-100 file:text-yellow-700 hover:file:bg-yellow-200 cursor-pointer">
                            <p class="text-xs text-yellow-700 mt-2 font-medium bg-yellow-100/50 inline-block px-2 py-1 rounded">
                                ℹ️ Syarat: Format MP3/PDF/MP4. Maksimal 20 MB.
                            </p>
                        </div>
                    </div>

                    {{-- DOKUMEN KELENGKAPAN (DINAMIS) --}}
                    <div class="space-y-6 border-t-2 border-dashed border-gray-200 pt-6 mt-6">
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                            <h3 class="font-bold text-gray-900 text-sm uppercase mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <span x-text="jenis === 'Merek' ? 'Dokumen Kelengkapan Usaha' : 'Dokumen Kelengkapan Pencipta'"></span>
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Scan/Foto KTP Pemohon <span class="text-red-500">*</span></label>
                                    <input type="file" name="file_ktp" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 cursor-pointer" required>
                                    <p class="text-[11px] text-gray-500 mt-1">Format: JPG/PDF. Maks: 2 MB.</p>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Scan/Foto NPWP <span class="text-red-500">*</span></label>
                                    <input type="file" name="file_npwp" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 cursor-pointer" required>
                                    <p class="text-[11px] text-gray-500 mt-1">Format: JPG/PDF. Maks: 2 MB.</p>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Surat Permohonan Rekomendasi <span class="text-red-500">*</span></label>
                                    <input type="file" name="file_surat_permohonan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 cursor-pointer" required>
                                    <p class="text-[11px] text-gray-500 mt-1">Format: PDF/JPG. Maks: 2 MB.</p>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        <span x-text="jenis === 'Merek' ? 'CV / Profil Perusahaan' : 'CV / Portofolio Pencipta'"></span> <span class="text-red-500">*</span>
                                    </label>
                                    <input type="file" name="file_cv" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 cursor-pointer" required>
                                    <p class="text-[11px] text-gray-500 mt-1">Format: PDF. Maks: 5 MB.</p>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        <span x-text="jenis === 'Merek' ? 'Surat Pernyataan UMK' : 'Surat Pernyataan Keaslian Karya'"></span> <span class="text-red-500">*</span>
                                    </label>
                                    <input type="file" name="file_surat_umk" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 cursor-pointer" required>
                                    <p class="text-[11px] text-gray-500 mt-1">Bermaterai Rp10.000. Maks: 2 MB.</p>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        <span x-text="jenis === 'Merek' ? 'Foto Produk / Tempat Usaha' : 'Cover / Foto Dokumentasi Karya'"></span> <span class="text-red-500">*</span>
                                    </label>
                                    <input type="file" name="file_foto_produk" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 cursor-pointer" required>
                                    <p class="text-[11px] text-gray-500 mt-1">Format: JPG/PNG. Maks: 5 MB.</p>
                                </div>

                            </div>
                            
                            {{-- Deskripsi (Wajib) --}}
                            <div class="mt-8">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    <span x-text="jenis === 'Merek' ? 'Deskripsi Singkat Usaha' : 'Sinopsis / Deskripsi Ciptaan'"></span> <span class="text-red-500">*</span>
                                </label>
                                <textarea name="deskripsi_karya" rows="4" class="shadow-sm border-gray-300 rounded-md w-full focus:border-blue-500 focus:ring-blue-500" required :placeholder="jenis === 'Merek' ? 'Jelaskan produk apa yang Anda jual, bahan baku, dan keunggulan...' : 'Jelaskan cerita singkat, makna lagu, atau detail karya seni Anda...'"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- TOMBOL AKSI --}}
                    <div class="flex items-center justify-end mt-8 gap-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 font-bold text-sm">Batal</a>
                        
                        <button type="submit" 
                                :disabled="submitting"
                                :class="{ 'opacity-50 cursor-not-allowed': submitting }"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition flex items-center">
                            
                            {{-- Loading Spinner --}}
                            <svg x-show="submitting" style="display: none;" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            
                            <span x-text="submitting ? 'Mengirim Data...' : 'Kirim Pengajuan'"></span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>