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
}
