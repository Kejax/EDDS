<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Commodity',
    properties: [
        new OA\Property(
            property: 'name',
            type: 'string',
            example: 'iron'
        ),
        new OA\Property(
            property: 'sell_price',
            type: 'integer',
            example: 2
        ),
        new OA\Property(
            property: 'buy_price',
            type: 'integer',
            example: 2
        ),
        new OA\Property(
            property: 'demand',
            type: 'integer',
            example: 2
        ),
        new OA\Property(
            property: 'stock',
            type: 'integer',
            example: 2
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
    ]
)]
class Commodity extends Model
{
    use HasFactory;

    protected $table = "commodities";

    protected $primaryKey = 'market_id';

    protected $fillable = [
        'market_id',
        'name',
        'sell_price',
        'buy_price',
        'demand',
        'stock',
    ];

    protected $hidden = [
        'market_id',
        'id'
    ];

    public function station(): BelongsTo {
        return $this->belongsTo(Station::class, 'market_id', 'market_id');
    }
}
