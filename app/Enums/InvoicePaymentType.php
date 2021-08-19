<?php

namespace App\Enums;

final class InvoicePaymentType extends Enum
{
    const CASH = 1;
    const BANK_TRANSFER = 2;
    const DEPOSIT = 3;
    const PAGSEGURO = 4;

    public static function getManualPaymentInstances()
    {
        $instances = self::getInstances();
        unset($instances['PAGSEGURO']);

        return $instances;
    }
}