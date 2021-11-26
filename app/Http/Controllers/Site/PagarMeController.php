<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Payments\PagarMe\Order as PagarMeOrder;

class PagarMeController extends Controller
{
    public function postBack(Request $request)
    {
        try {
            logTransactionData();

            $pagarMeOrder = new PagarMeOrder();
            $pagarMeOrder->updateOrderStatus($request->post());
        } catch (Exception $e) {
            logTransactionError($e->getMessage());
        }
    }
}
