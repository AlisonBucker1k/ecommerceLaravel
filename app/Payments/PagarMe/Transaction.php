<?php

namespace App\Payments\PagarMe;

use Exception;
use PagarMe\Client;
use PagarMe\PagarMe;
use stdClass;

class Transaction extends PagarMe
{
    public $transaction;

    /**
     * @throws Exception
     */
    public function find($transactionId, $amount): Transaction
    {
        if (!isset($transactionId)) {
            throw new Exception('Token da transação não informado.');
        }

        $request = [
            'id' => $transactionId,
            'amount' => $amount,
        ];""

        $pagarMeClient = new Client(config('app.pagar_me_api_token'));
        $transaction = $pagarMeClient->transactions()->capture($request);
        $this->setTransaction($transaction);

        return $this;
    }

    public function toJson()
    {
        return json_encode($this->transaction);
    }

    private function setTransaction($transaction): void
    {
        $this->transaction = new stdClass();
        $this->transaction->id = $transaction->id;
        $this->transaction->status = $transaction->status;
        $this->transaction->installments = $transaction->installments;
        $this->transaction->boleto_url = $transaction->boleto_url;
        $this->transaction->payment_method = $transaction->payment_method;
    }
}
