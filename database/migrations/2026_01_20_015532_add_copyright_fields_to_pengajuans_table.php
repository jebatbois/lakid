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
            // Kolom khusus Hak Cipta
            $table->string('judul_ciptaan')->nullable()->after('nama_merek'); // Alternatif nama_merek
            $table->string('file_karya')->nullable()->after('file_logo'); // Untuk MP3, PDF, Video
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn(['judul_ciptaan', 'file_karya']);
        });
    }
};