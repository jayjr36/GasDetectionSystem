<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\GasReading;

class FireAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $gasReading;

    /**
     * Create a new message instance.
     */
    public function __construct(GasReading $gasReading)
    {
        $this->gasReading = $gasReading;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Fire Alert Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.fire_alert',
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

    public function build()
    {
        return $this->subject('Fire Detected Alert')
                    ->view('emails.fire_alert')
                    ->with('gasReading', $this->gasReading);
    }
}
