<?php

namespace App\Payments\PagarMe;

use App\Mail\OrderStatusUpdate;
use App\Order as UseLadameOrder;
use App\Payments\PagarMe\Enums\OrderPaymentMethod;
use App\Payments\PagarMe\Enums\OrderStatus;
use Exception;
use Illuminate\Support\Facades\Mail;
use PagarMe\Client;
use PagarMe\PagarMe;

class Order extends PagarMe
{
    protected $pagarMeOrder;

    public function __construct($pagarMeOrderJson)
    {
        $this->pagarMeOrder = self::getDecodedJsonOrFail($pagarMeOrderJson);

        return $this;
    }

    private static function getDecodedJsonOrFail($pagarMeOrderJson)
    {
        $pagarMeOrder = json_decode($pagarMeOrderJson);
        if (empty($pagarMeOrder)) {
            throw new Exception('Pedido inválido');
        }

        return $pagarMeOrder;
    }

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

            Mail::send(new OrderStatusUpdate($order, $order->status, $order->customer->email));
        }
    }

    public function getOrderStatus()
    {
        return OrderStatus::getDescription($this->pagarMeOrder->status);
    }

    public function getOrder()
    {
        $this->pagarMeOrder->status_description = OrderStatus::getDescription($this->pagarMeOrder->status);
        $this->pagarMeOrder->payment_method_description = OrderPaymentMethod::getDescription($this->pagarMeOrder->payment_method);

        return $this->pagarMeOrder;
    }

    public function isPaymentTypeBill()
    {
        return $this->pagarMeOrder->payment_method == OrderPaymentMethod::BILL;
    }

    public function canCancelBill()
    {
        return
            $this->pagarMeOrder->status == OrderStatus::WAITING_PAYMENT
            && $this->pagarMeOrder->payment_method == OrderPaymentMethod::BILL;
    }
}

