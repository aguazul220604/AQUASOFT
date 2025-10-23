<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $pass;



    public function __construct($user, $pass)
    {
        $this->user = $user;
        $this->pass = $pass;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Usuario registrado',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.mailUser',
            with: [
                'user' => $this->user,
                'pass' => $this->pass,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
