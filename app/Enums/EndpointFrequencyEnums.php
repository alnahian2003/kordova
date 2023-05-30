<?php

namespace App\Enums;

enum EndpointFrequencyEnums: int
{
    case ONE_MINUTE = 60;
    case THREE_MINUTE = 3 * 60;
    case FIVE_MINUTE = 5 * 60;
    case THIRTY_MINUTE = 30 * 60;
    case ONE_HOUR = 60 * 60;
    case TWELVE_HOUR = 12 * 60 * 60;
    case ONE_DAY = 24 * 60 * 60;

    public function label(): string
    {
        return match ($this) {
            self::ONE_MINUTE => '1 minute',
            self::THREE_MINUTE => '3 minutes',
            self::FIVE_MINUTE => '5 minutes',
            self::THIRTY_MINUTE => '30 minutes',
            self::ONE_HOUR => '1 hour',
            self::TWELVE_HOUR => '12 hours',
            self::ONE_DAY => '1 day',
        };
    }
}
