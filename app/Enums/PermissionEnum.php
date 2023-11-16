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
    case VIEW_APPLICATION_COMMUNICATION = 'view_application_communication';
    case CREATE_APPLICATION_COMMUNICATION = 'create_application_communication';
    case VIEW_APPLICATION_REVIEW = 'view_application_review';
    case CREATE_APPLICATION_REVIEW = 'create_application_review';
    case VIEW_APPLICATION_NOTE = 'view_application_note';
    case CREATE_APPLICATION_NOTE = 'create_application_note';
    case VIEW_APPLICATION_ATTACHMENT = 'view_application_attachment';
    case CREATE_APPLICATION_ATTACHMENT = 'create_application_attachment';
    case DELETE_APPLICATION_ATTACHMENT = 'delete_application_attachment';
    case VIEW_TEMPLATE = 'view_template';
    case CREATE_TEMPLATE = 'create_template';
    case UPDATE_TEMPLATE = 'update_template';
    case DELETE_TEMPLATE = 'delete_template';
}
