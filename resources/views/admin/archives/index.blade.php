<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight">
            {{ __('Arsip & Statistik Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- BAGIAN 1: GRAFIK STATISTIK --}}
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 mb-8 p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Grafik Pertumbuhan Pendaftar</h3>
                        <p class="text-gray-500 text-sm">Gabungan data Arsip (Lakid) & Sistem Baru</p>
                    </div>
                    <div class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg font-bold text-sm">
                        Total Keseluruhan: {{ array_sum($totals) }} Data
                    </div>
                </div>
                
                <div class="relative h-80 w-full">
                    <canvas id="registrationChart"></canvas>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- BAGIAN 2: FORM INPUT DATA LAMA (MIGRASI) --}}
                <div class="lg:col-span-1">
                    <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6 shadow-sm sticky top-6">
                        <h3 class="text-lg font-bold text-indigo-900 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Input Data Arsip (Lakid)
                        </h3>
                        <p class="text-indigo-600 text-sm mb-4">
                            Masukkan data pendaftar manual dari tahun-tahun sebelumnya (2024, 2025, dst) agar masuk ke grafik.
                        </p>

                        <form action="{{ route('admin.archives.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-bold text-indigo-800 uppercase mb-1">Nama Pemohon</label>
                                <input type="text" name="nama_pemohon" required class="w-full rounded-lg border-indigo-200 focus:ring-indigo-500 focus:border-indigo-500 text-sm" placeholder="Contoh: Budi Santoso">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-indigo-800 uppercase mb-1">Nama Merek / Ciptaan</label>
                                <input type="text" name="nama_merek" required class="w-full rounded-lg border-indigo-200 focus:ring-indigo-500 focus:border-indigo-500 text-sm" placeholder="Contoh: Kripik Enak">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-indigo-800 uppercase mb-1">Tahun</label>
                                    <select name="tahun" class="w-full rounded-lg border-indigo-200 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                        <option value="2023">2023</option>
                                        <option value="2024" selected>2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-indigo-800 uppercase mb-1">Jenis</label>
                                    <select name="jenis" class="w-full rounded-lg border-indigo-200 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                        <option value="Merek">Merek</option>
                                        <option value="Hak Cipta">Hak Cipta</option>
                                        <option value="Desain Industri">Desain Industri</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 rounded-lg transition shadow-md">
                                Simpan ke Arsip
                            </button>
                        </form>
                    </div>
                </div>

                {{-- BAGIAN 3: TABEL DATA ARSIP --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="font-bold text-gray-900">Data Arsip Tersimpan</h3>
                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Manual Input</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3">Tahun</th>
                                        <th class="px-6 py-3">Pemohon</th>
                                        <th class="px-6 py-3">Merek / Karya</th>
                                        <th class="px-6 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($archives as $data)
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <td class="px-6 py-4 font-bold text-gray-900">{{ $data->tahun }}</td>
                                            <td class="px-6 py-4">{{ $data->nama_pemohon }}</td>
                                            <td class="px-6 py-4">
                                                <div class="font-bold">{{ $data->nama_merek }}</div>
                                                <span class="text-xs text-blue-600">{{ $data->jenis }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <form action="{{ route('admin.archives.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-8 text-center text-gray-400 italic">
                                                Belum ada data arsip manual. Silakan input di form sebelah kiri.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4">
                            {{ $archives->links() }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- SCRIPT CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('registrationChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line', // Bisa ganti 'bar' jika mau batang
            data: {
                labels: @json($years), // Tahun [2023, 2024, 2025...]
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: @json($totals), // Total Gabungan
                    backgroundColor: 'rgba(79, 70, 229, 0.2)', // Warna area (Indigo)
                    borderColor: 'rgba(79, 70, 229, 1)',     // Warna garis
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: 'rgba(79, 70, 229, 1)',
                    pointRadius: 6,
                    fill: true,
                    tension: 0.4 // Membuat garis melengkung halus
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Sembunyikan legend agar bersih
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2, 4],
                            color: '#e5e7eb'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>