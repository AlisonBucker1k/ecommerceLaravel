<?php

namespace App\Payments\PagarMe\Enums;

use App\Enums\Enum;

final class OrderPaymentMethod extends Enum
{
    const CREDIT_CARD = 'credit_card';
    const BILL = 'boleto';
    const PIX = 'pix';
}
