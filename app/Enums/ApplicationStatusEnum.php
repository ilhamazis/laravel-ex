<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ApplicationStatusEnum: string
{
    use EnumToArray;

    case ONGOING = 'Ongoing';
    case REJECTED = 'Rejected';
    case HIRED = 'Hired';
}
