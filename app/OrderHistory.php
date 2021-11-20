<?php

namespace App;

use App\Enums\OrderHistoryStatus;
use App\Enums\OrderStatus;
use App\Enums\UploadPath;
use App\General\Upload;
use App\Mail\OrderHistoryStatusUpdate;
use App\Mail\OrderSended;
use App\Mail\OrderStatusUpdate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class OrderHistory extends Model
{
    protected $fillable = ['user_id', 'order_id', 'status', 'code', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return string
     */
    public function getStatusDescriptionAttribute()
    {
        return OrderHistoryStatus::getDescription($this->status);
    }

    /**
     * @param $attributes
     * @param Order $order
     */
    public function manualStore($attributes, Order $order, $userId)
    {
        $this->attachFile($attributes->file('file'));
        $this->order_id = $order->id;
        $this->status = $attributes->status;
        $this->code = $attributes->code;
        $this->description = $attributes->description;
        $this->user_id = $userId;

        Mail::send(new OrderHistoryStatusUpdate($order, $this->status, $order->customer->email));

        switch ($this->status) {
            case OrderHistoryStatus::SENT:
                $order->updateStatus(OrderStatus::SENT);
                break;
            case OrderHistoryStatus::DELIVERED:
                $order->updateStatus(OrderStatus::DELIVERED);
                break;
            case OrderHistoryStatus::READY_REDEEM:
                $order->updateStatus(OrderStatus::READY_REDEEM);
                break;
        }

        $this->save();
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param $file
     * @return $this
     */
    public function attachFile($file)
    {
        if (!empty($file)) {
            $upload = new Upload($file);
            $url = $upload->save(UploadPath::ORDER_FILES);
            $this->file = $url;
        }

        return $this;
    }

    /**
     * @param Order $order
     * @param $status
     */
    public function addAutoOrderHistory(Order $order, $status)
    {
        $this->order_id = $order->id;
        $this->status = $status;

        $this->save();
    }

    public static function getLastShippingCode(int $orderId)
    {
        return self::query()
            ->select('code')
            ->where(['order_id' => $orderId, 'status' => OrderHistoryStatus::SENT])
            ->orderBy('created_at', 'DESC')
            ->pluck('code')
            ->first();
    }
}
