<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum JobStatusEnum: string
{
    use EnumToArray;

    case DRAFT = 'Draft';
    case PUBLISHED = 'Published';
    case CLOSED = 'Closed';

    public static function getBadgeVariant(?JobStatusEnum $jobStatusEnum = null): string
    {
        return match ($jobStatusEnum) {
            JobStatusEnum::PUBLISHED => 'badge_secondary-success',
            JobStatusEnum::CLOSED => 'badge_secondary-danger',
            default => 'badge_secondary-default',
        };
    }
}
