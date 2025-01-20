<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class CalendariArbitreMail extends Mailable
{
    use Queueable, SerializesModels;

    public $partits;

    public function __construct($partits)
    {
        $this->partits = $partits;
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.calendari_arbitre',
            with: [
                'partits' => $this->partits,
            ],
        );
    }
}
