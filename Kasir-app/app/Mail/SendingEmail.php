<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailable\Address;
use Illuminate\Queue\SerializesModels;

class SendingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $produk;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($produk)
    {
        $this->produk = $produk;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Email.mail');

        // return $this->from('admin@mail.com', 'Admin 1')
        //         ->view('Email.mail');
    }


}
