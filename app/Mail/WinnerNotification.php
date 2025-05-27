<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WinnerNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     */
    /**
     * @param Collection $lots
     */
    public function __construct(
        public Collection $lots
    ) {
    }

    /**
     * Get the message envelope.
     */
    /**
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Письмо победителю',
        );
    }

    /**
     * Get the message content definition.
     */
    /**
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.winners-mail',
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
