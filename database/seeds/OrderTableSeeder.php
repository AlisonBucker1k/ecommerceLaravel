<?php

use App\OrderProduct;
use App\OrderProductVariationItem;
use App\Invoice;
use Illuminate\Database\Seeder;

use App\Order;

class OrderTableSeeder extends Seeder
{
    public function run()
    {
        factory(Order::class, 1)->create()->each(function($order) {
            factory(OrderProduct::class, 5)->create([
                'order_id' => $order->id,
            ])->each(function($orderProduct) {
                factory(OrderProductVariationItem::class, 1)->create([
                    'order_product_id' => $orderProduct->id,
                    'grid_id' => $orderProduct->product->variations()->first()->items()->first()->grid_id,
                    'grid_variation_id' => $orderProduct->product->variations()->first()->items()->first()->grid_variation_id,
                    'product_variation_item_id' => $orderProduct->product->variations()->first()->items()->first()->id,
                ]);
            });

            factory(Invoice::class, 1)->create([
                'order_id' => $order->id,
                'customer_id' => $order->customer_id,
                'value' => $order->value,
            ]);
        });
    }
}