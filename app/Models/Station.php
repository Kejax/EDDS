<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    protected $table = 'stations';
    protected $fillable = [
        'name',
        'marketId',
        'systemAdress',
        'distanceFromStar',
        'landingPlatformSize',
        'stationType',
        'stationState',
        'stationServices',
        'stationEconomy',
        'stationWealth',
        'stationPopulation',
        'stationGovernment',
        'stationAllegiance',
        'minorFaction'
    ];

    protected $casts = [
        'stationServices' => 'array',
    ];
}
