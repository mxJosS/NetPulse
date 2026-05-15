<x-layouts::app :title="__('Detalle de Orden #') . $workOrder->id">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">Orden de Trabajo #{{ $workOrder->id }}</flux:heading>
        </div>

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
                <form action="{{ route('work-orders.update-status', $workOrder) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <flux:select label="Estado" name="status">
                        <option value="pending" {{ $workOrder->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="on_site" {{ $workOrder->status == 'on_site' ? 'selected' : '' }}>On Site</option>
                        <option value="completed" {{ $workOrder->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </flux:select>

                    <div class="flex gap-2">
                        <flux:button type="submit" variant="primary">Guardar Estado</flux:button>
                        <flux:button href="{{ route('work-orders.index') }}" variant="ghost">Volver</flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts::app>
