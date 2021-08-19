<?php

namespace App\Enums;

final class InvoiceTransactionStatus extends Enum
{
    const AWAITING_PAYMENT  = 0;
    const PAID              = 1;
    const REFUSED           = 2;
    const REVERSED          = 3;
    const CANCELED          = 4;
    const DISPUTED          = 5;
    const REVIEW            = 6;
    const AVAILABLE         = 7;
}