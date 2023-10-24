<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ApplicationStepStatusEnum: string
{
    use EnumToArray;

    case ONGOING = 'Ongoing';
    case REJECTED = 'Rejected';
    case PASSED = 'Passed';

    public static function getStepperItemVariant(?ApplicationStepStatusEnum $stepStatusEnum = null): string|null
    {
        return match ($stepStatusEnum) {
            ApplicationStepStatusEnum::PASSED => 'check',
            ApplicationStepStatusEnum::ONGOING => 'current',
            ApplicationStepStatusEnum::REJECTED => 'fail',
            default => null,
        };
    }
}
