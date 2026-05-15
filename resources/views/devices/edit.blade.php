<x-layouts::app :title="__('Editar Equipo de Red')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">Editar Equipo: {{ $device->brand }} {{ $device->model }}</flux:heading>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <form action="{{ route('devices.update', $device) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:select label="Cliente Propietario" name="client_id" required>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $device->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </flux:select>

                    <flux:input label="Marca" name="brand" value="{{ old('brand', $device->brand) }}" required />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input label="Modelo" name="model" value="{{ old('model', $device->model) }}" required />
                    <flux:input label="Número de Serie" name="serial_number" value="{{ old('serial_number', $device->serial_number) }}" required />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input label="Dirección IP (Opcional)" name="ip_address" value="{{ old('ip_address', $device->ip_address) }}" />
                </div>

                <div class="flex gap-2">
                    <flux:button type="submit" variant="primary">Actualizar Equipo</flux:button>
                    <flux:button href="{{ route('devices.index') }}" variant="ghost">Cancelar</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>
