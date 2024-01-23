<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Body extends Model
{
    use HasFactory;

    protected $table = 'bodies';

    protected $fillable = [
        'system_address',
        'body_id',
        'parent_id',
    ];

    public function system() {
        return $this->belongsTo(System::class, 'system_address', 'system_address');
    }
}
