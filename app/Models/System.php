<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'System',
    properties: [
        new OA\Property(
            property: 'name',
            type: 'string',
            example: 'Sol'
        ),
        new OA\Property(
            property: 'system_address',
            type: 'number',
            description: 'The systems Id64',
            example: 99999999999
        ),
        new OA\Property(
            property: 'star_position_x',
            type: 'number',
            example: 0
        ),
        new OA\Property(
            property: 'star_position_y',
            type: 'number',
            example: 0
        ),
        new OA\Property(
            property: 'star_position_z',
            type: 'number',
            example: 0
        ),
        new OA\Property(
            property: 'arrival_body_id',
            type: 'number',
            example: 0
        ),
        new OA\Property(
            property: 'system_economy',
            type: 'string',
            ref: '#/components/schemas/EconomyType',
        ),
        new OA\Property(
            property: 'system_second_economy',
            type: 'string',
            ref: '#/components/schemas/EconomyType',
        ),
        new OA\Property(
            property: 'system_government',
            type: 'string',
            ref: '#/components/schemas/GovernmentType',
        ),
        new OA\Property(
            property: 'system_security',
            type: 'string',
            ref: '#/components/schemas/SecurityLevel',
        ),
        new OA\Property(
            property: 'population',
            type: 'number',
            example: 1000,
        ),
        new OA\Property(
            property: 'system_faction_id',
            description: 'the internal id of the controlling faction',
            type: 'number',
            example: 0,
        ),
        new OA\Property(
            property: 'system_faction_name',
            description: 'The name of the controlling faction',
            type: 'number',
            example: 0,
        )
    ]
)]
class System extends Model
{
    use HasFactory;

    protected $table = 'systems';

    protected $primaryKey = 'system_address';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'system_adress',
        'star_position_x',
        'star_position_y',
        'star_position_z',
        'arrival_body_id',
        'system_economy',
        'system_second_economy',
        'system_government',
        'system_security',
        'population',
        'system_faction_id'
    ];

    protected $casts = [

    ];

    public function stations(): HasMany {
        return $this->hasMany(Station::class, 'system_address', 'system_address');
    }

}
