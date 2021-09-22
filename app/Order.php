<?php

namespace App;

use App\Enums\OrderHistoryStatus;
use App\Enums\OrderStatus;
use App\General\Shipping;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    public static function getOrders(Request $request)
    {
        $query = self::query();
        self::filters($query, $request);

        return $query;
    }

    public static function filters(Builder $query, Request $request)
    {
        $filters = [];

        if (!empty($request->order_id)) {
            $query->whereId($request->order_id);
        }

        if (is_numeric($request->status)) {
            $query->whereStatus($request->status);
        }

        if (!empty($request->cpf)) {
            $customerProfile = CustomerProfile::query()->where('cpf', $request->cpf)->first();
            $query->where('customer_id', $customerProfile->customer_id ?? 0);
        }

        if (!empty($request->start_created_at) && !empty($request->end_created_at)) {
            $query
                ->whereDate('created_at', '>=', $request->start_created_at, 'and')
                ->whereDate('created_at', '<=', $request->end_created_at)
                ->get();
        }

        return $filters;
    }

    public function getValueFormatedAttribute()
    {
        return currencyFloat2Brl($this->value);
    }

    public function getShippingValueFormatedAttribute()
    {
        return currencyFloat2Brl($this->shipping_value);
    }

    public function getStatusDescriptionAttribute()
    {
        return OrderStatus::getDescription($this->status);
    }

    public function getProductsTotalValueAttribute()
    {
        $total = 0;
        foreach ($this->products as $orderProduct) {
            $total += $orderProduct->subtotal_value;
        }

        return $total;
    }

    public function getProductsTotalValueFormatedAttribute()
    {
        return currencyFloat2Brl($this->products_total_value);
    }

    public function updateStatus($status)
    {
        if ($this->status == OrderStatus::SENT) {
            $this->sent_at = now();
        }

        $this->status = $status;

        $this->update();
    }

    public function cancel()
    {
        $this->updateStatus(OrderStatus::CANCELED);

        $history = new OrderHistory();
        $history->addAutoOrderHistory($this, OrderHistoryStatus::CANCELED);
    }

    public function pay()
    {
        $this->status = OrderStatus::PAID;
        $this->update();

        $history = new OrderHistory();
        $history->addAutoOrderHistory($this, $this->status);
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public function products()
    {
        return $this->hasMany('App\OrderProduct', 'order_id');
    }

    public function histories()
    {
        return $this->hasMany('App\OrderHistory', 'order_id');
    }

    public function invoice()
    {
        return $this->hasOne('App\Invoice');
    }

    public function shipping()
    {
        return $this->hasOne('App\Shipping');
    }

    public function createOrder($customer, int $addressId, int $shippingId)
    {
        $customerId = $customer->id;
        $cart = Cart::getCart($customerId);
        if ($cart->totalProducts() <= 0) {
            throw new Exception('Adicione um produto no carrinho efetuar a compra');
        }

        $address = Address::query()->where(['customer_id' => $customerId, 'id' => $addressId])->first();

        $shipping = new Shipping();
        $result = $shipping->calculate($cart, $address->postal_code, $shippingId);
        if (empty($result)) {
            throw new Exception('Não foi possível calcular o frete, tente novamente mais tarde.');
        }

        $totalValue = $result['value'] + $cart->totalValue();

        $this->customer_id = $customerId;
        $this->address_id = $addressId;
        $this->value = $totalValue;
        $this->shipping_id = $shippingId;
        $this->shipping_description = $result['description'];
        $this->shipping_value = $result['value'];
        $this->shipping_deadline = $result['deadline'];
        $this->shipping_code = null;
        $this->status = OrderStatus::PENDING;
        $this->save();

        $orderProduct = new OrderProduct();
        $orderProduct->addOrderProducts($cart, $this->id);

        $invoice = new Invoice();
        $invoice->createOrderInvoice($customerId, $totalValue, $this->id);
    }

    public function updateShippingCode($newShippingCode)
    {
        $this->shipping_code = $newShippingCode;
        $this->update();
    }
}
