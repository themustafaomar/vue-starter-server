<?php

namespace App\Enums;

use App\Traits\InteractsWithEnums;

enum MessageType: string
{
    use InteractsWithEnums;

    case TEXT = 'text';
    case VOICE = 'voice';
    case ATTACHMENT = 'attachment';
}
