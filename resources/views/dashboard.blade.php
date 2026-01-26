<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight">
            {{ __('Dashboard Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- HERO SECTION (Sapaan User) --}}
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 mb-8 relative overflow-hidden shadow-lg">
                {{-- Background Pattern --}}
                <div class="absolute inset-0" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px; opacity: 0.15;"></div>
                
                {{-- Decorations --}}
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute right-10 bottom-[-40px] w-32 h-32 bg-indigo-400 opacity-20 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-2 bg-green-300 rounded-full animate-pulse"></span>
                            <span class="text-blue-100 text-xs font-bold uppercase tracking-widest">Portal HKI Resmi</span>
                        </div>
                        <h1 class="text-4xl font-black text-white tracking-tight mb-3">
                            Halo, {{ Auth::user()->name }}.
                        </h1>
                        <p class="text-blue-100 text-lg max-w-2xl font-light leading-relaxed">
                            Selamat datang. Mari lindungi aset intelektual dan karya kreatif Anda sekarang untuk masa depan usaha yang lebih aman.
                        </p>
                    </div>
                    
                    {{-- Unique Icon Block --}}
                    <div class="hidden md:block">
                        <div class="bg-white/10 p-4 rounded-xl shadow-lg transform rotate-3 backdrop-blur-sm flex items-center justify-center border border-white/20">
                             <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- STATISTIK RINGKAS (User Dashboard Specific) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                
                {{-- Stat 1: Global Impact (Data Komunitas) --}}
                <div class="bg-white rounded-xl p-6 border border-blue-100 shadow-sm flex items-center gap-5 hover:shadow-md transition">
                    <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Total Ekraf Terfasilitasi</p>
                        <h4 class="text-3xl font-black text-gray-900">{{ $totalFasilitasiGlobal }}</h4>
                        <p class="text-xs text-blue-600 font-medium mt-1">Pelaku usaha se-Kepri</p>
                    </div>
                </div>

                {{-- Stat 2: User Submission (Data Pribadi) --}}
                <div class="bg-white rounded-xl p-6 border border-indigo-100 shadow-sm flex items-center gap-5 hover:shadow-md transition">
                    <div class="w-14 h-14 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Pengajuan Saya</p>
                        <h4 class="text-3xl font-black text-gray-900">{{ $pengajuans->count() }}</h4>
                        <p class="text-xs text-indigo-600 font-medium mt-1">Total didaftarkan</p>
                    </div>
                </div>

                {{-- Stat 3: Success (Data Pribadi) --}}
                <div class="bg-white rounded-xl p-6 border border-green-100 shadow-sm flex items-center gap-5 hover:shadow-md transition">
                    <div class="w-14 h-14 rounded-full bg-green-50 text-green-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Berhasil Disetujui</p>
                        <h4 class="text-3xl font-black text-gray-900">{{ $pengajuans->where('status', 'Disetujui')->count() }}</h4>
                        <p class="text-xs text-green-600 font-medium mt-1">Sertifikat / Rekomendasi</p>
                    </div>
                </div>

            </div>

            {{-- NOTIFIKASI --}}
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-8 rounded-r-lg shadow-sm flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="font-bold text-sm">Berhasil!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- BAGIAN 1: PILIHAN PENGAJUAN --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                
                {{-- Opsi 1: Fasilitasi (Gratis) --}}
                <div class="group bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col relative overflow-hidden">
                    {{-- Background Decoration --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-8 -mt-8 z-0 transition-transform group-hover:scale-110"></div>

                    <div class="relative z-10 flex flex-col h-full">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl shadow-sm">
                                🎁
                            </div>
                            {{-- Status Badge --}}
                            @if($kuotaPenuh)
                                <span class="bg-red-50 text-red-600 border border-red-100 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide flex items-center gap-1">
                                    <span class="w-2 h-2 bg-red-500 rounded-full"></span> Penuh
                                </span>
                            @else
                                <span class="bg-blue-50 text-blue-600 border border-blue-100 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide flex items-center gap-1">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span> Sisa Kuota: {{ $sisaKuota }}
                                </span>
                            @endif
                        </div>

                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                            Program Fasilitasi
                        </h3>
                        
                        <p class="text-gray-500 text-sm leading-relaxed mb-8 flex-grow">
                            Layanan pendaftaran HKI <strong>gratis (0 Rupiah)</strong>. Biaya ditanggung penuh oleh Dinas dengan pendampingan intensif hingga sertifikat terbit.
                        </p>

                        @if($kuotaPenuh)
                            <button disabled class="w-full py-3 bg-gray-100 text-gray-400 rounded-xl font-bold cursor-not-allowed border border-gray-200 flex justify-center items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Pendaftaran Ditutup
                            </button>
                        @else
                            <a href="{{ route('pengajuan.create', ['kategori' => 'Fasilitasi']) }}" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold shadow-md hover:shadow-lg transition-all flex justify-center items-center gap-2 group-hover:gap-3">
                                Daftar Gratis
                                <svg class="w-5 h-5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Opsi 2: Mandiri (Rekomendasi) --}}
                <div class="group bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col relative overflow-hidden">
                    {{-- Background Decoration --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-bl-full -mr-8 -mt-8 z-0 transition-transform group-hover:scale-110"></div>

                    <div class="relative z-10 flex flex-col h-full">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-3xl shadow-sm">
                                📄
                            </div>
                            <span class="bg-indigo-50 text-indigo-600 border border-indigo-100 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide flex items-center gap-1">
                                <span class="w-2 h-2 bg-indigo-500 rounded-full"></span> Selalu Buka
                            </span>
                        </div>

                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-indigo-600 transition-colors">
                            Surat Rekomendasi
                        </h3>
                        
                        <p class="text-gray-500 text-sm leading-relaxed mb-8 flex-grow">
                            Ajukan surat rekomendasi resmi dari Dinas untuk mendapatkan <strong>potongan biaya</strong> saat mendaftar HKI secara mandiri ke DJKI.
                        </p>

                        <a href="{{ route('pengajuan.create', ['kategori' => 'Mandiri']) }}" class="w-full py-3 bg-white border-2 border-indigo-600 text-indigo-700 hover:bg-indigo-50 rounded-xl font-bold transition-all flex justify-center items-center gap-2 group-hover:gap-3">
                            Ajukan Surat
                            <svg class="w-5 h-5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- BAGIAN 2: TABEL RIWAYAT --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Riwayat Pengajuan HKI
                        </h3>
                    </div>

                    @if($pengajuans->isEmpty())
                        <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4 text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h4 class="text-gray-900 font-bold mb-1">Belum ada riwayat pengajuan</h4>
                            <p class="text-gray-500 text-sm">Silakan pilih layanan di atas untuk memulai.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto rounded-lg border border-gray-200">
                            <table class="w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Jalur</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Merek / Ciptaan</th>
                                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($pengajuans as $item)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $item->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-bold rounded {{ $item->kategori == 'Fasilitasi' ? 'bg-blue-100 text-blue-700' : 'bg-indigo-100 text-indigo-700' }}">
                                                    {{ $item->kategori }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-900">{{ $item->nama_merek }}</div>
                                                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded border border-gray-200">{{ $item->jenis }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                @php
                                                    $statusColor = match($item->status) {
                                                        'Disetujui' => 'bg-green-100 text-green-800 border border-green-200',
                                                        'Ditolak' => 'bg-red-100 text-red-800 border border-red-200',
                                                        'Diajukan' => 'bg-blue-100 text-blue-800 border border-blue-200',
                                                        default => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                                    };
                                                @endphp
                                                <span class="px-3 py-1 text-xs font-bold rounded-full {{ $statusColor }}">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <a href="{{ route('pengajuan.show', $item->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-900 font-bold bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition">
                                                    Lihat Detail
                                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>