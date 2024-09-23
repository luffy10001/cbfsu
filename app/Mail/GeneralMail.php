<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GeneralMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $template;
    /**
     * Create a new message instance.
     */
    public function __construct($data,$template)
    {
        $this->data = $data;
        $this->template = $template;
    }

    public function build()
    {
        return $this
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject($this->data['subject'])
            ->view('mail.' . $this->template) // Use the dynamic template
            ->with('data', $this->data);
    }

    /**
     * Get the message envelope.
     */
//    public function envelope(): Envelope
//    {
//        return new Envelope(
//            subject: 'General Mail',
//        );
//    }

    /**
     * Get the message content definition.
     */
//    public function content(): Content
//    {
//        return new Content(
//            view: 'mail.customer',
//        );
//    }

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
