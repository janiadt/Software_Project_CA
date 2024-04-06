<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class ErrorReport extends Model
{
    use HasFactory;

    public function users()
    {
        // Telling laravel that this model has a one-to-many collection with users
        return $this->belongsTo(User::class, 'user_id');

    }

    // Making an array of all the severity values
    public static function arr(){
        return $array = ["Minimal Error","Minor Error","Medium Error","Major Error","Fatal Error"];
    }
}
