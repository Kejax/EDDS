<?php

namespace App\Models\Enums;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'LandingPlatformSize',
    type: 'string',
    enum: [
        'SMALL',
        'MEDIUM',
        'LARGE'
    ]
)]
enum LandingPlatformSize:String {

    case SMALL = 'SMALL';
    case MEDIUM = 'MEDIUM';
    case LARGE = 'LARGE';
}
