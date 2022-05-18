<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [
        "project_id", "created_at", "updated_at"
    ];

    /**
     * Relationship has many through users
     */
    public function users()
    {
        return $this->belongsToMany(User::class, ProjectUser::class)->withTimestamps();
    }

    /**
     * Relationship has many assignments
     */
    public function assignments()
    {
        return $this->hasMany(Assignment::class)->with("user");
    }
}
