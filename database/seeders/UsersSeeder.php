<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::truncate();
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(12345678),
            'is_admin' => true,
            'is_active' => true
        ]);
        \App\Models\User::create([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make(12345678),
            'is_admin' => true,
            'is_active' => true
        ]);
        \App\Models\User::create([
            'name' => 'nikko',
            'email' => 'nikko@gmail.com',
            'password' => Hash::make(12345678),
            'is_admin' => false,
            'is_active' => true,
        ]);
        \App\Models\User::create([
            'name' => 'fandi',
            'email' => 'fandi@gmail.com',
            'password' => Hash::make(12345678),
            'is_admin' => false,
            'is_active' => true,
        ]);
    }
}
