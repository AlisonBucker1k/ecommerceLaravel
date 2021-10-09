<?php

namespace App\Payments\PagarMe;

use Exception;
use PagarMe\Client;
use PagarMe\PagarMe;

class Transaction extends PagarMe
{
    public function getTransaction($transactionId)
    {
        if (!isset($transactionId)) {
            throw new Exception('Token da transação não informado.');
        }

        $pagarMeClient = new Client(config('app.pagar_me_api_token'));
        $transaction = $pagarMeClient->transactions()->capture($transactionId);

        return json_encode($transaction);
    }
}
