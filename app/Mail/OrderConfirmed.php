<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $order;
    public $products;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $order, $products)
    {
        $this->user = $user;
        $this->order = $order;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Order confirmed";
        return $this->subject($subject)
        ->from('support@phonecases.com')
        ->view('emails.orderConfirmed.confirmed');
    }
}
