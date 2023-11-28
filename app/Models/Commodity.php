<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    use HasFactory;

    protected $table = "commodities";

    protected $fillable = [
        'market_id',
        'name',
        'sell_price',
        'buy_price',
        'demand',
        'stock',
        'mean_price'
    ];

    public function station() {
        return $this->belongsTo(Station::class, 'market_id', 'market_id');
    }
}
