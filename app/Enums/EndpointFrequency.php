<?php

namespace App\Enums;

enum EndpointFrequency: int
{
    case ONE_MINUTE = 60;
    case THREE_MINUTE = 3 * 60;
    case FIVE_MINUTE = 5 * 60;
    case THIRTY_MINUTE = 30 * 60;
    case ONE_HOUR = 60 * 60;
}
