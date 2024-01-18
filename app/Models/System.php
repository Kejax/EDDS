<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// TODO rewrite station properties and add relationships for stations
// TODO Document the Station Schema for Swagger
class System extends Model
{
    use HasFactory;

    protected $table = 'systems';

    protected $fillable = [
        'name',
        'system_adress',
        'star_position_x',
        'star_position_y',
        'star_position_z',
        'system_allegiance',
        'system_economy',
        'system_second_economy',
        'system_government',
        'system_security',
        'population',
        'system_faction_id'
    ];

    protected $casts = [

    ];

    public function stations() {
        $this->hasMany(Station::class, 'system_address', 'system_address');
    }

}
