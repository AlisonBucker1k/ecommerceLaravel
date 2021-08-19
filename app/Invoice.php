<?php

namespace App;

use App\Enums\Gateway;
use App\Enums\InvoicePaymentType;
use App\Enums\InvoiceStatus;
use App\Enums\InvoiceTransactionStatus;
use App\Enums\InvoiceType;
use App\Enums\OrderHistoryStatus;
use Exception;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Platform\Laravel5\PagSeguro;

class Invoice extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function getStatusDescriptionAttribute()
    {
        return InvoiceStatus::getDescription($this->status);
    }

    public function getTypeDescriptionAttribute()
    {
        return InvoiceType::getDescription($this->type);
    }

    public function getPaymentTypeDescriptionAttribute()
    {
        return InvoicePaymentType::getDescription($this->payment_type);
    }

    public function updateStatus($status)
    {
        $this->status = $status;
        $this->update();
    }

    private function validateCancel()
    {
        if ($this->status != InvoiceStatus::PENDING) {
            throw new Exception('Só é possível cancelar fatura pendente');
        }
    }

    /**
     * @throws Exception
     */
    public function cancel()
    {
        $this->validateCancel();

        $this->status = InvoiceStatus::CANCELED;
        $this->update();

        if ($this->type == InvoiceType::ORDER) {
            $this->order->cancel();
        }
    }

    public function createOrderInvoice(int $customerId, float $value, int $orderId)
    {
        $dateTime = new \DateTime();
        $dueAt = $dateTime->add(new \DateInterval('P5D'));
        $this->customer_id = $customerId;
        $this->description = 'Pedido de produtos';
        $this->type = InvoiceType::ORDER;
        $this->value = $value;
        $this->real_value = $value;
        $this->status = InvoiceStatus::PENDING;
        $this->order_id = $orderId;
        $this->due_at = $dueAt->format('Y-m-d H:i:s');
        $this->save();
    }

    private function validatePayment()
    {
        if (empty($this->payment_type) || !InvoicePaymentType::hasValue($this->payment_type)) {
            throw new Exception('Tipo de pagamento inválido');
        }

        if ($this->status != InvoiceStatus::PENDING && $this->status != InvoiceStatus::AWAITING_CONFIRMATION) {
            throw new Exception('Fatura não aguarda pagamento');
        }
    }

    /**
     * @param $paymentType
     * @return $this
     * @throws Exception
     */
    public function pay($paymentType)
    {
        $this->payment_type = (int) $paymentType;

        $this->validatePayment();

        $this->status = InvoiceStatus::PAID;
        $this->save();

        switch ($this->type) {
            case InvoiceType::ORDER:
                $order = Order::find($this->order_id);
                $order->pay();
                break;
        }

        return $this;
    }

    /**
     * @param Invoice $invoice
     * @return $this
     */
    public function payWithPagSeguro()
    {
        $order = $this->order;
        $customer = $order->customer;
        $customerProfile = $customer->profile;
        $data = [
            'items' => [
                [
                    'id' => $this->id,
                    'description' => "Fatura do Pedido #" . $this->id,
                    'quantity' => 1,
                    'amount' => $this->real_value
                ],
            ],
            'sender' => [
                'email' => $customer->email,
                'name' => $customerProfile->name . ' ' . $customerProfile->last_name,
                'documents' => [
                    [
                        'number' => getOnlyNumber($customerProfile->cpf),
                        'type' => 'CPF'
                    ]
                ],
                'phone' => ['areaCode' => '27', 'number' => '999999999']
            ]
        ];

        if (!empty($customerProfile->cellphone)) {
            $data['sender']['phone'] = [
                'number' => getOnlyPhone($customerProfile->cellphone),
                'areaCode' => getOnlyDdd($customerProfile->cellphone),
            ];
        }

        if (!empty($customerProfile->birth_date)) {
            $data['sender']['bornDate'] = $customerProfile->birth_date;
        }

        $data['reference'] = $this->id;

        $checkout = PagSeguro::checkout()->createFromArray($data);
        $credentials = PagSeguro::credentials()->get();
        $information = $checkout->send($credentials);

        $invoiceTransaction = new InvoiceTransaction();
        $invoiceTransaction->customer_id  = $customer->id;
        $invoiceTransaction->invoice_id = $this->id;
        $invoiceTransaction->url = $information->getLink();
        $invoiceTransaction->value = $this->real_value;
        $invoiceTransaction->code = $information->getCode();
        $invoiceTransaction->gateway = Gateway::PAGSEGURO;
        $invoiceTransaction->save();

        return $invoiceTransaction->url;
    }
}
