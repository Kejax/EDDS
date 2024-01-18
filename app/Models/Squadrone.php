<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Squadrone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'profile_image',
    ];
}
