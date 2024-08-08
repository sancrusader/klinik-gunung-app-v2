<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Dokter User',
                'email' => 'dokter@example.com',
                'password' => Hash::make('password'),
                'role' => 'dokter',
            ],
            [
                'name' => 'Kasir User',
                'email' => 'kasir@example.com',
                'password' => Hash::make('password'),
                'role' => 'kasir',
            ],
            [
                'name' => 'Paramedis User',
                'email' => 'paramedis@example.com',
                'password' => Hash::make('password'),
                'role' => 'paramedis',
            ],
            [
                'name' => 'Manajer User',
                'email' => 'manajer@example.com',
                'password' => Hash::make('password'),
                'role' => 'manajer',
            ],
            [
                'name' => 'Koordinator Penyelamat User',
                'email' => 'koordinator@example.com',
                'password' => Hash::make('password'),
                'role' => 'koordinator',
            ],
            [
                'name' => 'Pendaki User',
                'email' => 'pendaki@example.com',
                'password' => Hash::make('password'),
                'role' => 'pendaki',
            ],

            [
                'name' => 'Receptinonst User',
                'email' => 'receptinonst @example.com',
                'password' => Hash::make('password'),
                'role' => 'receptionst',
            ],
        ]);
    }
}
