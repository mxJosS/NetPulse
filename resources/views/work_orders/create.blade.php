<x-layouts::app :title="__('Nueva Orden de Trabajo')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">Crear Nueva Orden de Trabajo</flux:heading>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <form action="{{ route('work-orders.store') }}" method="POST" class="space-y-6">
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

                    <flux:select label="Estado" name="status" required>
                        <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="on_site" {{ old('status') == 'on_site' ? 'selected' : '' }}>En Sitio</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completado</option>
                    </flux:select>
                </div>

                <flux:input label="Título de la Orden" name="title" value="{{ old('title') }}" placeholder="Ej: Mantenimiento preventivo..." required />
                <flux:textarea label="Descripción" name="description" placeholder="Detalles del problema o trabajo a realizar..." required>{{ old('description') }}</flux:textarea>

                <div class="flex gap-2">
                    <flux:button type="submit" variant="primary">Crear Orden</flux:button>
                    <flux:button href="{{ route('work-orders.index') }}" variant="ghost">Cancelar</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>
