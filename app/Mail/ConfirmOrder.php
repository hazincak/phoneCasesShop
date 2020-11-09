<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmOrder extends Mailable
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
        $subject = 'Potvrdenie prijatia Vašej objednávky';
        return $this->subject($subject)
        ->from('jan.hazincak@example.com')
        ->view('emails.ordersConfirmed.confirmed');
    }
}
