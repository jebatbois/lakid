<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-900 leading-tight">
                {{ __('Dashboard Admin Dinas') }}
            </h2>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Total Pengajuan: <span class="font-bold text-lg">{{ count($pengajuans) }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900/20 border border-green-400 dark:border-green-800 text-green-800 dark:text-green-200 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 dark:bg-red-900/20 border border-red-400 dark:border-red-800 text-red-800 dark:text-red-200 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full divide-y divide-gray-200 table-fixed">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="w-1/12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Tanggal
                            </th>
                            <th scope="col" class="w-1/4 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pemohon
                            </th>
                            <th scope="col" class="w-auto px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Merek & Jenis
                            </th>
                            <th scope="col" class="w-1/12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Status
                            </th>
                            <th scope="col" class="w-1/6 px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pengajuans as $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->user->name }}</div>
                                <div class="text-sm text-gray-500 truncate max-w-xs" title="{{ $item->user->email }}">
                                    {{ $item->user->email }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 font-bold">{{ $item->nama_merek }}</div>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 mt-1">
                                    {{ $item->jenis }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php
                                    $colors = [
                                        'Draft' => 'bg-yellow-100 text-yellow-800',
                                        'Diajukan' => 'bg-blue-100 text-blue-800',
                                        'Ditinjau' => 'bg-purple-100 text-purple-800',
                                        'Disetujui' => 'bg-green-100 text-green-800',
                                        'Ditolak' => 'bg-red-100 text-red-800',
                                    ];
                                    $colorClass = $colors[$item->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colorClass }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                <a href="{{ route('admin.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold bg-indigo-50 px-4 py-2 rounded-md hover:bg-indigo-100 transition">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">
                                Belum ada pengajuan masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
