<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payments\PagarMe\Order as PagarMeOrder;

class PagarMeController extends Controller
{
    public function postBack(Request $request): void
    {
        $pagarMeOrder = new PagarMeOrder();
        $pagarMeOrder->updateOrderStatus($request->post());
    }
}
