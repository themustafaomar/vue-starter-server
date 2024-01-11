<?php

namespace App\Enums;

use App\Traits\InteractsWithEnums;

enum UserStatus: int
{
    use InteractsWithEnums;

    case ACTIVE = 1;
    case INACTIVE = 2;

    public function getName(): string
    {
        return match($this) {
            self::ACTIVE => 'active',
            self::INACTIVE => 'inactive',
        };
    }

    public function getColor(): string
    {
        return match($this) {
            self::ACTIVE => 'green',
            self::INACTIVE => 'black',
        };
    }
}
