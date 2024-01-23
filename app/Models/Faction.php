<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faction extends Model
{
    use HasFactory;

    protected $table = 'factions';

    protected $fillable = [
        'name',
        'factionState',
        'government',
        'activeStates'
    ];



}
