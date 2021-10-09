<?php

namespace App\Payments\PagarMe;

use Exception;
use PagarMe\Client;
use PagarMe\PagarMe;

class Transaction extends PagarMe
{
    public function find($transactionId, $amount)
    {
        if (!isset($transactionId)) {
            throw new Exception('Token da transação não informado.');
        }

        $request = [
            'id' => $transactionId,
            'amount' => $amount,
        ];

        $pagarMeClient = new Client(config('app.pagar_me_api_token'));

        return $pagarMeClient->transactions()->capture($request);
    }
}

/*
 TODO TESTAR RETORNO E RETORNAR ESSES DADOS PARA A CRIAÇÃO DO PEDIDO
Retorno:
{
    "object": "transaction",
    "status": "paid",
    "refuse_reason": null,
    "status_reason": "acquirer",
    "acquirer_response_code": "0000",
    "acquirer_name": "pagarme",
    "acquirer_id": "58a49047916d40fa539ba926",
    "authorization_code": "716244",
    "soft_descriptor": null,
    "tid": 1835859,
    "nsu": 1835859,
    "date_created": "2017-08-15T15:51:56.180Z",
    "date_updated": "2017-08-15T15:54:11.366Z",
    "amount": 10000,
    "authorized_amount": 10000,
    "paid_amount": 1000,
    "refunded_amount": 0,
    "installments": 1,
    "id": 1835859,
    "cost": 50,
    "card_holder_name": "Morpheus Fishburne",
    "card_last_digits": "1111",
    "card_first_digits": "411111",
    "card_brand": "visa",
    "card_pin_mode": null,
    "postback_url": null,
    "payment_method": "credit_card",
    "capture_method": "ecommerce",
    "antifraud_score": null,
    "boleto_url": null,
    "boleto_barcode": null,
    "boleto_expiration_date": null,
    "referer": "api_key",
    "ip": "10.2.11.17",
    "subscription_id": null,
    "phone": null,
    "address": null,
    "customer": {
        "object": "customer",
        "id": 234257,
        "external_id": "#3311",
        "type": "individual",
        "country": "br",
        "document_number": null,
        "document_type": "cpf",
        "name": "Morpheus Fishburne",
        "email": "mopheus@nabucodonozor.com",
        "phone_numbers": [
            "+5511999998888",
            "+5511888889999"
        ],
        "born_at": null,
        "birthday": "1965-01-01",
        "gender": null,
        "date_created": "2017-08-15T15:51:56.025Z",
        "documents": [
            {
                "object": "document",
                "id": "doc_cj6drngcv0lnx6m6dt00twpnv",
                "type": "cpf",
                "number": "00000000000"
            }
        ]
    },
    "billing": {
        "address": {
            "object": "address",
            "street": "Rua Matrix",
            "complementary": null,
            "street_number": "9999",
            "neighborhood": "Rio Cotia",
            "city": "Cotia",
            "state": "sp",
            "zipcode": "06714360",
            "country": "br",
            "id": 146607
        },
        "object": "billing",
        "id": 33,
        "name": "Trinity Moss"
    },
    "shipping": {
        "address": {
            "object": "address",
            "street": "Rua Matrix",
            "complementary": null,
            "street_number": "9999",
            "neighborhood": "Rio Cotia",
            "city": "Cotia",
            "state": "sp",
            "zipcode": "06714360",
            "country": "br",
            "id": 146608
        },
        "object": "shipping",
        "id": 27,
        "name": "Neo Reeves",
        "fee": 3311,
        "delivery_date": "2000-12-21",
        "expedited": true
    },
    "items": [
        {
            "object": "item",
            "id": "1",
            "title": "Red pill",
            "unit_price": 12000,
            "quantity": 1,
            "category": null,
            "tangible": true,
            "venue": null,
            "date": null
        },
        {
            "object": "item",
            "id": "a123",
            "title": "Blue pill",
            "unit_price": 12000,
            "quantity": 1,
            "category": null,
            "tangible": true,
            "venue": null,
            "date": null
        }
    ],
    "card": {
        "object": "card",
        "id": "card_cj6drngg90lny6m6djo0coq4p",
        "date_created": "2017-08-15T15:51:56.169Z",
        "date_updated": "2017-08-15T15:51:56.619Z",
        "brand": "visa",
        "holder_name": "Morpheus Fishburne",
        "first_digits": "411111",
        "last_digits": "1111",
        "country": "UNITED STATES",
        "fingerprint": "3ace8040fba3f5c3a0690ea7964ea87d97123437",
        "valid": true,
        "expiration_date": "0922"
    },
    "split_rules": null,
    "metadata": {},
    "antifraud_metadata": {},
    "reference_key": null
}

*/
