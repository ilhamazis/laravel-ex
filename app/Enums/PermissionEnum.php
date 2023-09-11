<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PermissionEnum: string
{
    use EnumToArray;

    case VIEW_DASHBOARD = 'view_dashboard';
}
