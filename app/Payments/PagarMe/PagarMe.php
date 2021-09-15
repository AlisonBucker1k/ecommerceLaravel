<?php

require('vendor/autoload.php');

$pagarme = new PagarMe\Client(config('PAGAR_ME_API_TOKEN'));