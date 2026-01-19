<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight">
            {{ __('Detail Pengajuan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Tombol Kembali --}}
            <div class="mb-4">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 font-medium transition">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-8">
                    
                    {{-- Header: Judul & Status --}}
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-gray-100 pb-6 mb-6 gap-4">
                        <div>
                            <h1 class="text-3xl font-extrabold text-gray-900">{{ $pengajuan->nama_merek }}</h1>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded border border-blue-200">{{ $pengajuan->jenis }}</span>
                                <span class="text-gray-500 text-sm">Oleh: <strong class="text-gray-700">{{ $pengajuan->user->name }}</strong> ({{ $pengajuan->user->email }})</span>
                            </div>
                        </div>
                        
                        {{-- Status Badge --}}
                        <div class="flex flex-col items-end">
                            <span class="text-xs text-gray-500 uppercase tracking-wide font-bold mb-1">Status Saat Ini</span>
                            @php
                                $colors = [
                                    'Draft' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    'Diajukan' => 'bg-blue-100 text-blue-800 border-blue-200',
                                    'Disetujui' => 'bg-green-100 text-green-800 border-green-200',
                                    'Ditolak' => 'bg-red-100 text-red-800 border-red-200',
                                ];
                                $colorClass = $colors[$pengajuan->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-4 py-1 rounded-full text-sm font-bold border {{ $colorClass }}">
                                {{ $pengajuan->status }}
                            </span>
                        </div>
                    </div>

                    {{-- Grid Informasi Utama --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                        <div class="md:col-span-2">
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Deskripsi Karya/Merek</h3>
                            <div class="bg-gray-50 rounded-lg p-4 text-gray-800 border border-gray-200 leading-relaxed">
                                {{ $pengajuan->deskripsi_karya }}
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Tanggal Pengajuan</h3>
                            <p class="text-lg font-medium text-gray-900">{{ $pengajuan->created_at->format('d F Y') }}</p>
                            <p class="text-sm text-gray-500">{{ $pengajuan->created_at->format('H:i') }} WIB</p>
                        </div>
                    </div>

                    {{-- Section Dokumen --}}
                    <div class="mb-10">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                            Berkas Lampiran User
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            
                            {{-- Card File Logo --}}
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                <span class="block text-xs font-bold text-gray-500 uppercase mb-2">Logo Merek</span>
                                @if($pengajuan->file_logo)
                                    <div class="mb-3 h-32 bg-gray-100 rounded overflow-hidden flex items-center justify-center border">
                                        <img src="{{ asset('storage/'.$pengajuan->file_logo) }}" class="h-full w-full object-contain">
                                    </div>
                                    <a href="{{ asset('storage/'.$pengajuan->file_logo) }}" target="_blank" class="text-blue-600 text-sm font-bold hover:underline flex items-center justify-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Lihat Logo
                                    </a>
                                @else
                                    <span class="text-red-500 text-sm italic">Tidak ada file</span>
                                @endif
                            </div>

                            {{-- Card File KTP --}}
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                <span class="block text-xs font-bold text-gray-500 uppercase mb-2">KTP Pemohon</span>
                                <div class="mb-3 h-32 bg-gray-100 rounded flex items-center justify-center border text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                </div>
                                @if($pengajuan->file_ktp)
                                    <a href="{{ asset('storage/'.$pengajuan->file_ktp) }}" target="_blank" class="text-blue-600 text-sm font-bold hover:underline flex items-center justify-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        Download/Lihat KTP
                                    </a>
                                @else
                                    <span class="text-red-500 text-sm italic">Tidak ada file</span>
                                @endif
                            </div>

                             {{-- Card File Surat UMK (Jika ada di migrasi) --}}
                             <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                <span class="block text-xs font-bold text-gray-500 uppercase mb-2">Surat Pernyataan UMK</span>
                                <div class="mb-3 h-32 bg-gray-100 rounded flex items-center justify-center border text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                @if(!empty($pengajuan->file_surat_umk))
                                    <a href="{{ asset('storage/'.$pengajuan->file_surat_umk) }}" target="_blank" class="text-blue-600 text-sm font-bold hover:underline flex items-center justify-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        Lihat Surat UMK
                                    </a>
                                @else
                                    <span class="text-red-500 text-sm italic text-center block">Tidak ada file</span>
                                @endif
                            </div>

                        </div>
                    </div>

                    {{-- FORM VERIFIKASI ADMIN (Area Kerja) --}}
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span class="w-6 h-6 bg-gray-800 text-white rounded-full flex items-center justify-center text-xs">🛠</span>
                            Panel Verifikasi Dinas
                        </h4>
                        
                        <form id="adminVerifyForm" action="{{ route('admin.updateStatus', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            
                            {{-- Jika status belum final, tampilkan form --}}
                            @if($pengajuan->status != 'Disetujui')
                                
                                {{-- Area Upload Surat Rekomendasi (Penting) --}}
                                <div class="mb-6 bg-white p-4 rounded-lg border border-blue-200 shadow-sm">
                                    <label class="block text-sm font-bold text-gray-900 mb-2">
                                        1. Upload Surat Rekomendasi (PDF) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="file" name="file_surat_rekomendasi" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded cursor-pointer">
                                    <p class="text-xs text-gray-500 mt-2">
                                        <span class="font-bold text-blue-600">Instruksi:</span> Buat surat rekomendasi offline, tanda tangan Kepala Dinas, scan menjadi PDF, lalu upload di sini.
                                    </p>
                                </div>
                    
                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">2. Catatan untuk Pemohon (Opsional)</label>
                                    <textarea name="catatan_admin" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-900" placeholder="Contoh: Berkas lengkap. Surat rekomendasi telah diterbitkan.">{{ $pengajuan->catatan_admin }}</textarea>
                                </div>
                    
                                <div class="flex gap-4 border-t pt-4">
                                    <button type="submit" name="status" value="Disetujui" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow transition flex justify-center items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Upload & Setujui
                                    </button>
                                    
                                    <button type="submit" name="status" value="Ditolak" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg shadow transition flex justify-center items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Tolak Pengajuan
                                    </button>
                                </div>
                    
                            @else
                                {{-- Jika SUDAH disetujui --}}
                                <div class="text-center p-6 bg-green-50 rounded-lg border border-green-200">
                                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-green-800">Pengajuan Selesai & Disetujui</h3>
                                    <p class="text-green-700 mb-4">Surat rekomendasi telah diterbitkan dan dikirim ke pemohon.</p>
                                    
                                    @if($pengajuan->file_surat_rekomendasi)
                                        <a href="{{ asset('storage/'.$pengajuan->file_surat_rekomendasi) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white border border-green-300 rounded-md font-semibold text-green-700 hover:bg-green-50 shadow-sm transition">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Cek File Surat Terupload
                                        </a>
                                    @endif
                                    
                                    {{-- Tombol Edit Ulang (Jaga-jaga kalau salah upload) --}}
                                    <div class="mt-6 pt-4 border-t border-green-200">
                                        <p class="text-xs text-gray-500 mb-2">Perlu merevisi status atau file?</p>
                                        <button type="submit" name="status" value="Ditinjau" class="text-sm text-gray-500 hover:text-gray-700 underline">
                                            Kembalikan ke status "Ditinjau"
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Handle loading state for admin verify form
    (function(){
        const form = document.getElementById('adminVerifyForm');
        if (!form) return;

        let lastClicked = null;

        // remember which submit button was clicked
        form.querySelectorAll('button[type="submit"]').forEach(btn => {
            btn.addEventListener('click', function(e){
                lastClicked = this;
            });
        });

        form.addEventListener('submit', function(e){
            // disable all submit buttons to avoid double submit
            form.querySelectorAll('button[type="submit"]').forEach(b => b.disabled = true);

            if (lastClicked) {
                // show simple spinner and change text
                const spinner = document.createElement('svg');
                spinner.setAttribute('class', 'animate-spin -ml-1 mr-2 h-5 w-5 text-white');
                spinner.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                spinner.setAttribute('fill', 'none');
                spinner.setAttribute('viewBox', '0 0 24 24');
                spinner.innerHTML = '<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>';

                // prepend spinner and set text
                lastClicked.prepend(spinner);
                // if button has text nodes, replace with 'Menyimpan...'
                lastClicked._oldText = lastClicked.innerText;
                lastClicked.querySelectorAll('span, svg:not(.animate-spin)').forEach(n => n.style.display = 'none');
                lastClicked.appendChild(document.createTextNode('Menyimpan...'));
            }
        });
    })();
</script>