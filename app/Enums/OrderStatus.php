<?php

namespace App\Enums;

final class OrderStatus extends Enum
{
    const PENDING = 0;
    const PAID = 1;
    const CANCELED = 2;
    const SENT = 3;
    const DELIVERED = 4;
    const READY_REDEEM = 5;
}