<?php

use App\Invoice;
use App\Order;
use App\OrderProduct;
use App\OrderProductVariationItem;
use Illuminate\Database\Seeder;
use App\Customer;
use App\Address;
use App\CustomerProfile;

class CustomerTableSeeder extends Seeder
{
    public function run()
    {
        factory(Customer::class, 20)->create()->each(function($customer) {
            factory(CustomerProfile::class)->create([
                'customer_id' => $customer->id
            ]);

            factory(Address::class)->create([
                'customer_id' => $customer->id,
                'main' => 1,
                'status' => 1,
            ]);

            factory(Order::class, 1)->create([
                'customer_id' => $customer->id,
                'address_id' => $customer->mainAddress()->first()->id,
            ])->each(function($order) {
                factory(OrderProduct::class, 5)->create([
                    'order_id' => $order->id,
                ])->each(function($orderProduct) {
                    factory(OrderProductVariationItem::class, 1)->create([
                        'order_product_id' => $orderProduct->id,
                        'product_variation_item_id' => $orderProduct->product->variations()->first()->items()->first()->id,
                        'grid_description' => $orderProduct->product->variations()->first()->items()->first()->productGrid()->first()->grid()->first()->description,
                        'grid_variation_description' => $orderProduct->product->variations()->first()->items()->first()->productGrid()->first()->grid()->first()->variations()->first()->description,
                    ]);
                });

                factory(Invoice::class, 1)->create([
                    'order_id' => $order->id,
                    'customer_id' => $order->customer_id,
                    'value' => $order->value,
                ]);
            });
        });
    }

}