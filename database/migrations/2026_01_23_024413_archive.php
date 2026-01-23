<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon'); // Nama orangnya (dari Lakid)
            $table->string('nama_merek');   // Nama merek/karyanya
            $table->string('jenis');        // Merek / Hak Cipta
            $table->year('tahun');          // 2024, 2025, dst
            $table->string('status')->default('Selesai'); // Biasanya data arsip itu data yg sudah selesai
            $table->text('keterangan')->nullable(); // Keterangan tambahan (misal: "Migrasi dari Lakid")
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('archives');
    }
};