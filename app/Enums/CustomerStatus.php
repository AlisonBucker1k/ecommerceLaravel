<?php

namespace App\Enums;

final class CustomerStatus extends Enum
{
    const INACTIVE = 0;
    const ACTIVE = 1;
    const BLOCKED = 2;
    const REMOVED = 3;
}
