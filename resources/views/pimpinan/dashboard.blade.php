<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight">
            {{ __('Dashboard Eksekutif') }}
        </h2>
    </x-slot>

    {{-- Load Library Chart.js dari CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Bagian 1: Kartu Ringkasan (Summary Cards) --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border-l-4 border-blue-500 p-6">
                    <div class="text-gray-500 text-sm font-bold uppercase">Total Masuk</div>
                    <div class="text-3xl font-extrabold text-gray-900 mt-2">{{ $totalPengajuan }}</div>
                    <div class="text-xs text-gray-400 mt-1">Semua Waktu</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border-l-4 border-yellow-500 p-6">
                    <div class="text-gray-500 text-sm font-bold uppercase">Sedang Proses</div>
                    <div class="text-3xl font-extrabold text-yellow-600 mt-2">{{ $totalProses }}</div>
                    <div class="text-xs text-gray-400 mt-1">Perlu Tindakan</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border-l-4 border-green-500 p-6">
                    <div class="text-gray-500 text-sm font-bold uppercase">Disetujui</div>
                    <div class="text-3xl font-extrabold text-green-600 mt-2">{{ $totalDisetujui }}</div>
                    <div class="text-xs text-gray-400 mt-1">Rekomendasi Terbit</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border-l-4 border-red-500 p-6">
                    <div class="text-gray-500 text-sm font-bold uppercase">Ditolak</div>
                    <div class="text-3xl font-extrabold text-red-600 mt-2">{{ $totalDitolak }}</div>
                    <div class="text-xs text-gray-400 mt-1">Tidak Memenuhi Syarat</div>
                </div>
            </div>

            {{-- Bagian 2: Grafik (Charts) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <div class="bg-white p-6 shadow-sm rounded-lg border border-gray-200">
                    <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">Tren Pendaftaran (Tahun Ini)</h3>
                    <canvas id="barChart"></canvas>
                </div>

                <div class="bg-white p-6 shadow-sm rounded-lg border border-gray-200">
                    <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">Komposisi Status Pengajuan</h3>
                    <div class="h-64 flex justify-center">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Bagian 3: Tombol Export / Cetak Laporan --}}
            <div class="mt-8 flex justify-end gap-3">
                {{-- Tombol Export Excel --}}
                <a href="{{ route('pimpinan.excel') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export Data Excel
                </a>

                {{-- Tombol Cetak PDF (Laporan Resmi) --}}
                <a href="{{ route('pimpinan.cetak') }}" target="_blank" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Laporan PDF
                </a>
            </div>

        </div>
    </div>

    {{-- Script untuk Render Chart --}}
    <script>
        // 1. Config Bar Chart (Bulanan)
        const ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Pengajuan',
                    data: @json($dataBar),
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });

        // 2. Config Pie Chart (Status)
        const ctxPie = document.getElementById('pieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: @json($labelsPie),
                datasets: [{
                    data: @json($dataPie),
                    backgroundColor: [
                        '#FCD34D',
                        '#60A5FA',
                        '#818CF8',
                        '#34D399',
                        '#F87171'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</x-app-layout>
