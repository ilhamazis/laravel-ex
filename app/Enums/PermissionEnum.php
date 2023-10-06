<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PermissionEnum: string
{
    use EnumToArray;

    case VIEW_DASHBOARD = 'view_dashboard';
    case VIEW_JOB = 'view_job';
    case CREATE_JOB = 'create_job';
    case UPDATE_JOB = 'update_job';
    case DELETE_JOB = 'delete_job';
    case VIEW_APPLICATION = 'view_application';
    case VIEW_APPLICATION_STEP = 'view_application_step';
    case UPDATE_APPLICATION_STEP = 'update_application_step';
    case VIEW_APPLICATION_REVIEW = 'view_application_review';
    case CREATE_APPLICATION_REVIEW = 'create_application_review';
}
