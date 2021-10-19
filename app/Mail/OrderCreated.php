<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->name = $order->customer->profile->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('gabrielbitti0@gmail.com')
            ->subject('Sua encomenda está a caminho! ')
            ->markdown('emails.order_status.order_created')
            ->with([
                'name' => $this->name,
                'orderUrl' => config('app.url')
                    . '/orders'
            ]);
    }
}
