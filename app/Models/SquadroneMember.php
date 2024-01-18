<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SquadroneMember extends Model
{
    use HasFactory;

    protected $table = 'squadrone_members';

    protected $fillable = [
        'id',
    ];

    public function squadrone() {
        return $this->belongsTo(Squadrone::class, 'squadrone_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
