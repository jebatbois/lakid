<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun ADMIN
        User::create([
            'name' => 'Admin Dinas Pariwisata',
            'email' => 'admin@lakid.kepri.prov.go.id',
            'password' => Hash::make('password'), // Password default: password
        ]);

        // 2. Buat Akun PIMPINAN
        User::create([
            'name' => 'Kepala Dinas',
            'email' => 'pimpinan@lakid.kepri.prov.go.id',
            'password' => Hash::make('password'),
        ]);
    
    }
}