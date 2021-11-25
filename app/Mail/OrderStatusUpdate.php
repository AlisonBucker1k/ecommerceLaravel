<?php

namespace App\Mail;

use App\Enums\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $status;
    protected $order;

    public function __construct($order, $status, $email)
    {
        $this->order = $order;
        $this->status = OrderStatus::getDescription($status);
        $this->name = $order->customer->profile->name;
        $this->email = $email;
    }

    public function build()
    {
        return $this
            ->to($this->email)
            ->subject('Pedido atualizado!')
            ->markdown('emails.order_status.status_updated')
            ->with([
                'name' => $this->name,
                'status' => $this->status,
                'order' => $this->order,
                'baseUrl' => config('app.url'),
                'orderUrl' => config('app.url') . "/orders/{$this->order->id}",
            ]);
    }
}
