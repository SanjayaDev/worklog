<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::create([
            "module_code" => "001",
            "module_name" => "Login"
        ]);
        Module::create([
            "module_code" => "002U",
            "module_name" => "View User Management"
        ]);
        Module::create([
            "module_code" => "002UA",
            "module_name" => "Add User"
        ]);
        Module::create([
            "module_code" => "002UD",
            "module_name" => "View User Detail"
        ]);
        Module::create([
            "module_code" => "002UDS",
            "module_name" => "View User Self Detail"
        ]);
        Module::create([
            "module_code" => "002UE",
            "module_name" => "Edit User"
        ]);
        Module::create([
            "module_code" => "002UES",
            "module_name" => "Edit User Self"
        ]);
    }
}
