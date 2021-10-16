<?php

namespace App\Payments\PagarMe\Enums;

use App\Enums\Enum;

final class OrderStatus extends Enum
{
    const PROCESSING = 'processing';
    const AUTHORIZED = 'authorized';
    const PAID = 'paid';
    const REFUNDED = 'refunded';
    const WAITING_PAYMENT = 'waiting_payment';
    const PENDING_REFUND = 'pending_refund';
    const REFUSED = 'refused';
    const CHARGED_BACK = 'chargedback';
    const ANALYZING = 'analyzing';
    const PENDING_REVIEW = 'pending_review';
}
