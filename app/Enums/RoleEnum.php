<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum RoleEnum: string
{
    use EnumToArray;

    case HUMAN_CAPITAL = 'Human Capital';
    case INTERVIEWER = 'Interviewer';
}
