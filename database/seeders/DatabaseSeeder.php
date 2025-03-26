<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Todo;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat admin user hanya jika belum ada
        User::firstOrCreate(
            ['email' => 'admin@admin.com'], // Kondisi unik
            [
                'name' => 'Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'is_admin' => true,
            ]
        );

        // Tambahkan 400 data baru ke tabel todos
        Todo::factory(400)->create();
    }
}

