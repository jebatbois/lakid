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
        // Kolom untuk menyimpan file surat balasan dari Dinas
        $table->string('file_surat_rekomendasi')->nullable()->after('catatan_admin');
        
        // Kolom tambahan untuk syarat UMK (sesuai dokumen Google Docs)
        $table->string('file_surat_umk')->nullable()->after('file_ktp');
    });
}

public function down(): void
{
    Schema::table('pengajuans', function (Blueprint $table) {
        $table->dropColumn(['file_surat_rekomendasi', 'file_surat_umk']);
    });
}
};
