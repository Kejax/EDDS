<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SquadroneInvitation extends Model
{
    use HasFactory;

    protected $table = 'squadrone_invatation';

    protected $fillable = [
        'code',
        'expiration',
        'limit'
    ];

    public function acceptions() {
        return $this->hasMany(SquadroneInvitatationAcception::class, 'invitation_id', 'id');
    }
}
