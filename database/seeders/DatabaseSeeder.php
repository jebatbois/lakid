<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Contoh user biasa
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Akun Pimpinan (Kepala Dinas)
        // NOTE: Migration default tidak punya kolom 'role', jadi jangan set 'role' jika belum ada.
        User::factory()->create([
            'name' => 'Bapak Kepala Dinas',
            'email' => 'kadis@lakid.kepri.prov.go.id',
            'password' => bcrypt('password'), // Password standar
        ]);
    }
}
