<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\Pekerjaan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed pakai Factory - Mirna
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
        ]);

        // Create 20 Pekerjaan menggunakan Factory - Mirna
        Pekerjaan::factory()->count(20)->create();

        // Create 50 Pegawai menggunakan Factory - Mirna
        Pegawai::factory()->count(50)->create();
    }
}
