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
    ];

    protected $casts = [

    ];

    public function arrivalBody() {
        return $this->hasOne(Body::class, 'body_id', 'arrival_body_id')->where('systemAddress', $this->systemAddress);
    }

}
