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

    public static function nextStepFrom(ApplicationStepEnum $stepEnum): string
    {
        $steps = ApplicationStepEnum::values();
        $stepIndex = array_search($stepEnum->value, $steps);

        return $steps[($stepIndex + 1) % count($steps)];
    }

    public static function onLastStep(ApplicationStepEnum $stepEnum): bool
    {
        $stepEnums = ApplicationStepEnum::values();

        return end($stepEnums) === $stepEnum->value;
    }

    public static function mustHaveReview(ApplicationStepEnum $stepEnum): bool
    {
        return in_array(
            $stepEnum,
            [
                ApplicationStepEnum::TA_INTERVIEW,
                ApplicationStepEnum::USER_INTERVIEW,
                ApplicationStepEnum::FINAL_INTERVIEW
            ],
        );
    }

    public static function getOrderOf(?ApplicationStepEnum $stepEnum = null): false|int
    {
        return is_null($stepEnum)
            ? false
            : array_search($stepEnum->value, ApplicationStepEnum::values()) + 1;
    }
}
