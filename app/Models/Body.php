<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Body extends Model
{
    use HasFactory;

    protected $table = 'bodies';

    protected $fillable = [
        'systemAddress',
        'body_id'
    ];

    public function system() {
        return $this->belongsTo(System::class, 'systemAddress', 'systemAddress');
    }
}
