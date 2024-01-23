<?php

namespace App\Models\Enums;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'StationType',
    description: 'Be aware that the API accepts \'BERNAL\' as an alias to \'ORBIS\', but always returns \'ORBIS\'',
    type: 'string',
    enum: [
        'ASTEROID',
        'BERNAL',
        'CORIOLIS',
        'CRATER_OUTPOST',
        'CRATER_PORT',
        'FLEET_CARRIER',
        'MEGA_SHIP',
        'OCELLUS',
        'ORBIS',
        'OUTPOST',
        'SETTLEMENT'
    ]
)]
enum StationType: String {

    case ASTEROID = 'ASTEROID';
    case BERNAL = 'BERNAL'; // Bernal == Orbis
    case CORIOLIS = 'CORIOLIS';
    case CRATER_OUTPOST = 'CRATER_OUTPOST';
    case CRATER_PORT = 'CRATER_PORT';
    case FLEET_CARRIER = 'FLEET_CARRIER';
    case MEGA_SHIP = 'MEGA_SHIP';
    case OCELLUS = 'OCELLUS';
    case ORBIS = 'ORBIS'; // Orbis == Bernal
    case OUTPOST = 'OUTPOST';
    case SETTLEMENT = 'SETTLEMENT';

}

?>
