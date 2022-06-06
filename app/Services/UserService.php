<?php namespace App\Services;

use App\Repository\UserRepository;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
  private $user_repository;

  public function __construct()
  {
    $this->user_repository = new UserRepository;
  }

  /**
   * Get user paginate
   * 
   */
  public function get_paginate()
  {
    return $this->user_repository->get_paginate(10);
  }

  /**
   * Store User
   * 
   * @param UserRequest $request
   * @return User
   */
  public function store_user(UserRequest $request)
  {
    $values = $request->validated();

    if (Auth::user()->role_id != 1) {
      $values["role_id"] = Role::where("id", 3)->values("id");
    }

    $values["password"] = Hash::make($values["password"]);

    try {
      $user = $this->user_repository->create($values);

      return $user->id;
    } catch (\Exception $e) {
      Log::error($e->getMessage(), ["trace" => $e->getTrace()]);
      return FALSE;
    }
  }

  /**
   * Get user by id
   * 
   * @param int $user_id
   * @return User
   */
  public function get_by_id($user_id)
  {
    return $this->user_repository->get_by_id($user_id);
  }

  /**
   * Update user
   * 
   * @param UserRequest $request
   * @param int $user_id
   */
  public function update_user(UserRequest $request, $user_id)
  {
    $user = $this->user_repository->get_by_id($user_id);
    $values = $request->validated();

    if (Auth::user()->role_id != 1) {
      $values["role_id"] = Role::where("id", 3)->values("id");
    }

    if (!empty($values["password"])) {
        $values["password"] = Hash::make($values["password"]);
    } else {
        unset($values["password"]);
    }

    try {
      $user->update($values);

      return TRUE;
    } catch (\Exception $e) {
      Log::error($e->getMessage(), ["Trace" => $e->getTrace()]);
      return FALSE;
    }
  }
}