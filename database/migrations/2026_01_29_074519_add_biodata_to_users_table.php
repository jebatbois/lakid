<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_ktp', 20)->nullable()->after('email');
            $table->string('no_hp', 20)->nullable()->after('no_ktp');
            $table->text('alamat_ktp')->nullable()->after('no_hp');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_ktp', 'no_hp', 'alamat_ktp']);
        });
    }
};