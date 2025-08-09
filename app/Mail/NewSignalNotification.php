<?php

namespace App\Mail;

use App\Models\Signal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// class NewSignalNotification extends Mailable implements ShouldQueue // Added ShouldQueue
class NewSignalNotification extends Mailable // Added ShouldQueue
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
        // Eager load the 'asset' relationship to avoid N+1 queries
        $this->signal = $signal->load('asset');
        // $this->signal = $signal;


    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        // Use the 'name' property from the related Asset model

        \Log::info('Creating new signal notification for asset: ' . $this->signal->asset->pair_name);
        return new Envelope(
            subject: 'New Signal Alert: ' . $this->signal->asset->pair_name . ' (' . ucfirst($this->signal->signal_type) . ')',
            // subject: 'New Signal Alert: ' . $this->signal->pair_name . ' (' . ucfirst($this->signal->signal_type) . ')',

        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        \Log::info('Creating new signal notification for asset: ' . $this->signal->asset->pair_name);

        return new Content(
            markdown: 'emails.new-signal',
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
