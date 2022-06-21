<?php namespace App\Services;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Repository\RoleRepository;
use Illuminate\Support\Facades\Log;

class RoleService
{
  private $role_repository;

  public function __construct()
  {
    $this->role_repository = new RoleRepository;
  }

  public function store(RoleRequest $request)
  {
    $values = $request->validated();

    try {
      $role = Role::create($values);
      return $role->id;
    } catch (\Exception $e) {
      Log::error($e->getMessage(), ["trace" => $e->getTrace()]);
      return FALSE;
    }
  }

  public function get_module($role_id)
  {
    return $this->role_repository->get_module($role_id);
  }
}