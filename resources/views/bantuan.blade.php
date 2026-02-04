<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight">{{ __('Pusat Bantuan & Panduan') }}</h2>
    </x-slot>

    {{-- State AlpineJS untuk Mengontrol 4 Modal --}}
    <div x-data="{ showModalMerek: false, showModalCipta: false, showModalFile: false, showModalInfoCipta: false }">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                {{-- INSERTED: Panduan Penggunaan LAKID (Guide Section) --}}
                <div class="max-w-4xl mx-auto w-full px-4 sm:px-6 lg:px-8 mb-10">
                    <div class="text-center mb-12">
                        <h1 class="text-3xl font-extrabold text-gray-900 mb-4">Panduan Penggunaan LAKID</h1>
                        <p class="text-gray-500 max-w-2xl mx-auto">Ikuti langkah-langkah berikut untuk mendaftarkan akun dan mengajukan Fasilitasi HKI atau Permohonan Surat Rekomendasi Dinas.</p>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 mb-8 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-2 h-full bg-blue-500"></div>
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg">1</div>
                                <div class="flex-grow">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Registrasi & Kelengkapan Profil</h3>
                                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">Sebelum dapat mengajukan permohonan, Anda wajib memiliki akun dan melengkapi biodata diri.</p>
                                    <ul class="space-y-3">
                                        <li class="flex items-start gap-3 text-sm text-gray-700 bg-gray-50 p-3 rounded-lg">
                                            <svg class="w-5 h-5 text-green-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <span><strong>Daftar Akun:</strong> Klik tombol "Register", isi Nama, Email, dan Password. Lakukan verifikasi email jika diminta.</span>
                                        </li>
                                        <li class="flex items-start gap-3 text-sm text-gray-700 bg-gray-50 p-3 rounded-lg">
                                            <svg class="w-5 h-5 text-green-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <span><strong>Lengkapi Biodata (Wajib):</strong> Masuk ke menu <strong>Profil</strong>. Isi NIK (KTP), Nomor WhatsApp Aktif, dan Alamat Lengkap sesuai KTP.</span>
                                        </li>
                                    </ul>
                                    <div class="mt-4 p-3 bg-yellow-50 text-yellow-800 text-xs rounded border border-yellow-200">⚠ Anda tidak bisa membuat pengajuan jika Biodata Profil belum lengkap.</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 mb-8 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-2 h-full bg-indigo-500"></div>
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-lg">2</div>
                                <div class="flex-grow">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Memilih Jenis Layanan</h3>
                                    <p class="text-gray-600 mb-4 text-sm">Pada Dashboard, pilih layanan yang sesuai dengan kebutuhan Anda.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="border border-blue-200 rounded-xl p-4 bg-blue-50/30">
                                            <div class="flex items-center gap-2 mb-2"><span class="text-xl">🎁</span><h4 class="font-bold text-blue-800">Program Fasilitasi</h4></div>
                                            <p class="text-xs text-gray-600 leading-relaxed mb-2">Pilih ini jika Anda ingin mendaftarkan Merek Dagang dan biayanya <strong>ditanggung penuh oleh Dinas</strong>.</p>
                                            <ul class="text-xs text-gray-500 list-disc ml-4"><li>Khusus Merek Dagang.</li><li>Wajib punya produk/kemasan siap jual.</li><li>Kuota terbatas.</li></ul>
                                        </div>
                                        <div class="border border-indigo-200 rounded-xl p-4 bg-indigo-50/30">
                                            <div class="flex items-center gap-2 mb-2"><span class="text-xl">📄</span><h4 class="font-bold text-indigo-800"> Permohonan Surat Rekomendasi</h4></div>
                                            <p class="text-xs text-gray-600 leading-relaxed mb-2">Pilih ini jika Anda ingin mendaftar sendiri ke DJKI namun membutuhkan <strong>Surat Rekomendasi Dinas</strong> untuk keringanan biaya PNBP.</p>
                                            <ul class="text-xs text-gray-500 list-disc ml-4"><li>Untuk Merek & Hak Cipta.</li><li>Wajib upload Surat Permohonan.</li><li>Selalu buka (Tanpa kuota).</li></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 mb-8 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-lg">3</div>
                                <div class="flex-grow">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Mengisi Formulir & Upload Berkas</h3>
                                    <p class="text-gray-600 mb-6 text-sm">Pastikan data yang diinput benar. Data diri akan otomatis terisi dari profil Anda.</p>
                                    <div class="space-y-6">
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-800 mb-2 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-blue-500"></span>Jika memilih Fasilitasi:</h4>
                                            <ul class="list-decimal ml-5 text-sm text-gray-600 space-y-1"><li>Lengkapi <strong>Data Ekonomi Kreatif</strong> (Sub sektor, Omzet, Tenaga Kerja, dll).</li><li>Masukkan <strong>3 Usulan Nama Merek</strong> yang akan dicek ketersediaannya.</li><li>Upload <strong>Scan KTP</strong>.</li><li>Upload <strong>Scan Tanda Tangan</strong> (di kertas putih).</li><li>Upload <strong>Foto Produk</strong> (Kemasan siap jual, minimal 3 sisi digabung PDF/JPG).</li></ul>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-800 mb-2 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-indigo-500"></span>Jika memilih Mandiri:</h4>
                                            <ul class="list-decimal ml-5 text-sm text-gray-600 space-y-1"><li>Pilih Jenis: <strong>Merek</strong> atau <strong>Hak Cipta</strong>.</li><li>Isi Nama Merek / Judul Ciptaan.</li><li>Upload <strong>Surat Permohonan Rekomendasi</strong> (Wajib).</li><li>Upload kelengkapan lain (NPWP, CV, Surat UMK, Logo/File Ciptaan).</li></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 mb-8 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-2 h-full bg-green-500"></div>
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-bold text-lg">4</div>
                                <div class="flex-grow">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pantau Status & Hasil</h3>
                                    <p class="text-gray-600 mb-4 text-sm">Cek status pengajuan Anda secara berkala di Dashboard.</p>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full text-sm text-left text-gray-500 border rounded-lg">
                                            <thead class="bg-gray-50 text-gray-700 uppercase font-bold"><tr><th class="px-4 py-3">Status</th><th class="px-4 py-3">Keterangan</th></tr></thead>
                                            <tbody class="divide-y divide-gray-100">
                                                <tr><td class="px-4 py-3"><span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-bold">Diajukan</span></td><td class="px-4 py-3">Berkas sudah masuk dan menunggu verifikasi Admin Dinas.</td></tr>
                                                <tr><td class="px-4 py-3"><span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs font-bold">Proses DJKI</span></td><td class="px-4 py-3">(Khusus Fasilitasi) Data sedang didaftarkan ke sistem DJKI oleh Dinas.</td></tr>
                                                <tr><td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">Disetujui / Selesai</span></td><td class="px-4 py-3"><strong>Mandiri:</strong> Surat Rekomendasi terbit (Silakan download).<br><strong>Fasilitasi:</strong> Sertifikat Merek telah terbit/selesai.</td></tr>
                                                <tr><td class="px-4 py-3"><span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-bold">Ditolak</span></td><td class="px-4 py-3">Pengajuan ditolak (Cek catatan admin untuk alasan penolakan).</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-8 text-center md:text-left">
                    <h3 class="text-lg font-bold text-gray-800">Butuh Bantuan?</h3>
                    <p class="text-gray-600">Bingung cara mendaftar? Klik menu di bawah untuk melihat syarat lengkap atau unduh dokumen panduan.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    {{-- CARD 1: LAYANAN MEREK --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition duration-300">
                        <div class="p-6 border-t-4 border-blue-500">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-2xl">®</div>
                                <h3 class="text-xl font-bold text-gray-900">Layanan Merek</h3>
                            </div>
                            <p class="text-gray-500 text-sm mb-6 min-h-[40px]">Informasi bagi pelaku usaha yang ingin mendaftarkan brand/logo produk.</p>
                            
                            <ul class="space-y-4">
                                <li>
                                    <button @click="showModalMerek = true" class="flex items-center text-gray-700 hover:text-blue-600 transition group text-sm w-full text-left outline-none focus:outline-none font-medium">
                                        <span class="w-8 h-8 rounded-full bg-gray-50 group-hover:bg-blue-100 flex items-center justify-center mr-3 text-sm">📄</span>
                                        Syarat Pendaftaran
                                    </button>
                                </li>
                                <li>
                                    <a href="https://pdki-indonesia.dgip.go.id" target="_blank" class="flex items-center text-gray-700 hover:text-blue-600 transition group text-sm font-medium">
                                        <span class="w-8 h-8 rounded-full bg-gray-50 group-hover:bg-blue-100 flex items-center justify-center mr-3 text-sm">🔍</span>
                                        Cek Pangkalan Data KI
                                    </a>
                                </li>
                                <li>
                                    <a href="https://skm.dgip.go.id/" target="_blank" class="flex items-center text-gray-700 hover:text-blue-600 transition group text-sm font-medium">
                                        <span class="w-8 h-8 rounded-full bg-gray-50 group-hover:bg-blue-100 flex items-center justify-center mr-3 text-sm">🏷️</span>
                                        Cek Kelas Merek (1-45)
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- CARD 2: LAYANAN HAK CIPTA --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition duration-300">
                        <div class="p-6 border-t-4 border-yellow-500">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center font-bold text-2xl">©</div>
                                <h3 class="text-xl font-bold text-gray-900">Layanan Hak Cipta</h3>
                            </div>
                            <p class="text-gray-500 text-sm mb-6 min-h-[40px]">Untuk karya seni, musik, buku, film, dan karya kreatif lainnya.</p>
                            
                            <ul class="space-y-4">
                                <li>
                                    <button @click="showModalInfoCipta = true" class="flex items-center text-gray-700 hover:text-yellow-600 transition group text-sm w-full text-left outline-none focus:outline-none font-medium">
                                        <span class="w-8 h-8 rounded-full bg-gray-50 group-hover:bg-yellow-100 flex items-center justify-center mr-3 text-sm">ℹ️</span>
                                        Informasi & Modul Hak Cipta
                                    </button>
                                </li>
                                <li>
                                    <button @click="showModalCipta = true" class="flex items-center text-gray-700 hover:text-yellow-600 transition group text-sm w-full text-left outline-none focus:outline-none font-medium">
                                        <span class="w-8 h-8 rounded-full bg-gray-50 group-hover:bg-yellow-100 flex items-center justify-center mr-3 text-sm">📄</span>
                                        Syarat Pencatatan
                                    </button>
                                </li>
                                <li>
                                    <button @click="showModalFile = true" class="flex items-center text-gray-700 hover:text-yellow-600 transition group text-sm w-full text-left outline-none focus:outline-none font-medium">
                                        <span class="w-8 h-8 rounded-full bg-gray-50 group-hover:bg-yellow-100 flex items-center justify-center mr-3 text-sm">📂</span>
                                        Jenis File Karya
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- CARD 3: DOKUMEN & DOWNLOAD --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition duration-300">
                        <div class="p-6 border-t-4 border-green-500">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold text-2xl">⬇️</div>
                                <h3 class="text-xl font-bold text-gray-900">Dokumen & Bantuan</h3>
                            </div>
                            <p class="text-gray-500 text-sm mb-6 min-h-[40px]">Unduh template surat dan hubungi kami jika ada kendala.</p>
                            
                            <ul class="space-y-4">
                                {{-- Link UMK --}}
                                <li>
                                    <a href="https://docs.google.com/document/d/1kexSPXukQdSxaWx_6bVUvyxw8c9h3srR/edit" target="_blank" class="flex items-center text-gray-700 hover:text-green-600 transition group text-sm font-medium">
                                        <span class="w-8 h-8 rounded-full bg-gray-50 group-hover:bg-green-100 flex items-center justify-center mr-3 text-sm">📥</span>
                                        Template Surat UMK
                                    </a>
                                </li>
                                {{-- Link Hak Cipta --}}
                                <li>
                                    <a href="https://docs.google.com/document/d/1KW8QYdNyRw1t1EhZ5XBwRT_GfyO6BTOf/edit" target="_blank" class="flex items-center text-gray-700 hover:text-green-600 transition group text-sm font-medium">
                                        <span class="w-8 h-8 rounded-full bg-gray-50 group-hover:bg-green-100 flex items-center justify-center mr-3 text-sm">📥</span>
                                        Template Surat Hak Cipta
                                    </a>
                                </li>
                                {{-- Link Rekomendasi --}}
                                <li>
                                    <a href="https://docs.google.com/document/d/1IsENGH7Fwhz6c9IF72Wckozs3E_osLeKMgZSgvJE1jA/edit" target="_blank" class="flex items-center text-gray-700 hover:text-green-600 transition group text-sm font-medium">
                                        <span class="w-8 h-8 rounded-full bg-gray-50 group-hover:bg-green-100 flex items-center justify-center mr-3 text-sm">📥</span>
                                        Surat Permohonan Rekom
                                    </a>
                                </li>
                                <li class="pt-6 mt-4 border-t border-gray-100">
                                    <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center justify-center w-full px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition font-bold shadow-md hover:shadow-lg group">
                                        <svg class="w-6 h-6 mr-2 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                        Konsultasi via WhatsApp
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= MODAL INFO CIPTA (KUNING) ================= --}}
        <div x-show="showModalInfoCipta" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" @click="showModalInfoCipta = false"></div>
            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border-t-8 border-yellow-500">
                    <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b">
                        <h3 class="text-xl font-extrabold leading-6 text-gray-900">Apa Itu Hak Cipta?</h3>
                        <button @click="showModalInfoCipta = false" class="text-gray-400 hover:text-red-500 focus:outline-none"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                    </div>
                    <div class="px-6 py-6 space-y-4">
                        <div class="bg-yellow-50 p-4 rounded-lg text-sm text-gray-800 border-l-4 border-yellow-400"><strong>Definisi:</strong> Hak eksklusif pencipta yang timbul secara otomatis setelah karya diwujudkan dalam bentuk nyata dan dipublikasikan.</div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="border p-4 rounded-lg hover:bg-gray-50"><h4 class="font-bold text-gray-900 mb-1">✨ Hak Moral</h4><p class="text-xs text-gray-600">Hak untuk dicantumkan namanya & melarang perubahan karya.</p></div>
                            <div class="border p-4 rounded-lg hover:bg-gray-50"><h4 class="font-bold text-gray-900 mb-1">💰 Hak Ekonomi</h4><p class="text-xs text-gray-600">Hak mendapatkan royalti atau manfaat ekonomi dari penggunaan karya.</p></div>
                        </div>
                        <h4 class="font-bold text-gray-900 mt-4 border-b pb-2">Masa Berlaku Pelindungan</h4>
                        <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1"><li><strong>Seumur Hidup + 70 Tahun:</strong> Buku, Lagu, Lukisan, Tari, Drama.</li><li><strong>50 Tahun sejak Publikasi:</strong> Fotografi, Program Komputer, Sinematografi.</li></ul>
                        <h4 class="font-bold text-gray-900 mt-4 border-b pb-2">Biaya PNBP (Online)</h4>
                        <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1"><li><strong>UMK / Litbang:</strong> Rp 200.000 / permohonan.</li><li><strong>Umum:</strong> Rp 400.000 / permohonan.</li></ul>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse gap-2">
                        <button @click="showModalInfoCipta = false" class="inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-100 sm:mt-0 sm:w-auto">Tutup</button>
                        <a href="https://drive.google.com/file/d/13tB17EpZVLirdLm9aZJ-WHQeSfliyiiO/view" target="_blank" class="inline-flex w-full justify-center rounded-lg bg-yellow-600 px-4 py-2 text-sm font-bold text-white shadow-sm hover:bg-yellow-700 sm:mt-0 sm:w-auto flex items-center gap-2">Download Modul (PDF)</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= MODAL MEREK (BIRU) ================= --}}
        <div x-show="showModalMerek" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" @click="showModalMerek = false"></div>
            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border-t-8 border-blue-600">
                    <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b">
                        <h3 class="text-xl font-extrabold leading-6 text-gray-900">Alur & Syarat Pendaftaran Merek</h3>
                        <button @click="showModalMerek = false" class="text-gray-400 hover:text-red-500 focus:outline-none"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                    </div>
                    <div class="px-6 py-6 space-y-6">
                        <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">1</div></div><div><h4 class="text-lg font-bold text-gray-900">Cek Merek & Klasifikasi</h4><p class="text-sm text-gray-600 mt-1">Pastikan merek belum terdaftar. Tentukan kelas (Jasa/Barang).</p></div></div>
                        <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">2</div></div><div><h4 class="text-lg font-bold text-gray-900">Etiket Merek (Logo)</h4><p class="text-sm text-gray-600 mt-1">File logo format <strong>JPG</strong> (rekomendasi: 9x9 cm).</p></div></div>
                        <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">3</div></div><div><h4 class="text-lg font-bold text-gray-900">Data Pemilik</h4><p class="text-sm text-gray-600 mt-1">Scan KTP dan NPWP (JPG/PDF).</p></div></div>
                        <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">4</div></div><div><h4 class="text-lg font-bold text-gray-900">Tanda Tangan Digital</h4><p class="text-sm text-gray-600 mt-1">Foto tanda tangan di kertas putih (JPG).</p></div></div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">5</div></div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">Surat Pernyataan UMK</h4>
                                <p class="text-sm text-gray-600 mt-1">Isi, TTD Materai, Scan (JPG/PDF).</p>
                                <a href="https://docs.google.com/document/d/1kexSPXukQdSxaWx_6bVUvyxw8c9h3srR/edit" target="_blank" class="text-sm text-blue-600 font-bold hover:underline mt-1 block">Download Template UMK &rarr;</a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse"><button @click="showModalMerek = false" class="inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-100 sm:mt-0 sm:w-auto">Tutup</button></div>
                </div>
            </div>
        </div>

        {{-- ================= MODAL SYARAT CIPTA (KUNING) ================= --}}
        <div x-show="showModalCipta" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" @click="showModalCipta = false"></div>
            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border-t-8 border-yellow-500">
                    <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b">
                        <h3 class="text-xl font-extrabold leading-6 text-gray-900">Alur & Syarat Hak Cipta</h3>
                        <button @click="showModalCipta = false" class="text-gray-400 hover:text-red-500 focus:outline-none"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                    </div>
                    <div class="px-6 py-6 space-y-6">
                        <p class="text-center text-yellow-800 font-semibold bg-yellow-100 p-3 rounded-lg border border-yellow-200">"Jangan lupa publikasi karya, biar otomatis dapat hak cipta!"</p>
                        <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 text-yellow-600 font-bold">1</div></div><div><h4 class="text-lg font-bold text-gray-900">Identitas Pencipta</h4><p class="text-sm text-gray-600 mt-1">Scan/Foto KTP & NPWP (JPG/PDF).</p></div></div>
                        <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 text-yellow-600 font-bold">2</div></div><div><h4 class="text-lg font-bold text-gray-900">Identitas Pemegang Hak</h4><p class="text-sm text-gray-600 mt-1">Scan KTP & NPWP.</p></div></div>
                        <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 text-yellow-600 font-bold">3</div></div><div><h4 class="text-lg font-bold text-gray-900">File Contoh Ciptaan</h4><p class="text-sm text-gray-600 mt-1">Format sesuai jenis karya.</p></div></div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 text-yellow-600 font-bold">4</div></div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">Surat Pernyataan Keaslian</h4>
                                <p class="text-sm text-gray-600 mt-1">Download, Isi, TTD Materai, Scan.</p>
                                <a href="https://docs.google.com/document/d/1KW8QYdNyRw1t1EhZ5XBwRT_GfyO6BTOf/edit" target="_blank" class="text-sm text-yellow-600 font-bold hover:underline mt-1 block">Download Template Pernyataan &rarr;</a>
                            </div>
                        </div>
                        <div class="flex gap-4"><div class="flex-shrink-0"><div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 text-yellow-600 font-bold">5</div></div><div><h4 class="text-lg font-bold text-gray-900">Isi Formulir Digital</h4><p class="text-sm text-gray-600 mt-1">Siapkan data: Judul, Deskripsi, Tgl Publikasi.</p></div></div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse"><button @click="showModalCipta = false" class="inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-100 sm:mt-0 sm:w-auto">Tutup</button></div>
                </div>
            </div>
        </div>

        {{-- ================= MODAL JENIS FILE (UNGU) ================= --}}
        <div x-show="showModalFile" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" @click="showModalFile = false"></div>
            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl border-t-8 border-purple-500">
                    <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b">
                        <h3 class="text-xl font-extrabold leading-6 text-gray-900">Jenis & Format File Karya Cipta</h3>
                        <button @click="showModalFile = false" class="text-gray-400 hover:text-red-500 focus:outline-none"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                    </div>
                    <div class="px-6 py-6">
                        <div class="overflow-x-auto rounded-lg border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Jenis Ciptaan</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">File Contoh Ciptaan</th>
                                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Format</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                    <tr class="hover:bg-gray-50"><td class="px-4 py-2 font-medium">Buku</td><td class="px-4 py-2">Cover, Daftar Isi, Daftar Pustaka</td><td class="px-4 py-2 text-center bg-gray-50 rounded badge">PDF</td></tr>
                                    <tr class="hover:bg-gray-50"><td class="px-4 py-2 font-medium">Program Komputer</td><td class="px-4 py-2">Cover, Program, Manual Book</td><td class="px-4 py-2 text-center bg-gray-50">PDF</td></tr>
                                    <tr class="hover:bg-gray-50"><td class="px-4 py-2 font-medium">Ceramah, Pidato</td><td class="px-4 py-2">Rekaman, Video</td><td class="px-4 py-2 text-center bg-gray-50">MP4 / PDF</td></tr>
                                    <tr class="hover:bg-gray-50"><td class="px-4 py-2 font-medium">Lagu / Musik</td><td class="px-4 py-2">Rekaman / Partitur (Notasi)</td><td class="px-4 py-2 text-center bg-gray-50">MP3 / PDF</td></tr>
                                    <tr class="hover:bg-gray-50"><td class="px-4 py-2 font-medium">Drama, Tari</td><td class="px-4 py-2">Video / Rekaman</td><td class="px-4 py-2 text-center bg-gray-50">MP4</td></tr>
                                    <tr class="hover:bg-gray-50"><td class="px-4 py-2 font-medium">Seni Rupa (Lukis, Batik)</td><td class="px-4 py-2">Foto / Gambar</td><td class="px-4 py-2 text-center bg-gray-50">JPG</td></tr>
                                    <tr class="hover:bg-gray-50"><td class="px-4 py-2 font-medium">Arsitektur, Peta</td><td class="px-4 py-2">Foto / Gambar</td><td class="px-4 py-2 text-center bg-gray-50">JPG / PDF</td></tr>
                                    <tr class="hover:bg-gray-50"><td class="px-4 py-2 font-medium">Fotografi</td><td class="px-4 py-2">Foto / Gambar</td><td class="px-4 py-2 text-center bg-gray-50">JPG</td></tr>
                                    <tr class="hover:bg-gray-50"><td class="px-4 py-2 font-medium">Sinematografi</td><td class="px-4 py-2">Video, Naskah (Sinopsis)</td><td class="px-4 py-2 text-center bg-gray-50">MP4</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="mt-4 text-xs text-gray-500 italic">*Ukuran maksimal file contoh ciptaan adalah 20 MB.</p>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse"><button @click="showModalFile = false" class="inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-100 sm:mt-0 sm:w-auto">Tutup</button></div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>