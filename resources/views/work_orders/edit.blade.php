<x-layouts::app :title="__('Editar Orden #') . $workOrder->id">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">Editar Orden de Trabajo #{{ $workOrder->id }}</flux:heading>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <form id="editForm" action="{{ route('work-orders.update', $workOrder) }}" method="POST" class="space-y-6" x-data x-init="@if($errors->has('cancellation_reason')) setTimeout(() => $flux.modal('cancel-modal').show(), 100) @endif">
                @csrf
                @method('PUT')
                
                <flux:select label="Estado" id="statusSelect" name="status" :error="$errors->first('status')">
                    <option value="pending" {{ $workOrder->status == 'pending' ? 'selected' : '' }}>PENDIENTE</option>
                    <option value="on_site" {{ $workOrder->status == 'on_site' ? 'selected' : '' }}>ON SITE</option>
                    <option value="completed" {{ $workOrder->status == 'completed' ? 'selected' : '' }}>COMPLETADO</option>
                    <option value="cancelled" {{ $workOrder->status == 'cancelled' ? 'selected' : '' }}>CANCELADO</option>
                </flux:select>

                @if(!auth()->user()->isEngineer())
                    <flux:input label="Título" name="title" value="{{ $workOrder->title }}" required />
                    <flux:input label="Dirección del Servicio" name="service_address" value="{{ $workOrder->service_address }}" required />
                    <flux:textarea label="Descripción" name="description" required>{{ $workOrder->description }}</flux:textarea>
                    
                    <flux:select label="Asignar Ingeniero" name="user_id" required>
                        @foreach($engineers as $engineer)
                            <option value="{{ $engineer->id }}" {{ $workOrder->user_id == $engineer->id ? 'selected' : '' }}>
                                {{ $engineer->name }}
                            </option>
                        @endforeach
                    </flux:select>
                @endif

                <div class="flex gap-2">
                    <flux:button type="button" variant="primary" x-on:click="document.getElementById('statusSelect').value === 'cancelled' ? $flux.modal('cancel-modal').show() : document.getElementById('editForm').submit()">Actualizar</flux:button>
                    <flux:button href="{{ route('work-orders.index') }}" variant="ghost">Cancelar</flux:button>
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
</x-layouts::app>
