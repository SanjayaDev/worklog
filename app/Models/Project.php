<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * Relationship has many through users
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users');
    }

    /**
     * Relationship has many user
     */
    public function users_pivot()
    {
        return $this->hasMany(ProjectUser::class);
    }

    /**
     * Relationship has many assignments
     */
    public function assignments()
    {
        return $this->hasMany(Assignment::class)->with("user");
    }
}
