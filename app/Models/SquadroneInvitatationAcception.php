<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SquadroneInvitatationAcception extends Model
{
    use HasFactory;

    protected $table = 'squadrone_invitation_acceptions';

    protected $fillable = [
        'invitation_id',
        'user_id',
        'accepted',
        'timestamp',
    ];

    public function invitation() {
        return $this->belongsTo(SquadroneInvitation::class, 'invitation_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function squadroneMember() {
        return $this->belongsTo(SquadroneMember::class, 'user_id', 'id');
    }
}
