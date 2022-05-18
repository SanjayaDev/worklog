<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    /**
     * Relationship belongs to user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
