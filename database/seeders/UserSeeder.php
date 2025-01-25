<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Jl. Admin No. 1',
            'no_telp' => '081234567890',
            'role' => 'admin',
        ]);

        // Create Petugas User
        User::create([
            'name' => 'Petugas User',
            'email' => 'petugas@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Jl. Petugas No. 2',
            'no_telp' => '081234567891',
            'role' => 'petugas',
        ]);
    }
}