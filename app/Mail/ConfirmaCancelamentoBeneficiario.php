<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Content;
use Illuminate\Mail\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmaCancelamentoBeneficiario extends Mailable
{
    use Queueable, SerializesModels;

    public $html;

    /**
     * Create a new message instance.
     */
    public function __construct($html)
    {
        $this->html = $html;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('CANCELAMENTO DE BENEFICIARIO')
                    ->view('Mails.confirmaCancelamentoBeneficiario')
                    ->with(['html' => $this->html]);
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
