<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\OrderHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderHistoryController extends Controller
{
    public function store(Request $request, Order $order)
    {
        DB::transaction(function () use ($request, $order) {
            $orderHistory = new OrderHistory();
            $orderHistory->manualStore($request, $order, auth()->id());
        });

        return back()->withSuccess('Histórico cadastrado com sucesso!');
    }
}