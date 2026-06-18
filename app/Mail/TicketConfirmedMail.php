<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Transaction $transaction)
    {
        $this->transaction->loadMissing('user', 'details.ticket.event', 'issuedTickets');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tiket Dreamella Project Anda Telah Dikonfirmasi',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.ticket-confirmed',
            with: [
                'transaction' => $this->transaction,
                'event' => $this->transaction->event(),
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
