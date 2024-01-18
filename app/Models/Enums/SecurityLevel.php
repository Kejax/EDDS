<?php

namespace App\Models\Enums;

use OpenApi\Attributes as OA;

// TODO Swagger Docs
enum SecurityLevel: String {

        case LOW = "LOW";
        case MEDIUM = "MEDIUM";
        case HIGH = "HIGH";
        case ANARCHY = "ANARCHY";
        case LAWLESS = "LAWLESS";

}
