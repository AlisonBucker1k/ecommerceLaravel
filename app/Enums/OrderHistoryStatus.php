<?php

namespace App\Enums;

final class OrderHistoryStatus extends Enum
{
    const PENDING = 0;
    const PAID = 1;
    const CANCELED = 2;
    const EMITTING_NF  = 3;
    const SENT = 4;
    const DELIVERED = 5;
    const READY_REDEEM = 6;
    const PRIVATE_INFO = 7;

    public static function getAvailableManualHistory()
    {
        $instances = self::getInstances();

        unset($instances['PENDING']);
        unset($instances['PAID']);
        unset($instances['CANCELED']);

        return $instances;
    }
}
