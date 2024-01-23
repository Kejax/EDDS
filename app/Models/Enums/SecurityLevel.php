<?php

namespace App\Models\Enums;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'SecurityLevel',
    description: 'The security level of systems',
    type: 'string',
    enum: [
        'LOW',
        'MEDIUM',
        'HIGH',
        'ANARCHY',
        'LAWLESS'
    ]
)]
enum SecurityLevel: String {

        case LOW = "LOW";
        case MEDIUM = "MEDIUM";
        case HIGH = "HIGH";
        case ANARCHY = "ANARCHY";
        case LAWLESS = "LAWLESS";

}
