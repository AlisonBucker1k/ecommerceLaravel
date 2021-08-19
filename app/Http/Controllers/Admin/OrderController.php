<?php

namespace App\Http\Controllers\Admin;

use App\CustomerProfile;
use App\Enums\OrderHistoryStatus;
use App\Enums\OrderStatus;
use App\Order;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Order::query();
        $filters = $this->filters($query, $request);

        $data['listStatus'] = OrderStatus::getInstances();
        $data['orders'] = $query->orderBy('id', 'desc')->paginate(20);
        $data['filters'] = $filters;
        $data['breadcrumb'] = [
            'Pedidos' => route('orders.list')
        ];

        return view('admin.order.orders', $data);
    }

    /**
     * @param Builder $query
     * @param Request $request
     * @return array
     */
    private function filters(Builder $query, Request $request)
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

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Order $order)
    {
        $data['order'] = $order;
        $data['listStatus'] = OrderHistoryStatus::getAvailableManualHistory();
        $data['statusPending'] = OrderStatus::PENDING;

        return view('admin.order.order', $data);
    }
}