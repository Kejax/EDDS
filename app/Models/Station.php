<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Enums\LandingPlatformSize;
use App\Models\Enums\StationType;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Station',
    properties: [
        new OA\Property(
            property: 'market_id',
            type: 'integer',
            example: 3929121280
        ),
        new OA\Property(
            property: 'name',
            type: 'string',
            example: 'Baibuza Engineering Silo'
        ),
        new OA\Property(
            property: 'system_address',
            type: 'integer',
            example: 2869441275257
        ),
        new OA\Property(
            property: 'distance_from_star',
            type: 'number',
            example: 231
        ),
        new OA\Property(
            property: 'landing_platform_size',
            ref: '#/components/schemas/LandingPlatformSize',
            example: LandingPlatformSize::LARGE
        ),
        new OA\Property(
            property: 'station_type',
            enum: StationType::class,
            example: StationType::SETTLEMENT
        ),
        new OA\Property(
        property: 'station_economies',
                type: 'array',
            items: new OA\Items(
                properties: [
                    new OA\Property(
                        property: 'name',
                        ref: '#/components/schemas/EconomyType'
                    ),
                    new OA\Property(
                        property: 'proportion',
                        type: 'number',
                        example: 0.7
                    )
                ]
            ),
        ),
        new OA\Property(
            property: 'station_government',
            type: 'string',
            ref: '#/components/schemas/GovernmentType'
        ),
        new OA\Property(
            property: 'station_faction',
            type: 'string',
            example: 'Faction'
        ),
        new OA\Property(
            property: 'created_at',
            type: 'string',
            example: '2023-12-23T00:27:45.000000Z'
        ),
        new OA\Property(
            property: 'updated_at',
            type: 'string',
            example: '2023-12-23T00:27:45.000000Z'
        ),
        /*new OA\Property(
            property: 'commodity',
            type: 'array',
            description: 'Only available on certain endpoints',
            items: new OA\Items(
                ref: '#/components/schemas/Commodity'
            )
        ),*/

    ]
)]
class Station extends Model
{
    use HasFactory;

    protected $table = 'stations';

    protected $primaryKey = 'market_id';

    public $incrementing = false;

    protected $fillable = [
        'market_id',
        'name',
        'system_address',
        'distance_from_star',
        'landing_platform_size',
        'station_type',
        'station_economies',
        'station_government',
        'station_faction',
    ];

    protected $casts = [
        'station_economies' => 'array'
    ];

    protected $with = [
        //'commodity'
    ];

    public function commodity(): HasMany {
        return $this->hasMany(Commodity::class, 'market_id', 'market_id');
    }

    public function system() {
        return $this->belongsTo(System::class, 'system_address', 'system_address');
    }

}
