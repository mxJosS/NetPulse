<?php

namespace App\Mail;

use App\Models\WorkOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServiceReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $workOrder;

    public $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct(WorkOrder $workOrder, $pdfPath)
    {
        $this->workOrder = $workOrder;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bitácora de Servicio - Orden #'.$this->workOrder->id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.service-report',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->pdfPath)
                ->as('Reporte_Servicio_'.$this->workOrder->id.'.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
