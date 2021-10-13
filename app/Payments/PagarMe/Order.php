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
        if (!empty($order->pagar_me_json)) {
            $pagarMeDecodedJson = json_decode($order->pagar_me_json);
            $pagarMeDecodedJson->status = $params->current_status;
            $order->pagar_me_json = json_encode($pagarMeDecodedJson);
            $order->save();
        }
    }
}

