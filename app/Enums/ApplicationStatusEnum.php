<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ApplicationStatusEnum: string
{
    use EnumToArray;

    case ONGOING = 'Ongoing';
    case REJECTED = 'Rejected';
    case HIRED = 'Hired';

    public static function getBadgeVariant(?ApplicationStatusEnum $applicationStatusEnum = null): string
    {
        return match ($applicationStatusEnum) {
            ApplicationStatusEnum::HIRED => 'badge_secondary-success',
            ApplicationStatusEnum::REJECTED => 'badge_secondary-danger',
            default => 'badge_secondary-primary',
        };
    }
}
