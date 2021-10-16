<?php

namespace App\Payments\PagarMe;

use App\Order as UseLadameOrder;
use App\Payments\PagarMe\Enums\OrderPaymentMethod;
use App\Payments\PagarMe\Enums\OrderStatus;
use Exception;
use PagarMe\Client;
use PagarMe\PagarMe;

class Order extends PagarMe
{
    private function validatePostBackSignature()
    {
        $requestBody = file_get_contents('php://input');
        $signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];

        $pagarMe = new Client(config('app.pagar_me_api_token'));
        $isValidPostback = $pagarMe->postbacks()->validate($requestBody, $signature);
        if (!$isValidPostback) {
            throw new Exception('Assinatura inválida.');
        }
    }

    public function updateOrderStatus($postBackResponse)
    {
        $this->validatePostBackSignature();

        if (!$postBackResponse->status == 'success') {
            throw new Exception('Erro no post-back do PagarMe.');
        }

        $order = UseLadameOrder::getFromPagarMeTransactionId($postBackResponse->model_id);
        if (!empty($order) && !empty($order->pagar_me_json)) {
            $pagarMeDecodedJson = json_decode($order->pagar_me_json);
            $pagarMeDecodedJson->status = $postBackResponse->payload->current_status;
            $order->pagar_me_json = json_encode($pagarMeDecodedJson);
            $order->save();
        }
    }

    public static function canCancelBill($orderPagarMeJson)
    {
        $decodedJson = json_decode($orderPagarMeJson);
        if (empty($orderPagarMeJson)) {
            return false;
        }

        return
            $decodedJson->status == OrderStatus::WAITING_PAYMENT
            && $decodedJson->payment_method == OrderPaymentMethod::BILL;
    }

    public static function getOrderStatus($orderPagarMeJson)
    {
        $decodedJson = json_decode($orderPagarMeJson);
        if (empty($orderPagarMeJson)) {
            return '-';
        }

        return OrderStatus::getDescription($decodedJson->status);
    }
}

