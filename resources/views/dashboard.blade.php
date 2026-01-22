<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight">
            {{ __('Dashboard Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- NOTIFIKASI --}}
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded shadow-sm">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            {{-- BAGIAN 1: PILIHAN PENGAJUAN (Requirement Pimpinan) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                
                {{-- Opsi 1: Fasilitasi --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 {{ $kuotaPenuh ? 'border-gray-200 bg-gray-50' : 'border-blue-200' }} p-6 relative">
                    <div class="absolute top-4 right-4">
                        @if($kuotaPenuh)
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold border border-red-200">Kuota Penuh 🔒</span>
                        @else
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">Sisa Kuota: {{ $sisaKuota }}</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-2xl">🎁</span>
                        <h3 class="text-lg font-bold text-gray-900">Program Fasilitasi (Gratis)</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4 h-10">
                        Biaya pendaftaran ditanggung Dinas. Dampingan penuh hingga sertifikat terbit. (Terbatas 50 kuota).
                    </p>
                    @if($kuotaPenuh)
                        <button disabled class="w-full py-2 bg-gray-300 text-gray-500 rounded-md font-bold cursor-not-allowed">Pendaftaran Ditutup</button>
                    @else
                        <a href="{{ route('pengajuan.create', ['kategori' => 'Fasilitasi']) }}" class="block w-full text-center py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-bold transition shadow-sm">
                            Daftar Fasilitasi
                        </a>
                    @endif
                </div>

                {{-- Opsi 2: Mandiri --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 border-indigo-100 p-6 relative">
                    <div class="absolute top-4 right-4">
                        <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full text-xs font-bold border border-indigo-100">Selalu Buka</span>
                    </div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-2xl">📄</span>
                        <h3 class="text-lg font-bold text-gray-900">Surat Rekomendasi</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4 h-10">
                        Dapatkan surat rekomendasi Dinas untuk pengurangan biaya pendaftaran HKI secara mandiri.
                    </p>
                    <a href="{{ route('pengajuan.create', ['kategori' => 'Mandiri']) }}" class="block w-full text-center py-2 bg-white border border-indigo-600 text-indigo-700 hover:bg-indigo-50 rounded-md font-bold transition shadow-sm">
                        Ajukan Surat Rekomendasi
                    </a>
                </div>
            </div>

            {{-- BAGIAN 2: TABEL RIWAYAT (Desain Lama Kembali) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Riwayat Pengajuan HKI</h3>

                    @if($pengajuans->isEmpty())
                        <div class="text-center py-10">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4 text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <p class="text-gray-500">Belum ada riwayat pengajuan.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
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
                                                <span class="px-2 py-1 text-xs font-bold rounded {{ $item->kategori == 'Fasilitasi' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600' }}">
                                                    {{ $item->kategori }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-900">{{ $item->nama_merek }}</div>
                                                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded">{{ $item->jenis }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                @php
                                                    $statusColor = match($item->status) {
                                                        'Disetujui' => 'bg-green-100 text-green-800',
                                                        'Ditolak' => 'bg-red-100 text-red-800',
                                                        'Diajukan' => 'bg-blue-100 text-blue-800',
                                                        default => 'bg-yellow-100 text-yellow-800',
                                                    };
                                                @endphp
                                                <span class="px-2 py-1 text-xs font-bold rounded-full {{ $statusColor }}">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <a href="{{ route('pengajuan.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold bg-indigo-50 px-3 py-1 rounded border border-indigo-100">
                                                    Lihat Detail
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