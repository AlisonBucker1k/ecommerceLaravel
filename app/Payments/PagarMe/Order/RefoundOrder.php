<?php

namespace Payments\PagarMe\Order;

use PagarMe\Client;

class RefoundOrder extends Order
{
    // TODO testar estorno
    public function refound($transactionId)
    {
        $client = new Client(config('app.pagar_me_api_token'));

        return $client
            ->transactions()
            ->refund([
                'id' => $transactionId,
            ]);
    }
}
