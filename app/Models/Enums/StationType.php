<?php

namespace App\Models\Enums;

// TODO Swagger Docs
enum StationType:String {

    case ASTEROID = 'Asteroid';
    case BERNAL = 'Bernal'; // Bernal == Orbis
    case CORIOLIS = 'Coriolis';
    case CRATER_OUTPOST = 'CraterOutpost';
    case CRATER_PORT = 'CraterPort';
    case FLEET_CARRIER = 'FleetCarrier';
    case MEGA_SHIP = 'MegaShip';
    case OCELLUS = 'Ocellus';
    case ORBIS = 'Orbis'; // Orbis == Bernal
    case OUTPOST = 'Outpost';
    case SETTLEMENT = 'Settlement';

}

?>
