<?php

namespace App;

use App\Enums\ShippingStatus;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public static function getAllActiveShippings()
    {
        return self::query()->where('status', ShippingStatus::ACTIVE)->get();
    }
}
