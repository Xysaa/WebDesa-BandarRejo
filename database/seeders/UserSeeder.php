<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrator Desa',
                'email' => 'admin@desa.test',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ketua Dusun 1',
                'email' => 'kadus@desa.test',
                'password' => Hash::make('password123'),
                'role' => 'kepala_dusun',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
