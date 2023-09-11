<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum JobTypeEnum: string
{
    use EnumToArray;

    case FULLTIME = 'Fulltime';
    case INTERNSHIP = 'Internship';
    case FREELANCE = 'Freelance';
}
