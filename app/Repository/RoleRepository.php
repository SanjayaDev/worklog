<?php namespace App\Repository;

use App\Models\Module;
use App\Models\Role;

class RoleRepository
{
  public function create($values)
  {
    return Role::create($values);
  }

  public function update($id, $values)
  {
    return Role::find($id)->update($values);
  }

  public function show($id)
  {
    return Role::find($id);
  }

  public function get_module($role_id)
  {
    return Module::with(["module_roles" => function($query) use ($role_id) {
      $query->where("role_id", $role_id);
    }])->get();
  }
}