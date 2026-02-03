<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
                {{ __('Dashboard Admin Dinas') }}
            </h2>
            <div class="text-sm text-gray-600 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
                Total Masuk: <span class="font-bold text-blue-600 text-lg">{{ $pengajuans->total() }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- BAGIAN 1: GRAFIK STATISTIK --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 mb-8 p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                            Statistik Pendaftaran HKI
                        </h3>
                        <p class="text-sm text-gray-500">Gabungan Data Arsip Manual & Sistem Online</p>
                    </div>
                    <div class="text-right">
                        <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Update Realtime</span>
                    </div>
                </div>
                
                {{-- Container Grafik --}}
                <div class="relative h-72 w-full">
                    <canvas id="adminChart"></canvas>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded-r-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- BAGIAN 2: TABEL MANAJEMEN PENGAJUAN --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200">
                
                <div class="p-6 border-b border-gray-100 bg-gray-50 flex flex-col md:flex-row justify-between gap-4 items-center">
                    <h3 class="font-bold text-gray-800 text-lg">Daftar Pengajuan Masuk</h3>
                    
                    <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">

                        {{-- Form Pencarian --}}
                        <form method="GET" action="{{ route('admin.dashboard') }}" class="flex w-full md:w-auto gap-2">
                            <select name="status" class="rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Status</option>
                                <option value="Diajukan" {{ request('status') == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                                <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pemohon/merek..." class="rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500 w-full md:w-64">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow transition">
                                Filter
                            </button>
                        </form>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pemohon</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Merek / Karya</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pengajuans as $item)
                            <tr class="hover:bg-blue-50/30 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $item->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->user->email }}</div>
                                    <div class="text-xs text-gray-400 mt-1">{{ $item->created_at->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $item->nama_merek }}</div>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                        {{ $item->jenis }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->kategori == 'Fasilitasi' ? 'bg-purple-100 text-purple-800 border border-purple-200' : 'bg-orange-100 text-orange-800 border border-orange-200' }}">
                                        {{ $item->kategori }}
                                    </span>
                                    @if($item->kategori == 'Fasilitasi')
                                        <div class="text-[10px] text-purple-600 mt-1 font-bold">
                                            Step: {{ $item->tahapan_proses ?? 'Awal' }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $colors = [
                                            'Diajukan' => 'bg-blue-100 text-blue-800 border border-blue-200',
                                            'Disetujui' => 'bg-green-100 text-green-800 border border-green-200',
                                            'Ditolak' => 'bg-red-100 text-red-800 border border-red-200',
                                            'Draft' => 'bg-gray-100 text-gray-800 border border-gray-200',
                                        ];
                                        $colorClass = $colors[$item->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $colorClass }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                    {{-- TOMBOL AKSI (BIRU SOLID AGAR TERLIHAT JELAS) --}}
                                    <a href="{{ route('admin.show', $item->id) }}" class="inline-flex items-center justify-center text-white bg-blue-600 hover:bg-blue-700 font-bold px-4 py-2 rounded-lg shadow-sm transition transform hover:scale-105 w-full md:w-auto">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Periksa
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        <span class="text-sm font-medium">Belum ada pengajuan yang sesuai filter.</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-100">
                    {{ $pengajuans->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('adminChart').getContext('2d');
            
            const labels = @json($years);
            const dataTotals = @json($totals);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Pendaftar',
                        data: dataTotals,
                        backgroundColor: 'rgba(59, 130, 246, 0.1)', // Blue-500 tint
                        borderColor: '#2563eb', // Blue-600
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#2563eb',
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e3a8a', // Blue-900
                            titleFont: { size: 13 },
                            bodyFont: { size: 14, weight: 'bold' },
                            padding: 10,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.raw + ' Pendaftar';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [4, 4], color: '#f3f4f6' },
                            ticks: { font: { size: 11 }, precision: 0 }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 12, weight: 'bold' } }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>