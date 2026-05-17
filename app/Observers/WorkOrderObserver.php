<?php

namespace App\Observers;

use App\Jobs\GenerateServiceLogJob;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\Log;

class WorkOrderObserver
{
    public function updated(WorkOrder $workOrder): void
    {
        if ($workOrder->isDirty('status')) {
            // Evento 1: Notificación WhatsApp cuando llega a sitio
            if ($workOrder->status === 'on_site') {
                $message = "🟢 Hola {$workOrder->client->name}, el ingeniero {$workOrder->engineer->name} ha llegado a sus instalaciones para atender el equipo {$workOrder->device->serial_number}.";
                app(\App\Services\TwilioWhatsAppService::class)->sendWhatsApp($workOrder->client->phone, $message);
            }
            // Evento 2: Disparar Job de PDF al completar
            if ($workOrder->status === 'completed') {
                GenerateServiceLogJob::dispatch($workOrder);
            }
        }
    }
}
