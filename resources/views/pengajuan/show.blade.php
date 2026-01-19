<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
                {{ __('Detail Pengajuan') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Success Alert & Download Surat Rekomendasi --}}
            @if($pengajuan->status == 'Disetujui')
                <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-6 mb-6 rounded shadow-sm">
                    <h3 class="font-bold text-lg mb-2">✅ Selamat! Pengajuan Anda Disetujui</h3>
                    <p class="mb-4 text-sm">Silakan unduh surat rekomendasi di bawah ini untuk digunakan saat pendaftaran HKI di Kemenkumham.</p>
                    
                    @if($pengajuan->file_surat_rekomendasi)
                        <a href="{{ asset('storage/'.$pengajuan->file_surat_rekomendasi) }}" download class="inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            📥 DOWNLOAD SURAT REKOMENDASI DINAS
                        </a>
                    @else
                        <p class="text-sm text-red-600 font-semibold">⚠️ File surat belum diupload. Hubungi Dinas LAKID Kepri.</p>
                    @endif
                </div>
            @endif

            {{-- Status Alert --}}
            @php
                $statusConfig = [
                    'Draft' => ['bg' => 'bg-yellow-50', 'border' => 'border-yellow-500', 'text' => 'text-yellow-800', 'icon' => '📝'],
                    'Diajukan' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-500', 'text' => 'text-blue-800', 'icon' => '⏳'],
                    'Ditinjau' => ['bg' => 'bg-purple-50', 'border' => 'border-purple-500', 'text' => 'text-purple-800', 'icon' => '🔍'],
                    'Disetujui' => ['bg' => 'bg-green-50', 'border' => 'border-green-500', 'text' => 'text-green-800', 'icon' => '✅'],
                    'Ditolak' => ['bg' => 'bg-red-50', 'border' => 'border-red-500', 'text' => 'text-red-800', 'icon' => '❌'],
                ];
                $config = $statusConfig[$pengajuan->status] ?? ['bg' => 'bg-gray-50', 'border' => 'border-gray-500', 'text' => 'text-gray-800', 'icon' => '❓'];
            @endphp
            <div class="mb-6 p-6 {{ $config['bg'] }} border-l-4 {{ $config['border'] }} rounded {{ $config['text'] }} shadow-sm">
                <div class="font-bold text-lg mb-2">{{ $config['icon'] }} Status: {{ $pengajuan->status }}</div>
                <div class="text-sm opacity-90">Tanggal Pengajuan: {{ $pengajuan->created_at->format('d M Y H:i') }}</div>
                @if($pengajuan->catatan_admin)
                    <div class="mt-4 pt-4 border-t {{ $config['border'] }} opacity-75">
                        <div class="font-semibold mb-2">💬 Catatan dari Dinas:</div>
                        <p class="text-sm">{{ $pengajuan->catatan_admin }}</p>
                    </div>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-8 space-y-8">
                {{-- Merek Info --}}
                <div class="border-t-2 border-slate-200 pt-6 first:border-t-0 first:pt-0">
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $pengajuan->nama_merek }}</h3>
                    <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full">
                        {{ $pengajuan->jenis }}
                    </span>
                </div>

                {{-- Deskripsi --}}
                <div class="border-t-2 border-slate-200 pt-6">
                    <h4 class="text-lg font-bold text-gray-900 mb-3">📝 Deskripsi Karya</h4>
                    <p class="text-gray-700 bg-slate-50 p-4 rounded-lg leading-relaxed">
                        {{ $pengajuan->deskripsi_karya }}
                    </p>
                </div>

                {{-- Files --}}
                @if($pengajuan->file_logo || $pengajuan->file_ktp || $pengajuan->file_surat_umk)
                    <div class="border-t-2 border-slate-200 pt-6">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">📎 Dokumen yang Diupload</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($pengajuan->file_logo)
                                <div class="border-2 border-blue-300 rounded-lg p-4 hover:shadow-md transition">
                                    <p class="text-sm font-semibold text-gray-700 mb-3">📷 Logo/Desain</p>
                                    <img src="{{ Storage::url($pengajuan->file_logo) }}" alt="Logo" class="max-w-full h-auto rounded-lg mb-3 border border-slate-200">
                                    <a href="{{ Storage::url($pengajuan->file_logo) }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3z"></path>
                                        </svg>
                                        📥 Download
                                    </a>
                                </div>
                            @endif

                            @if($pengajuan->file_ktp)
                                <div class="border-2 border-blue-300 rounded-lg p-4 hover:shadow-md transition">
                                    <p class="text-sm font-semibold text-gray-700 mb-3">🪪 KTP/Identitas</p>
                                    <img src="{{ Storage::url($pengajuan->file_ktp) }}" alt="KTP" class="max-w-full h-auto rounded-lg mb-3 border border-slate-200">
                                    <a href="{{ Storage::url($pengajuan->file_ktp) }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3z"></path>
                                        </svg>
                                        📥 Download
                                    </a>
                                </div>
                            @endif

                            @if($pengajuan->file_surat_umk)
                                <div class="border-2 border-green-300 rounded-lg p-4 hover:shadow-md transition">
                                    <p class="text-sm font-semibold text-gray-700 mb-3">📄 Surat UMK</p>
                                    <a href="{{ Storage::url($pengajuan->file_surat_umk) }}" target="_blank" class="inline-flex items-center text-green-600 hover:text-green-800 text-sm font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3z"></path>
                                        </svg>
                                        📥 Download
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- User Action Buttons --}}
                @if ($pengajuan->status === 'Draft')
                    <div class="border-t-2 border-slate-200 pt-6 flex gap-3 flex-wrap">
                        <form action="{{ route('pengajuan.submit', $pengajuan) }}" method="POST" class="flex-1 min-w-[200px]">
                            @csrf
                            <button type="submit" class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition shadow-sm hover:shadow flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                ✉️ Ajukan Sekarang
                            </button>
                        </form>
                        <a href="{{ route('pengajuan.edit', $pengajuan) }}" class="flex-1 min-w-[200px] px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-bold rounded-lg transition text-center shadow-sm hover:shadow flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                            ✏️ Edit
                        </a>
                        <form action="{{ route('pengajuan.destroy', $pengajuan) }}" method="POST" class="flex-1 min-w-[200px]" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition shadow-sm hover:shadow flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
