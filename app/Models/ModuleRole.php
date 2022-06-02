<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleRole extends Model
{
    use HasFactory;
    protected $guarded = [
        "id", "created_at", "updated_at"
    ];

    /**
     * Relationship to roles
     * 
     */
    public function role() 
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relationship to Module
     * 
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
