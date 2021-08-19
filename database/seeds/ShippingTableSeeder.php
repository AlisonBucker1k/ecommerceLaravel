<?php

use App\Shipping;
use Illuminate\Database\Seeder;
use App\Enums;

class ShippingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shipping = new App\Shipping();
        $shipping->id = Enums\Shipping::SEDEX;
        $shipping->description = Enums\Shipping::getDescription(Enums\Shipping::SEDEX);
        $shipping->status = Enums\ShippingStatus::ACTIVE;
        $shipping->save();

        $shipping = new App\Shipping();
        $shipping->id = Enums\Shipping::PAC;
        $shipping->description = Enums\Shipping::getDescription(Enums\Shipping::PAC);
        $shipping->status = Enums\ShippingStatus::ACTIVE;
        $shipping->save();

        $shipping = new App\Shipping();
        $shipping->id = Enums\Shipping::REDEEM_IN_STORE;
        $shipping->description = Enums\Shipping::getDescription(Enums\Shipping::REDEEM_IN_STORE);
        $shipping->status = Enums\ShippingStatus::ACTIVE;
        $shipping->save();

        $shipping = new App\Shipping();
        $shipping->id = Enums\Shipping::LOCAL_SHIPPING;
        $shipping->description = Enums\Shipping::getDescription(Enums\Shipping::LOCAL_SHIPPING);
        $shipping->status = Enums\ShippingStatus::ACTIVE;
        $shipping->save();
    }
}
