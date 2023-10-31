<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ApplicationExperienceEnum: string
{
    use EnumToArray;

    case LESS_THAN_A_YEAR = '< 1 Tahun';
    case ONE_TO_TWO_YEARS = '1-2 Tahun';
    case THREE_TO_FIVE_YEARS = '3-5 Tahun';
    case MORE_THAN_FIVE_YEARS = '> 5 Tahun';
    case NO_EXPERIENCE = 'Tidak memiliki pengalaman kerja';
}
