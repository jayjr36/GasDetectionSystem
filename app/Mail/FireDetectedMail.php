<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FireDetectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $gasReading;
    /**
     * Create a new message instance.
     */
    public function __construct($gasReading)
    {
        $this->gasReading = $gasReading;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Fire Detected Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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

      /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.fire_detected')
                    ->subject('Fire Detected Alert')
                    ->with([
                        'gasLevel' => $this->gasReading['gas_level'],
                        'timestamp' => $this->gasReading['created_at'],
                    ]);
    }
}
