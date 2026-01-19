<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin - Kelola Pengajuan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Admin - Kelola Pengajuan</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Tinjau dan kelola semua pengajuan HKI dari pengguna</p>
            </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 rounded-lg flex items-start">
                <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="font-medium">Berhasil!</p>
                    <p class="text-sm mt-1">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Pengajuan Table Card -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pemohon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Merek</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($pengajuans as $pengajuan)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    <div>
                                        <p>{{ $pengajuan->user->name ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $pengajuan->user->email ?? 'N/A' }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $pengajuan->nama_merek }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                    {{ $pengajuan->jenis }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                    {{ $pengajuan->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusClasses = [
                                            'Draft' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-200',
                                            'Diajukan' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-200',
                                            'Ditinjau' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-200',
                                            'Disetujui' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200',
                                            'Ditolak' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-200',
                                        ];
                                        $statusClass = $statusClasses[$pengajuan->status] ?? $statusClasses['Draft'];
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                        {{ $pengajuan->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button 
                                        onclick="openModal({{ $pengajuan->id }}, '{{ $pengajuan->status }}', `{{ addslashes($pengajuan->catatan_admin ?? '') }}`)"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition font-medium">
                                        Ubah Status
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <p class="text-gray-600 dark:text-gray-400">Tidak ada pengajuan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($pengajuans->hasPages())
                <div class="bg-white dark:bg-gray-800 px-4 py-3 flex items-center justify-between border-t border-gray-200 dark:border-gray-700 sm:px-6">
                    {{ $pengajuans->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="statusModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 dark:bg-opacity-75 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Ubah Status Pengajuan</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="statusForm" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label for="statusSelect" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Status Baru
                </label>
                <select 
                    id="statusSelect" 
                    name="status"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Ditinjau">Ditinjau</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
            </div>

            <div>
                <label for="catatanAdmin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Catatan Admin
                </label>
                <textarea 
                    id="catatanAdmin" 
                    name="catatan_admin"
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Tambahkan catatan atau alasan perubahan status..."></textarea>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Opsional, max 1000 karakter</p>
            </div>

            <div class="flex gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button 
                    type="submit"
                    class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                    Simpan Perubahan
                </button>
                <button 
                    type="button"
                    onclick="closeModal()"
                    class="flex-1 px-4 py-2 bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-700 text-gray-800 dark:text-white font-medium rounded-lg transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(pengajuanId, currentStatus, catatanAdmin) {
        const modal = document.getElementById('statusModal');
        const form = document.getElementById('statusForm');
        const statusSelect = document.getElementById('statusSelect');
        const catatanField = document.getElementById('catatanAdmin');

        // Set current status
        statusSelect.value = currentStatus;
        catatanField.value = catatanAdmin;

        // Update form action
        form.action = `/admin/pengajuan/${pengajuanId}/status`;

        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('statusModal');
        modal.classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('statusModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
</x-app-layout>
