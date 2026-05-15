<x-layouts::app :title="__('Detalle de Orden #') . $workOrder->id">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">Orden de Trabajo #{{ $workOrder->id }}</flux:heading>
        </div>
        
        @if($workOrder->status === 'cancelled')
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-900/50 dark:bg-red-900/20">
                <div class="flex items-center gap-3">
                    <flux:icon name="exclamation-triangle" class="text-red-600 dark:text-red-400" />
                    <div>
                        <flux:heading size="sm" class="text-red-800 dark:text-red-200">ORDEN CANCELADA</flux:heading>
                        <flux:text size="sm" class="text-red-700 dark:text-red-300">
                            <b>Motivo:</b> {{ $workOrder->cancellation_reason ?? 'Sin motivo especificado' }}
                        </flux:text>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900 space-y-4">
                <flux:heading size="lg">Detalles</flux:heading>
                <div>
                    <flux:text size="sm" class="font-medium text-zinc-500">Título</flux:text>
                    <flux:text>{{ $workOrder->title }}</flux:text>
                </div>
                <div>
                    <flux:text size="sm" class="font-medium text-zinc-500">Descripción</flux:text>
                    <flux:text>{{ $workOrder->description }}</flux:text>
                </div>
                <div>
                    <flux:text size="sm" class="font-medium text-zinc-500">Dirección del Servicio</flux:text>
                    <flux:text class="font-bold text-blue-600 dark:text-blue-400">{{ $workOrder->service_address ?? 'No especificada' }}</flux:text>
                </div>
                <div>
                    <flux:text size="sm" class="font-medium text-zinc-500">Cliente</flux:text>
                    <flux:text>{{ $workOrder->client->name }}</flux:text>
                </div>
                <div>
                    <flux:text size="sm" class="font-medium text-zinc-500">Equipo</flux:text>
                    <flux:text>{{ $workOrder->device->brand }} (SN: {{ $workOrder->device->serial_number }})</flux:text>
                </div>
                <div>
                    <flux:text size="sm" class="font-medium text-zinc-500">Ingeniero Asignado</flux:text>
                    <flux:text>{{ $workOrder->engineer->name ?? 'No asignado' }}</flux:text>
                </div>
            </div>

            <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900 space-y-4">
                <flux:heading size="lg">Actualizar Estado</flux:heading>
                <form id="statusForm" action="{{ route('work-orders.update-status', $workOrder) }}" method="POST" class="space-y-6" x-data x-init="@if($errors->has('cancellation_reason')) setTimeout(() => $flux.modal('cancel-modal').show(), 100) @endif">
                    @csrf
                    @method('PUT')
                    
                    <flux:select label="Estado" id="statusSelect" name="status" :error="$errors->first('status')">
                        <option value="pending" {{ $workOrder->status == 'pending' ? 'selected' : '' }}>PENDIENTE</option>
                        <option value="on_site" {{ $workOrder->status == 'on_site' ? 'selected' : '' }}>ON SITE</option>
                        <option value="completed" {{ $workOrder->status == 'completed' ? 'selected' : '' }}>COMPLETADO</option>
                        @if(auth()->user()->isAdmin())
                            <option value="cancelled" {{ $workOrder->status == 'cancelled' ? 'selected' : '' }}>CANCELADO</option>
                        @endif
                    </flux:select>

                    <div class="flex gap-2">
                        <flux:button type="button" variant="primary" x-on:click="document.getElementById('statusSelect').value === 'cancelled' ? $flux.modal('cancel-modal').show() : document.getElementById('statusForm').submit()">Guardar Estado</flux:button>
                        <flux:button href="{{ route('work-orders.index') }}" variant="ghost">Volver</flux:button>
                    </div>

                    <!-- Modal para el motivo de cancelación -->
                    <flux:modal name="cancel-modal" title="Confirmar Cancelación" class="space-y-4">
                        <flux:text>Por favor, ingrese el motivo por el cual se cancela esta orden de trabajo.</flux:text>
                        
                        <flux:textarea label="Motivo de Cancelación" name="cancellation_reason" id="cancellationReasonInput" placeholder="Ej: Cliente no se encontraba en el sitio..." :error="$errors->first('cancellation_reason')">{{ old('cancellation_reason', $workOrder->cancellation_reason) }}</flux:textarea>
                        
                        <div class="flex gap-2 justify-end">
                            <flux:modal.close>
                                <flux:button variant="ghost">Atrás</flux:button>
                            </flux:modal.close>
                            <flux:button type="submit" variant="danger">Confirmar y Cancelar</flux:button>
                        </div>
                    </flux:modal>
                </form>
            </div>
        </div>
    </div>
</x-layouts::app>
