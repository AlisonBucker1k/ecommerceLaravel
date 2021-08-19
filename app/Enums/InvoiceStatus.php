<?php

namespace App\Enums;

final class InvoiceStatus extends Enum
{
    const PENDING = 0;
    const PAID = 1;
    const AWAITING_CONFIRMATION = 2;
    const CANCELED = 3;
}
