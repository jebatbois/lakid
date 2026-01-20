<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            // Menambahkan kolom untuk file tambahan
            $table->string('file_surat_permohonan')->nullable()->after('file_surat_umk');
            $table->string('file_cv')->nullable()->after('file_surat_permohonan');
            $table->string('file_npwp')->nullable()->after('file_cv');
            $table->string('file_foto_produk')->nullable()->after('file_npwp');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn(['file_surat_permohonan', 'file_cv', 'file_npwp', 'file_foto_produk']);
        });
    }
};