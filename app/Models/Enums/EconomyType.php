<?php

namespace App\Models\Enums;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'EconomyType',
    type: 'string',
    enum: [
        'EXTRACTION',
        'REFINERY',
        'INDUSTRIAL',
        'HIGH_TECH',
        'AGRICULTURE',
        'TERRAFORMING',
        'TOURISM',
        'SERVICE',
        'MILITARY',
        'COLONY',
        'RESCUE',
        'DAMAGED',
        'REPAIR',
        'PRIVATE_ENTERPRISE'
    ]
)]
enum EconomyType: String {

    case EXTRACTION = 'EXTRACTION';
    case REFINERY = 'REFINERY';
    case INDUSTRIAL = 'INDUSTRIAL';
    case HIGH_TECH = 'HIGH_TECH';
    case AGRICULTURE = 'AGRICULTURE';
    case TERRAFORMING = 'TERRAFORMING';
    case TOURISM = 'TOURISM';
    case SERVICE = 'SERVICE';
    case MILITARY = 'MILITARY';
    case COLONY = 'COLONY';
    case RESCUE = 'RESCUE';
    case DAMAGED = 'DAMAGED';
    case REPAIR = 'REPAIR';
    case PRIVATE_ENTERPRISE = 'PRIVATE_ENTERPRISE';

}
