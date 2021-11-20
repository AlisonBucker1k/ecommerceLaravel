<?php

namespace App\Mail;

use App\Enums\OrderHistoryStatus;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderHistoryStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $status;
    protected $order;

    public function __construct(Order $order, $status, $email)
    {
        $this->order = $order;
        $this->status = OrderHistoryStatus::getDescription($status);
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
                'baseUrl' => config('app.url'),
                'orderUrl' => config('app.url') . "/orders/{$this->order->id}",
            ]);
    }
}
