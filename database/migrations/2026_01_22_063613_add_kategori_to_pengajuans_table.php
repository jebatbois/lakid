<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::table('pengajuans', function (Blueprint $table) {
        // Menyimpan jenis: 'Mandiri' (Rekomendasi) atau 'Fasilitasi' (Program Dinas)
        $table->string('kategori')->default('Mandiri')->after('user_id'); 
        
        // Untuk tracking timeline fasilitasi yang lebih detail
        // Contoh: 'Verifikasi', 'Diajukan ke DJKI', 'Menunggu Sertifikat', 'Selesai'
        $table->string('tahapan_fasilitasi')->nullable()->after('status'); 
        
        // Menandai apakah ini data arsip lama (inputan admin) atau baru
        $table->boolean('is_arsip')->default(false)->after('status');
        
        // Tahun anggaran (penting untuk kuota per tahun)
        $table->year('tahun')->default(date('Y'));
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            //
        });
    }
};
