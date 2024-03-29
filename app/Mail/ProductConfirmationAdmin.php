<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductConfirmationAdmin extends Mailable
{
    use Queueable, SerializesModels;
    
    public $messageData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $messageData)
    {
        $this->messageData = $messageData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.adminOrderConfirmation')
                    ->subject('Order Confirmation');
    }
}
