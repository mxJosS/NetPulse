<?php
namespace App\Observers;

use App\Models\WorkOrder;
use App\Jobs\GenerateServiceLogJob;
use Illuminate\Support\Facades\Log;

class WorkOrderObserver
{
    public function updated(WorkOrder $workOrder): void
    {
        if ($workOrder->isDirty('status')) {
            // Evento 1: Notificación WhatsApp cuando llega a sitio
            if ($workOrder->status === 'on_site') {
                Log::info("[WhatsApp API a {$workOrder->client->phone}] 🟢 Hola {$workOrder->client->name}, el ingeniero {$workOrder->engineer->name} ha llegado a sus instalaciones para atender el equipo {$workOrder->device->serial_number}.");
            }
            // Evento 2: Disparar Job de PDF al completar
            if ($workOrder->status === 'completed') {
                GenerateServiceLogJob::dispatch($workOrder);
            }
        }
    }
}
