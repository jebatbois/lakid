<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight">
            {{ __('Dashboard Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Notifikasi Sukses (Perbaikan Warna: Teks Hijau Tua agar terbaca) --}}
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded shadow-sm" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            {{-- Header Section & Tombol --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                {{-- Judul dipertebal dan dihitamkan --}}
                <h3 class="text-xl font-extrabold text-gray-900">Riwayat Pengajuan HKI</h3>
                
                <a href="{{ route('pengajuan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Pengajuan Baru
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    
                    @if($pengajuans->isEmpty())
                        {{-- Empty State --}}
                        <div class="text-center py-12">
                            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-50 mb-4">
                                <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Belum ada pengajuan</h3>
                            <p class="mt-2 text-gray-500 max-w-sm mx-auto">Mulai lindungi karya Anda dengan mendaftarkan HKI sekarang. Proses cepat dan mudah.</p>
                            <div class="mt-6">
                                <a href="{{ route('pengajuan.create') }}" class="text-blue-600 font-bold hover:underline">Mulai Pengajuan &rarr;</a>
                            </div>
                        </div>
                    @else
                        {{-- Tabel Data (Warna Header Abu Terang, Teks Abu Tua) --}}
                        <div class="overflow-x-auto">
                            <table class="w-full divide-y divide-gray-200 table-fixed">
                                <thead class="bg-gray-100"> {{-- Background Header Abu Terang --}}
                                    <tr>
                                        <th scope="col" class="w-1/6 px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th scope="col" class="w-auto px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Merek & Jenis
                                        </th>
                                        <th scope="col" class="w-1/6 px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="w-1/6 px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($pengajuans as $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $item->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $item->nama_merek }}</div>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-1 border border-blue-200">
                                                {{ $item->jenis }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @php
                                                $colors = [
                                                    'Draft' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                    'Diajukan' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                    'Ditinjau' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                                                    'Disetujui' => 'bg-green-100 text-green-800 border-green-200',
                                                    'Ditolak' => 'bg-red-100 text-red-800 border-red-200',
                                                ];
                                                $colorClass = $colors[$item->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                            @endphp
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full border {{ $colorClass }}">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="{{ route('pengajuan.show', $item->id) }}" class="inline-flex items-center text-indigo-700 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-4 py-2 rounded-md transition font-bold border border-indigo-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
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