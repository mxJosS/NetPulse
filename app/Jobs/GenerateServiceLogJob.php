<?php

namespace App\Jobs;

use App\Models\WorkOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GenerateServiceLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public WorkOrder $workOrder) {}

    public function handle(): void
    {
        $pdf = Pdf::loadHtml("<h1>Bitácora de Servicio - Orden #{$this->workOrder->id}</h1><p>Equipo: {$this->workOrder->device->serial_number}</p><p>Estado: Completado</p>");

        Mail::raw('Adjuntamos su bitácora de servicio en formato PDF.', function ($message) use ($pdf) {
            $message->to($this->workOrder->client->email)
                ->subject("Bitácora de Servicio NOC Lite - Orden #{$this->workOrder->id}")
                ->attachData($pdf->output(), "Bitacora_{$this->workOrder->id}.pdf");
        });
    }
}
