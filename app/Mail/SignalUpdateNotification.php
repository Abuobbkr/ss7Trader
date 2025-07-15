<?php

namespace App\Mail;

use App\Models\Signal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SignalUpdateNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The signal instance.
     *
     * @var \App\Models\Signal
     */
    public $signal;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Signal $signal
     * @return void
     */
    public function __construct(Signal $signal)
    {
        $this->signal = $signal;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Signal Update: ' . $this->signal->pair_name . ' (' . ucfirst($this->signal->signal_type) . ')',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.signal-update',
            with: [
                'signal' => $this->signal,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}   