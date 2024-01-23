<?php

namespace App\Models\Enums;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'GovernmentType',
    type: 'string',
    enum: [
        'ANARCHY',
        'COMMUNIST',
        'CONFEDERACY',
        'COOPERATIVE',
        'CORPORATE',
        'DEMOCRACY',
        'DICTATORSHIP',
        'FEUDAL',
        'PATRONAGE',
        'PRISION_COLONY',
        'THEOCRACY',
        'ENGINEER',
        'NONE',
        'PRISON',
        'PRIVATE_OWNERSHIP'
    ]
)]
enum GovernmentType:String {

    case ANARCHY = 'ANARCHY';
    case COMMUNIST = 'COMMUNIST';
    case CONFEDERACY = 'CONFEDERACY';
    case COOPERATIVE = 'COOPERATIVE';
    case CORPORATE = 'CORPORATE';
    case DEMOCRACY = 'DEMOCRACY';
    case DICTATORSHIP = 'DICTATORSHIP';
    case FEUDAL = 'FEUDAL';
    case PATRONAGE = 'PATRONAGE';
    case PRISION_COLONY = 'PRISION_COLONY';
    case THEOCRACY = 'THEOCRACY';
    case ENGINEER = 'ENGINEER';
    case NONE = 'NONE';
    case PRISON = 'PRISON';
    case PRIVATE_OWNERSHIP = 'PRIVATE_OWNERSHIP';
}
