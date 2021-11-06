<?php

use App\Enums;
use App\Payments\PagarMe\Enums as PagarMeEnums;

return [

    Enums\CustomerStatus::class => [
        Enums\CustomerStatus::INACTIVE => 'Inativo',
        Enums\CustomerStatus::ACTIVE => 'Ativo',
        Enums\CustomerStatus::BLOCKED => 'Bloqueado',
        Enums\CustomerStatus::REMOVED => 'Removido',
    ],

    Enums\UserStatus::class => [
        Enums\UserStatus::INACTIVE => 'Inativo',
        Enums\UserStatus::ACTIVE => 'Ativo'
    ],

    Enums\CategoryStatus::class => [
        Enums\CategoryStatus::INACTIVE => 'Inativo',
        Enums\CategoryStatus::ACTIVE => 'Ativo'
    ],

    Enums\GridStatus::class => [
        Enums\GridStatus::INACTIVE => 'Inativo',
        Enums\GridStatus::ACTIVE => 'Ativo'
    ],

    Enums\GridVariationStatus::class => [
        Enums\GridStatus::INACTIVE => 'Inativo',
        Enums\GridStatus::ACTIVE => 'Ativo'
    ],

    Enums\SubcategoryStatus::class => [
        Enums\SubcategoryStatus::INACTIVE => 'Inativo',
        Enums\SubcategoryStatus::ACTIVE => 'Ativo'
    ],

    Enums\AddressStatus::class => [
        Enums\AddressStatus::INACTIVE => 'Inativo',
        Enums\AddressStatus::ACTIVE => 'Ativo'
    ],

    Enums\AddressMain::class => [
        Enums\AddressMain::NOT => 'Não',
        Enums\AddressMain::YES => 'Sim'
    ],

    Enums\ProductStatus::class => [
        Enums\ProductStatus::INACTIVE => 'Inativo',
        Enums\ProductStatus::ACTIVE => 'Ativo',
    ],

    Enums\ProductVariationStatus::class => [
        Enums\ProductVariationStatus::INACTIVE => 'Inativo',
        Enums\ProductVariationStatus::ACTIVE => 'Ativo',
    ],

    Enums\InvoiceStatus::class => [
        Enums\InvoiceStatus::PENDING => 'Aguardando Pagamento',
        Enums\InvoiceStatus::PAID => 'Pago',
        Enums\InvoiceStatus::AWAITING_CONFIRMATION => 'Aguardando Confirmação',
        Enums\InvoiceStatus::CANCELED => 'Cancelado',
    ],

    Enums\InvoiceType::class => [
        Enums\InvoiceType::ORDER => 'Pedido'
    ],

    Enums\InvoicePaymentType::class => [
        Enums\InvoicePaymentType::CASH => 'Dinheiro',
        Enums\InvoicePaymentType::BANK_TRANSFER => 'Transferência Bancaria',
        Enums\InvoicePaymentType::DEPOSIT => 'Depósito',
        Enums\InvoicePaymentType::PAGSEGURO => 'Pagseguro',
    ],

    Enums\OrderStatus::class => [
        Enums\OrderStatus::PENDING => 'Aguardando Pagamento',
        Enums\OrderStatus::PAID => 'Pago',
        Enums\OrderStatus::CANCELED => 'Cancelado',
        Enums\OrderStatus::SENT => 'Enviado',
        Enums\OrderStatus::DELIVERED => 'Entregue',
        Enums\OrderStatus::READY_REDEEM => 'Pronto Para Retirada',
    ],

    Enums\OrderHistoryStatus::class => [
        Enums\OrderHistoryStatus::PENDING => 'Aguardando Pagamento',
        Enums\OrderHistoryStatus::PAID => 'Pago',
        Enums\OrderHistoryStatus::CANCELED => 'Cancelado',
        Enums\OrderHistoryStatus::EMITTING_NF => 'Emitindo Nota Fiscal',
        Enums\OrderHistoryStatus::SENT => 'Enviado',
        Enums\OrderHistoryStatus::DELIVERED => 'Entregue',
        Enums\OrderHistoryStatus::READY_REDEEM => 'Pronto Para Retirada',
        Enums\OrderHistoryStatus::PRIVATE_INFO => 'Informação Interna',
    ],

    Enums\Shipping::class => [
        Enums\Shipping::SEDEX => 'Sedex',
        Enums\Shipping::PAC => 'PAC',
        Enums\Shipping::REDEEM_IN_STORE => 'Retirar na Loja',
        Enums\Shipping::LOCAL_SHIPPING => 'Entrega Local'
    ],

    Enums\ShippingStatus::class => [
        Enums\ShippingStatus::INACTIVE => 'Inativo',
        Enums\ShippingStatus::ACTIVE => 'Ativo',
    ],
    
    Enums\HighLightedProduct::class => [
        Enums\HighLightedProduct::NOT => 'Não',
        Enums\HighLightedProduct::YES => 'Sim',
    ],

    PagarMeEnums\OrderStatus::class => [
        PagarMeEnums\OrderStatus::PROCESSING => 'Em processo de autorização',
        PagarMeEnums\OrderStatus::AUTHORIZED => 'Autorizado',
        PagarMeEnums\OrderStatus::PAID => 'Pago',
        PagarMeEnums\OrderStatus::REFUNDED => 'Estornado',
        PagarMeEnums\OrderStatus::WAITING_PAYMENT => 'Aguardando pagamento',
        PagarMeEnums\OrderStatus::PENDING_REFUND => 'Aguardando estorno',
        PagarMeEnums\OrderStatus::REFUSED => 'Não autorizado',
        PagarMeEnums\OrderStatus::CHARGED_BACK => 'A transação sofreu chargeback',
        PagarMeEnums\OrderStatus::ANALYZING => 'Análise antifraude',
        PagarMeEnums\OrderStatus::PENDING_REVIEW => 'Aguardando análise',
    ],

];
