<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ApplicationStepEnum: string
{
    use EnumToArray;

    case RECRUITER_SCREEN = 'Recruiter Screen';
    case TA_INTERVIEW = 'TA Interview';
    case TECHNICAL_TEST = 'Technical Test';
    case PSYCHOLOGICAL_TEST = 'Psychological Test';
    case USER_INTERVIEW = 'User Interview';
    case FINAL_INTERVIEW = 'Final Interview';

    public static function nextStepFrom(ApplicationStepEnum $stepEnum)
    {
        $steps = ApplicationStepEnum::values();
        $stepIndex = array_search($stepEnum->value, $steps);

        return $steps[($stepIndex + 1) % count($steps)];
    }
}
