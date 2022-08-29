<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceSend extends Mailable
{
    public $password;
    public $email_to_send;
    public $to_who;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password, $email_to_send, $to_who)
    {
        //
        $this->password = $password;
        $this->email_to_send = $email_to_send;
        $this->to_who = $to_who;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('generated_invoice')->subject('Your Login Details');
    }
}
