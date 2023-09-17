<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    protected $table = 'systems';
    protected $fillabel = [
        'name',
        'systemAdress',
        'starPositionX',
        'starPositionY',
        'starPositionZ',
        'systemAllegiance',
        'systemEconomy',
        'systemSecondEconomy',
        'systemGovernment',
        'systemSecurity',
        'population',
        'factions',
        'marketIds'
    ];

    protected $casts = [
        'marketIds' => 'array'
    ];

}
