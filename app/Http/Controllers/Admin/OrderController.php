<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderHistoryStatus;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Mail\OrderStatusUpdate;
use App\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::getOrders($request);

        $data['listStatus'] = OrderStatus::getInstances();
        $data['orders'] = $query->orderBy('id', 'desc')->paginate(20);
        $data['breadcrumb'] = [
            'Pedidos' => route('orders.list')
        ];

        return view('admin.order.orders', $data);
    }

    public function show(Order $order)
    {
        $data['order'] = $order;
        $data['listStatus'] = OrderHistoryStatus::getAvailableManualHistory();
        $data['statusPending'] = OrderStatus::PENDING;

        return view('admin.order.order', $data);
    }

    public function updateShippingCode(Order $order, Request $request)
    {
        $order->updateShippingCode($request->shipping_code);

        return back()->withSuccess('Código de rastreio alterado com sucesso!');
    }
}
