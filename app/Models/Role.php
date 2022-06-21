<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [
        "id", "created_at", "updated_at"
    ];

    public function module_roles()
    {
        return $this->hasMany(ModuleRole::class);
    }
}
