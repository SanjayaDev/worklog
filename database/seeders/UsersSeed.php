<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "role_id" => 1,
            "name" => "Mohammad Ricky Sanjaya",
            "email" => "rickysanjaya411@gmail.com",
            "password" => Hash::make("admin123"),
        ]);
        User::create([
            "role_id" => 2,
            "name" => "User Admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("admin123"),
        ]);
        User::create([
            "role_id" => 3,
            "name" => "User Employee",
            "email" => "employee@gmail.com",
            "password" => Hash::make("admin123"),
        ]);
    }
}
