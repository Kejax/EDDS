<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Station extends Model
{
    use HasFactory;
    protected $table = 'stations';
    protected $fillable = [
        'name',
        'market_id',
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
        'minorFaction',
    ];

    protected $casts = [
        'stationServices' => 'array',
    ];

    public function commodities(): HasMany {
        return $this->hasMany(Commodity::class, 'market_id', 'market_id');
    }
}
