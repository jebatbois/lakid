<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- 1. NOTIFIKASI SUKSES (Modern Style) --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="mb-8 bg-green-50 border border-green-200 rounded-xl p-4 flex items-start gap-3 shadow-sm relative">
                    <div class="text-green-500 bg-green-100 p-2 rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-green-800">Berhasil!</h4>
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" class="absolute top-4 right-4 text-green-400 hover:text-green-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </div>
            @endif

            {{-- 2. HERO SECTION (Sapaan & CTA Utama) --}}
            <div class="relative bg-gradient-to-r from-blue-700 to-indigo-800 rounded-3xl p-8 md:p-12 mb-10 text-white shadow-2xl overflow-hidden">
                
                {{-- Dekorasi Latar (Blur Blobs) --}}
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-white opacity-10 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 rounded-full bg-blue-400 opacity-20 blur-2xl"></div>

                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="max-w-2xl">
                        <div class="inline-block px-3 py-1 mb-4 border border-blue-400 rounded-full bg-blue-800/50 backdrop-blur-sm text-xs font-bold tracking-wide uppercase">
                            Fasilitasi HKI Dinas Pariwisata
                        </div>
                        <h1 class="text-3xl md:text-5xl font-extrabold mb-4 leading-tight">
                            Halo, {{ Auth::user()->name }}! 👋
                        </h1>
                        <p class="text-blue-100 text-lg leading-relaxed mb-6">
                            Langkah pertama melindungi karya kreatifmu dimulai di sini. Ajukan <strong>Surat Rekomendasi</strong> dari Dinas Pariwisata untuk mempermudah pendaftaran HKI ke Kemenkumham (DGIP).
                        </p>
                        
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('pengajuan.create') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-base font-bold rounded-xl text-blue-800 bg-white hover:bg-gray-50 hover:scale-105 transition transform shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Ajukan Surat Rekomendasi
                            </a>
                            <a href="{{ route('bantuan') }}" class="inline-flex items-center px-6 py-4 border border-white/30 text-base font-bold rounded-xl text-white hover:bg-white/10 transition backdrop-blur-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Panduan & Syarat
                            </a>
                        </div>
                    </div>

                    {{-- Ilustrasi Ikon Besar (Hiasan Kanan) --}}
                    <div class="hidden md:block opacity-90 transform hover:scale-110 transition duration-700">
                        <svg class="w-48 h-48 text-white/10" fill="currentColor" viewBox="0 0 24 24"><path d="M11.667 3.016a1.25 1.25 0 0 1 1.666 0l7.5 5.5a1.25 1.25 0 0 1 0 2.016l-1.926 1.413a48.563 48.563 0 0 0-1.206 12.055h-10.4c-.456-4.524-.87-8.529-1.206-12.055L4.167 10.532a1.25 1.25 0 0 1 0-2.016l7.5-5.5Z" /></svg>
                    </div>
                </div>
            </div>

            {{-- 3. INFO ALUR (Agar User Paham Fungsinya) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-start gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xl shrink-0">1</div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg">Upload Berkas</h4>
                        <p class="text-sm text-gray-500 mt-1">Lengkapi data usaha/karya dan dokumen pendukung di aplikasi LAKID ini.</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-start gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-full bg-yellow-50 text-yellow-600 flex items-center justify-center font-bold text-xl shrink-0">2</div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg">Verifikasi Dinas</h4>
                        <p class="text-sm text-gray-500 mt-1">Admin Dinas Pariwisata akan memverifikasi kelengkapan berkas Anda.</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-start gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-full bg-green-50 text-green-600 flex items-center justify-center font-bold text-xl shrink-0">3</div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg">Dapat Surat</h4>
                        <p class="text-sm text-gray-500 mt-1">Download surat rekomendasi, lalu daftar ke portal DGIP (Kemenkumham).</p>
                    </div>
                </div>
            </div>

            {{-- 4. RIWAYAT PENGAJUAN (CARD STYLE) --}}
            <div class="flex items-center justify-between mb-6 px-2">
                <h3 class="text-2xl font-bold text-gray-800">Riwayat Permohonan</h3>
                @if($pengajuans->isNotEmpty())
                    <span class="text-sm bg-gray-100 text-gray-600 px-3 py-1 rounded-full font-bold">{{ $pengajuans->count() }} Berkas</span>
                @endif
            </div>

            @if($pengajuans->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($pengajuans as $item)
                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 relative overflow-hidden group">
                            
                            {{-- Strip Warna Status di Kiri --}}
                            @php
                                $statusColor = match($item->status) {
                                    'Disetujui' => 'bg-green-500',
                                    'Ditolak' => 'bg-red-500',
                                    'Ditinjau' => 'bg-indigo-500',
                                    default => 'bg-yellow-400',
                                };
                                $statusText = match($item->status) {
                                    'Disetujui' => 'text-green-600 bg-green-50',
                                    'Ditolak' => 'text-red-600 bg-red-50',
                                    'Ditinjau' => 'text-indigo-600 bg-indigo-50',
                                    default => 'text-yellow-600 bg-yellow-50',
                                };
                            @endphp
                            <div class="absolute left-0 top-0 bottom-0 w-2 {{ $statusColor }}"></div>

                            {{-- Header Kartu --}}
                            <div class="flex justify-between items-start mb-4 pl-3">
                                <div>
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold mb-2 {{ $item->jenis == 'Merek' ? 'bg-blue-50 text-blue-600' : 'bg-orange-50 text-orange-600' }}">
                                        {{ $item->jenis == 'Merek' ? '® Merek' : '© Hak Cipta' }}
                                    </span>
                                    <div class="text-xs text-gray-400 font-medium">
                                        {{ $item->created_at->format('d M Y') }}
                                    </div>
                                </div>
                                {{-- Ikon Status Bulat --}}
                                <div class="w-10 h-10 rounded-full flex items-center justify-center {{ str_replace('bg-', 'bg-opacity-20 text-', $statusColor) }} {{ str_replace('bg-', 'bg-', $statusColor) }}">
                                    @if($item->status == 'Disetujui') <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    @elseif($item->status == 'Ditolak') <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    @else <svg class="w-5 h-5 text-white animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @endif
                                </div>
                            </div>

                            {{-- Isi Kartu --}}
                            <div class="pl-3 mb-6 min-h-[80px]">
                                <h4 class="text-xl font-extrabold text-gray-900 mb-1 truncate">{{ $item->nama_merek }}</h4>
                                <p class="text-sm text-gray-500 line-clamp-2">{{ $item->deskripsi_karya }}</p>
                            </div>

                            {{-- Footer Kartu --}}
                            <div class="pl-3 mt-auto pt-4 border-t border-gray-50 flex justify-between items-center">
                                <span class="text-xs font-bold px-2 py-1 rounded {{ $statusText }}">
                                    {{ $item->status }}
                                </span>
                                <a href="{{ route('pengajuan.show', $item->id) }}" class="text-gray-400 hover:text-blue-600 font-bold text-sm flex items-center gap-1 group-hover:translate-x-1 transition">
                                    Cek Detail <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- EMPTY STATE (Jika Belum Ada Pengajuan) --}}
                <div class="bg-white rounded-3xl p-12 text-center border-2 border-dashed border-gray-200">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-50 mb-6 animate-bounce">
                        <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Belum ada permohonan rekomendasi.</h3>
                    <p class="text-gray-500 mt-2 mb-8 max-w-md mx-auto">Dapatkan surat rekomendasi dari Dinas Pariwisata untuk memuluskan langkah pendaftaran HKI Anda.</p>
                    <a href="{{ route('pengajuan.create') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-bold rounded-full text-white bg-blue-600 hover:bg-blue-700 shadow-lg transition transform hover:-translate-y-1">
                        Buat Permohonan Baru
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>