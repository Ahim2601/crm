<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendQuotation extends Mailable
{
    use Queueable, SerializesModels;

    public $quotation;
    public $urlquotation;
    public $namepdf;
    /**
     * Create a new message instance.
     */
    public function __construct($quotation, $urlquotation, $namepdf)
    {
        $this->quotation = $quotation;
        $this->urlquotation = $urlquotation;
        $this->namepdf = $namepdf;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if ($this->quotation->bussines == 'Raisa') {
            return new Envelope(
                from: new Address(env('MAIL_FROM_ADDRESS'), 'Raisa Climatizaciones'),
                subject: 'Cotización',
                to: [new Address($this->quotation->customer->email)], // ← Solución
                replyTo: [new Address('ventas@raisaclimatizaciones.cl', 'Raisa Climatizaciones')],
            );
        } else {
            return new Envelope(
                from: new Address(env('MAIL_FROM_ADDRESS'), 'Ciro Climatizaciones'),
                subject: 'Cotización',
                to: [new Address($this->quotation->customer->email)], // ← Solución
                replyTo: [new Address('ventas@ciroclima.cl', 'Ciro Climatizaciones')],
            );
        }
        
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'quotes.mail.email-quotation',
            with: [
                'quotation' => $this->quotation
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->urlquotation)
                ->as($this->namepdf)
                ->withMime('application/pdf'),
        ];
    }
}
