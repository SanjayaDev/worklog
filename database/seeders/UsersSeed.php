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
            "name" => "Mohammad Ricky Sanjaya",
            "email" => "rickysanjaya411@gmail.com",
            "password" => Hash::make("admin123"),
            "is_super_admin" => 1,
        ]);
    }
}
