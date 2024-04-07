<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Company;

class SolarPanel extends Model
{
    use HasFactory;

    public function users()
    {
        // Telling laravel that this model has a one-to-many collection with users
        return $this->belongsTo(User::class, 'user_id');
    }

    public function companies()
    {
        // Telling laravel that this model has a one-to-many collection with users
        return $this->belongsTo(Company::class, 'company_id');
    }
}
