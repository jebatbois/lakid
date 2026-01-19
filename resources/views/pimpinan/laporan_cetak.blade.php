<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Eksekutif LAKID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-white text-gray-900 p-8 font-serif" onload="setTimeout(() => window.print(), 1000)">

    {{-- KOP SURAT --}}
    <div class="flex items-center justify-between border-b-4 border-double border-black pb-4 mb-8">
        <img src="{{ asset('img/logo-kepri.png') }}" class="w-20 h-auto" alt="Logo">
        <div class="text-center flex-1">
            <h2 class="text-xl font-bold uppercase">Pemerintah Provinsi Kepulauan Riau</h2>
            <h1 class="text-2xl font-extrabold uppercase mt-1">Dinas Pariwisata</h1>
            <p class="text-sm mt-1">Pusat Pemerintahan Provinsi Kepulauan Riau, Istana Kota Piring, Dompak, Tanjungpinang</p>
        </div>
        <div class="w-20"></div>
    </div>

    {{-- JUDUL LAPORAN --}}
    <div class="text-center mb-8">
        <h3 class="text-lg font-bold underline">LAPORAN REKAPITULASI LAYANAN HKI</h3>
        <p class="text-sm">Per Tanggal: {{ date('d F Y') }}</p>
    </div>

    {{-- RINGKASAN ANGKA --}}
    <div class="grid grid-cols-4 gap-4 mb-8 text-center">
        <div class="border p-4">
            <div class="text-xs uppercase font-bold">Total Masuk</div>
            <div class="text-2xl font-bold">{{ $totalPengajuan }}</div>
        </div>
        <div class="border p-4">
            <div class="text-xs uppercase font-bold">Proses</div>
            <div class="text-2xl font-bold">{{ $totalProses }}</div>
        </div>
        <div class="border p-4">
            <div class="text-xs uppercase font-bold">Disetujui</div>
            <div class="text-2xl font-bold">{{ $totalDisetujui }}</div>
        </div>
        <div class="border p-4">
            <div class="text-xs uppercase font-bold">Ditolak</div>
            <div class="text-2xl font-bold">{{ $totalDitolak }}</div>
        </div>
    </div>

    {{-- GRAFIK (Diatur ukuran A4) --}}
    <div class="grid grid-cols-2 gap-8 mb-8">
        <div>
            <h4 class="font-bold text-center mb-2 border-b">Tren Pendaftaran Bulanan</h4>
            <canvas id="barChart"></canvas>
        </div>
        <div>
            <h4 class="font-bold text-center mb-2 border-b">Komposisi Status</h4>
            <div style="width: 70%; margin: 0 auto;">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

    {{-- TANDA TANGAN --}}
    <div class="flex justify-end mt-16">
        <div class="text-center w-64">
            <p>Tanjungpinang, {{ date('d F Y') }}</p>
            <p class="font-bold mt-1">Kepala Dinas Pariwisata</p>
            <br><br><br>
            <p class="font-bold underline">Bapak Kepala Dinas, S.E., M.Si.</p>
            <p>NIP. 19800101 200001 1 001</p>
        </div>
    </div>

    {{-- SCRIPT CHART (Sama persis) --}}
    <script>
        // Chart Batang
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah',
                    data: @json($dataBar),
                    backgroundColor: '#000000', // Hitam untuk cetak
                    barPercentage: 0.6
                }]
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });

        // Chart Pie
        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: ['Draft', 'Diajukan', 'Ditinjau', 'Disetujui', 'Ditolak'],
                datasets: [{
                    data: @json($dataPie),
                    backgroundColor: ['#d1d5db', '#93c5fd', '#818cf8', '#86efac', '#fca5a5'],
                    borderWidth: 1
                }]
            }
        });
    </script>

    {{-- TOMBOL KEMBALI (Hanya tampil di layar) --}}
    <div class="fixed bottom-4 right-4 no-print">
        <button onclick="window.close()" class="bg-gray-800 text-white px-4 py-2 rounded shadow">Tutup</button>
    </div>

</body>
</html>
