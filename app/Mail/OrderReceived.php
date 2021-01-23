<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderReceived extends Mailable
{
    use Queueable, SerializesModels;



    public $user;
    public $order;
    public $products;
    public $deliveryFee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $order, $products, $deliveryFee)
    {
        $this->user = $user;
        $this->order = $order;
        $this->products = $products;
        $this->deliveryFee = $deliveryFee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Order received';
        return $this->subject($subject)
        ->from('support@phonecases.com')
        ->view('emails.orderReceived.received');
    }
}
