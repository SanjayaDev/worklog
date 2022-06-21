<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $guarded = [
        "id", "created_at", "updated_at"
    ];

    /**
     * Relationship to role with modulerole model
     * 
     */
    public function module_roles()
    {
        return $this->hasMany(ModuleRole::class);
    }
}
