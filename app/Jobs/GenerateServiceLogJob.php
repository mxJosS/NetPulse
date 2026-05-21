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
        $workOrder = $this->workOrder;

        // 1. Generar el PDF usando la vista Blade con el nuevo estilo premium
        $pdf = Pdf::loadView('pdf.service-report', compact('workOrder'));
        $fileName = 'reporte_'.$workOrder->id.'_'.time().'.pdf';
        $pdfPath = storage_path('app/public/'.$fileName);
        $pdf->save($pdfPath);

        // 2. Enviar el correo electrónico con formato HTML premium y adjuntar el PDF
        Mail::to($workOrder->client->email)
            ->send(new \App\Mail\ServiceReportMail($workOrder, $pdfPath));
    }
}
