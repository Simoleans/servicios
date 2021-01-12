<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationEndsubscription extends Mailable
{
    use Queueable, SerializesModels;

    public $subscripcion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscripcion)
    {
        $this->subscripcion = $subscripcion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.aviso');
    }
}
