<?php

namespace App\Enum;

enum ComplaintStatusEnum: string
{
    case Posted = 'postado';
    case Validated = 'validado';
    case Notified = 'notificado';
}
