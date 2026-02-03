<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            // Menambahkan 8 Kolom Baru untuk Fasilitasi Ekraf
            $table->string('subsektor_ekraf')->nullable();
            $table->string('lokasi_usaha')->nullable();
            $table->text('hasil_produk')->nullable();
            $table->string('modal_usaha')->nullable();
            $table->integer('jumlah_tenaga_kerja')->nullable();
            $table->string('pemasaran_distribusi')->nullable();
            $table->string('omzet_bulanan')->nullable();
            $table->text('usulan_nama_merek')->nullable(); // Menampung 3 usulan nama
        });
    }

    public function down()
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn([
                'subsektor_ekraf',
                'lokasi_usaha',
                'hasil_produk',
                'modal_usaha',
                'jumlah_tenaga_kerja',
                'pemasaran_distribusi',
                'omzet_bulanan',
                'usulan_nama_merek'
            ]);
        });
    }
};