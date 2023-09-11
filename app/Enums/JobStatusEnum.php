<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum JobStatusEnum: string
{
    use EnumToArray;

    case DRAFT = 'Draft';
    case PUBLISHED = 'Published';
    case CLOSED = 'Closed';
}
