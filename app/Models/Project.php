<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [
        "id", "created_at", "updated_at"
    ];

    /**
     * Relationship belongsTo user owner
     */
    public function owner()
    {
        return $this->belongsTo(User::class, "owner_user", "id");
    }
}
