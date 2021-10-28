<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
            'is_active' => true
        ]);
    }
}
