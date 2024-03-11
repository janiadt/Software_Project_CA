<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Company;
use BelongsTo;

class SolarPanel extends Model
{
    use HasFactory;

    public function users(): BelongsTo
    {
        // Telling laravel that this model has a one-to-many collection with users
        return $this->belongsTo(User::class);
    }

    public function companies(): BelongsTo
    {
        // Telling laravel that this model has a one-to-many collection with users
        return $this->belongsTo(Company::class);
    }
}
