<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ApplicationStepStatusEnum: string
{
    use EnumToArray;

    case ONGOING = 'Ongoing';
    case REJECTED = 'Rejected';
    case PASSED = 'Passed';
}
