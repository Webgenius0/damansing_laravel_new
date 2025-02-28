<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Admin',
            'pet_name' => 'Kitty', 
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'pet_dob' => null, 
        ]);

        User::create([
            'username' => 'user',
            'pet_name' => 'Doggy',
            'email' => 'user@user.com',
            'password' => Hash::make('12345678'),
            'pet_dob' => null, 
        ]);

        User::create([
            'username' => 'Jalis',
            'pet_name' => 'kitty',
            'email' => 'jalismahamud31@gmail.com',
            'password' => Hash::make('12345678'),
            'pet_dob' => null, 
        ]);
    }
}
