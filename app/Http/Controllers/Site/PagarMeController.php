<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Payments\PagarMe\Order as PagarMeOrder;

class PagarMeController extends Controller
{
    public function postBack(Request $request): void
    {
        $pagarMeOrder = new PagarMeOrder();
        $pagarMeOrder->updateOrderStatus($request->post());
    }
}
