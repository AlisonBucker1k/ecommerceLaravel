<?php

namespace App\Http\Controllers\Site;

use App\Enums\OrderHistoryStatus;
use App\Enums\OrderStatus;
use App\Invoice;
use App\Order;
use App\Http\Controllers\Controller;
use App\OrderHistory;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orders()
    {
        $data['pendingStatus'] = OrderStatus::PENDING;
        $data['orders'] = auth()->user()->orders()->paginate(10);
        $data['breadcrumb'] = [
            'Pedidos' => route('panel.orders')
        ];

        return view('site.panel.customer.orders', $data);
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Order $order)
    {
        if ($order->customer_id != auth()->id()) {
            return back()->withErrors('Pedido não encontrado.');
        }

        $data['shippingCode'] = OrderHistory::getLastShippingCode($order->id);
        $data['orderHistorySentStatus'] = OrderHistoryStatus::SENT;
        $data['order'] = $order;
        $data['histories'] = $order->histories->where('status', '!=', OrderHistoryStatus::PRIVATE_INFO);
        $data['breadcrumb'] = [
            'Pedidos' => route('panel.orders'),
            'Detalhes do Pedido' => route('panel.order.show', $order->id)
        ];

        return view('site.panel.customer.order', $data);
    }

    public function destroy(Order $order)
    {
        DB::beginTransaction();
        try {
            $order->invoice->cancel();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors($e->getMessage());
        }

        return redirect()->route('panel.order.show', $order)->withSuccess('Pedido cancelado com sucesso!');
    }


}
