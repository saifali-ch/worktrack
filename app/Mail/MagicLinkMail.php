<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MagicLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $url;

    public function __construct($url) {
        $this->url = $url;
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Magic Link | Login to your account',
        );
    }

    public function content(): Content {
        return new Content(
            markdown: 'emails.magic-link',
        );
    }

    public function attachments(): array {
        return [];
    }
}
