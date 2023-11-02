<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'name' => 'Admin',
            'birth' => now(),
            'gender' => 'male',
            'phone' => '6281515144981',
            'address' => 'Jakarta',
            'join_date' => now(),
            'is_active' => 1,
        ]);
    }
}
