<?php

namespace App\Payments\PagarMe;

use App\Order as UseLadameOrder;
use Exception;
use PagarMe\Client;
use PagarMe\PagarMe;

class Order extends PagarMe
{
    private function validateSignature()
    {
        $requestBody = file_get_contents("php://input");
        $signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];

        $pagarMe = new Client(config('app.pagar_me_api_token'));
        $isValidPostback = $pagarMe->postbacks()->validate($requestBody, $signature);
        if (!$isValidPostback) {
            throw new Exception('Invalid Signature.');
        }
    }

    public function updateOrderStatus($params)
    {
        $this->validateSignature();

        $order = UseLadameOrder::getFromPagarMeTransactionId($params->id);
        $order->status = $params->current_status;
        $order->save();

        // TODO criar histórico de processamento dos pedidos? — Talvez usar tablela order_hirstory
    }
}

