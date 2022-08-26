<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceSend extends Mailable
{
    public $order_id;
    public $imageName;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_id, $imageName)
    {
        //
        $this->order_id = $order_id;
        $this->imageName = $imageName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('generated_invoice')->subject('Your invoice');
    }
}
