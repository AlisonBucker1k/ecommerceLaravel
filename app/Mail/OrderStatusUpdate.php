<?php

namespace App\Mail;

use App\Enums\OrderHistoryStatus;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $status)
    {
        $this->status = OrderHistoryStatus::getDescription($status);
        $this->name = $order->customer->profile->name;
        $this->email = $order->customer->email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
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
                'orderUrl' => config('ap,p.url') . '/orders',
            ]);
    }
}
