<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->string('file_ttd')->nullable()->after('file_ktp');
        });
    }

    public function down()
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn('file_ttd');
        });
    }
};