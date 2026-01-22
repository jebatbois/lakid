<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            // 1. Cek Kolom 'tahapan_proses' (Sering error di sini)
            if (!Schema::hasColumn('pengajuans', 'tahapan_proses')) {
                $table->string('tahapan_proses')->nullable()->after('status');
            }

            // 2. Cek Kolom 'tahun'
            if (!Schema::hasColumn('pengajuans', 'tahun')) {
                $table->year('tahun')->default(date('Y'))->after('created_at');
            }

            // 3. Cek Kolom 'kategori' (Hanya jaga-jaga jika belum ada)
            if (!Schema::hasColumn('pengajuans', 'kategori')) {
                $table->string('kategori')->default('Mandiri')->after('user_id');
            }
            
            // 4. Cek Kolom File Baru (Jaga-jaga)
            if (!Schema::hasColumn('pengajuans', 'judul_ciptaan')) {
                $table->string('judul_ciptaan')->nullable();
            }
            if (!Schema::hasColumn('pengajuans', 'file_karya')) {
                $table->string('file_karya')->nullable();
            }
             if (!Schema::hasColumn('pengajuans', 'file_foto_produk')) {
                $table->string('file_foto_produk')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak perlu drop column agar aman
    }
};