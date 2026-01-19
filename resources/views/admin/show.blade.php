<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Detail Pengajuan #{{ $pengajuan->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Header Status --}}
                <div class="flex justify-between items-center mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $pengajuan->nama_merek }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">Oleh: {{ $pengajuan->user->name }} ({{ $pengajuan->user->email }})</p>
                    </div>
                    @php
                        $statusBg = match($pengajuan->status) {
                            'Draft' => 'bg-yellow-100 text-yellow-800',
                            'Diajukan' => 'bg-blue-100 text-blue-800',
                            'Ditinjau' => 'bg-purple-100 text-purple-800',
                            'Disetujui' => 'bg-green-100 text-green-800',
                            'Ditolak' => 'bg-red-100 text-red-800',
                            default => 'bg-gray-100 text-gray-800'
                        };
                    @endphp
                    <span class="px-4 py-2 rounded-full font-bold text-sm {{ $statusBg }}">
                        {{ $pengajuan->status }}
                    </span>
                </div>

                {{-- Konten Detail --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis HKI</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $pengajuan->jenis }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pengajuan</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $pengajuan->created_at->format('d F Y') }}</p>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi Karya</label>
                        <p class="mt-1 text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 p-4 rounded-md">{{ $pengajuan->deskripsi_karya }}</p>
                    </div>
                </div>

                {{-- Area Bukti / File --}}
                <div class="mb-8">
                    <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Lampiran Dokumen</h4>
                    <div class="flex flex-wrap gap-4">
                        @if($pengajuan->file_logo)
                            <a href="{{ Storage::url($pengajuan->file_logo) }}" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 rounded-md hover:bg-blue-100 dark:hover:bg-blue-900/40 transition">
                                📄 Lihat Logo Merek
                            </a>
                        @else
                            <span class="text-red-500 dark:text-red-400 text-sm">Logo tidak diupload</span>
                        @endif

                        @if($pengajuan->file_ktp)
                            <a href="{{ Storage::url($pengajuan->file_ktp) }}" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 rounded-md hover:bg-blue-100 dark:hover:bg-blue-900/40 transition">
                                🪪 Lihat KTP Pemohon
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Form Aksi Admin --}}
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg border border-gray-200 dark:border-gray-600">
                    <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Verifikasi & Penerbitan Rekomendasi</h4>
                    
                    <form action="{{ route('admin.updateStatus', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        {{-- Jika status belum disetujui, tampilkan form approval --}}
                        @if($pengajuan->status != 'Disetujui')
                            
                            <div class="mb-6 bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded border border-yellow-200 dark:border-yellow-700">
                                <label class="block text-sm font-bold text-gray-900 dark:text-gray-100 mb-2">1. Upload Surat Rekomendasi (PDF)</label>
                                <input type="file" name="file_surat_rekomendasi" accept=".pdf" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-900/30 file:text-blue-700 dark:file:text-blue-300 hover:file:bg-blue-100 dark:hover:file:bg-blue-900/50 mb-2">
                                <p class="text-xs text-gray-600 dark:text-gray-400">Silakan buat surat rekomendasi offline, tanda tangan oleh Kepala Dinas, scan PDF, lalu upload di sini untuk dikirim ke User.</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">2. Catatan (Opsional)</label>
                                <textarea name="catatan_admin" rows="2" class="w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:border-indigo-500 focus:ring-indigo-500" placeholder="Contoh: Berkas lengkap, surat rekomendasi terlampir.">{{ $pengajuan->catatan_admin }}</textarea>
                            </div>

                            <div class="flex gap-3">
                                {{-- Tombol Setujui sekarang butuh file upload --}}
                                <button type="submit" name="status" value="Disetujui" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-md shadow transition flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Upload & Setujui
                                </button>
                                
                                {{-- Tombol Tolak tidak butuh file --}}
                                <button type="submit" name="status" value="Ditolak" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-md shadow transition flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                    Tolak
                                </button>
                            </div>

                        @else
                            {{-- Jika SUDAH disetujui, tampilkan info saja --}}
                            <div class="text-center p-4 bg-green-100 dark:bg-green-900/20 rounded text-green-800 dark:text-green-300 font-bold">
                                Pengajuan ini sudah disetujui dan Surat Rekomendasi sudah diterbitkan.
                            </div>
                            @if($pengajuan->file_surat_rekomendasi)
                                <div class="mt-4 text-center">
                                    <a href="{{ asset('storage/'.$pengajuan->file_surat_rekomendasi) }}" target="_blank" class="text-blue-600 dark:text-blue-400 underline hover:no-underline">Lihat File Surat Terupload</a>
                                </div>
                            @endif
                        @endif
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
