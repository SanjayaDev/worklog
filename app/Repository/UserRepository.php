<?php namespace App\Repository;

use App\Models\User;

class UserRepository
{
  public function get_all()
  {
    return User::all();
  }

  public function get_paginate($paginate)
  {
    return User::with("role")->paginate($paginate);
  }

  public function get_by_id($id)
  {
    return User::findOrFail($id);
  }

  public function get_by_($column, $value)
  {
    return User::where($column, $value)->first();
  }

  public function create($data)
  {
    return User::create($data);
  }

  public function update($id, $data)
  {
    $user = User::find($id);
    $user->update($data);
    return $user;
  }

  public function delete($id)
  {
    $user = User::find($id);
    $user->delete();
    return $user;
  }
}