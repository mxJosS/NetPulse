<x-layouts::app :title="__('Nueva Orden de Trabajo')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">Crear Nueva Orden de Trabajo</flux:heading>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <form id="createForm" action="{{ route('work-orders.store') }}" method="POST" class="space-y-6" x-data x-init="@if($errors->has('cancellation_reason')) setTimeout(() => $flux.modal('cancel-modal').show(), 100) @endif">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:select label="Cliente" name="client_id" required>
                        <option value="" disabled selected>Seleccione un cliente...</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </flux:select>

                    <flux:select label="Equipo de Red" name="device_id" required>
                        <option value="" disabled selected>Seleccione un equipo...</option>
                        @foreach($devices as $device)
                            <option value="{{ $device->id }}" {{ old('device_id') == $device->id ? 'selected' : '' }}>
                                {{ $device->brand }} {{ $device->model }} (SN: {{ $device->serial_number }})
                            </option>
                        @endforeach
                    </flux:select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:select label="Asignar Ingeniero" name="user_id" required>
                        <option value="" disabled selected>Seleccione un ingeniero...</option>
                        @foreach($engineers as $engineer)
                            <option value="{{ $engineer->id }}" {{ old('user_id') == $engineer->id ? 'selected' : '' }}>
                                {{ $engineer->name }}
                            </option>
                        @endforeach
                    </flux:select>

                    <flux:select label="Estado" id="statusSelect" name="status" required :error="$errors->first('status')">
                        <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>PENDIENTE</option>
                        <option value="on_site" {{ old('status') == 'on_site' ? 'selected' : '' }}>ON SITE</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>COMPLETADO</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>CANCELADO</option>
                    </flux:select>
                </div>

                <flux:input label="Título de la Orden" name="title" value="{{ old('title') }}" placeholder="Ej: Mantenimiento preventivo..." required />
                <flux:input label="Dirección del Servicio" name="service_address" value="{{ old('service_address') }}" placeholder="Ej: Av. Principal #123, Col. Centro" required />
                <flux:textarea label="Descripción" name="description" placeholder="Detalles del problema o trabajo a realizar..." required>{{ old('description') }}</flux:textarea>

                <div class="flex gap-2">
                    <flux:button type="button" variant="primary" x-on:click="document.getElementById('statusSelect').value === 'cancelled' ? $flux.modal('cancel-modal').show() : document.getElementById('createForm').submit()">Crear Orden</flux:button>
                    <flux:button href="{{ route('work-orders.index') }}" variant="ghost">Cancelar</flux:button>
                </div>

                <!-- Modal para el motivo de cancelación -->
                <flux:modal name="cancel-modal" title="Confirmar Cancelación" class="space-y-4">
                    <flux:text>Por favor, ingrese el motivo por el cual se crea la orden como cancelada.</flux:text>
                    
                    <flux:textarea label="Motivo de Cancelación" name="cancellation_reason" id="cancellationReasonInput" placeholder="Ej: Servicio descartado por el cliente..." :error="$errors->first('cancellation_reason')">{{ old('cancellation_reason') }}</flux:textarea>
                    
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
</x-layouts::app>
