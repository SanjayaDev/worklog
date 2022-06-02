<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            "role_name" => "Super Admin",
            "role_description" => "Can do everything"
        ]);
        Role::create([
            "role_name" => "Admin"
        ]);
        Role::create([
            "role_name" => "Employee"
        ]);
    }
}
