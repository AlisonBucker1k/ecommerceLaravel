<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSended extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
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
            ->subject('Sua encomenda está a caminho!')
            ->markdown('emails.order_status.order_sent')
            ->with([
                'name' => $this->name,
                'baseUrl' => config('app.url'),
                'orderUrl' => config('app.url') . '/orders'
            ]);
    }
}
