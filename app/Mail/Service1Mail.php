<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Service1Mail extends Mailable
{
    use Queueable, SerializesModels;

    public $paymentId;
    public $service;
    public $qrContent;
    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($paymentId, $service, $qrContent, $data)
    {
        $this->paymentId = $paymentId;
        $this->service = $service;
        $this->qrContent = $qrContent;
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.service1')
            ->subject('Tu Ticket')
            ->attachData($this->qrContent, 'qr_code.png', [
                'mime' => 'image/png',
            ])
            ->attach(public_path('images/img2wp.png'), [
                'as' => 'logo.png',
                'mime' => 'image/png',
            ]);
    }
}
