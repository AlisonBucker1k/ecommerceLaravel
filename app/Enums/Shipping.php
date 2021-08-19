<?php

namespace App\Enums;

final class Shipping extends Enum
{
    const SEDEX = 1;
    const PAC = 2;
    const REDEEM_IN_STORE = 3;
    const LOCAL_SHIPPING = 4;
}
