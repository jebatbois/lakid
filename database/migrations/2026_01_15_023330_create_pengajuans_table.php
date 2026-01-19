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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke User
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Data HKI
            $table->string('nama_merek');
            $table->enum('jenis', ['Merek', 'Hak Cipta', 'Desain Industri']);
            $table->text('deskripsi_karya');

            // Status & Admin
            $table->enum('status', ['Draft', 'Diajukan', 'Ditinjau', 'Disetujui', 'Ditolak'])->default('Draft');
            $table->text('catatan_admin')->nullable();

            // File Upload
            $table->string('file_logo')->nullable();
            $table->string('file_ktp')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};