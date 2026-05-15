<x-layouts::app :title="__('Nuevo Equipo de Red')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">Registrar Nuevo Equipo</flux:heading>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <form action="{{ route('devices.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:select label="Cliente Propietario" name="client_id" required>
                        <option value="" disabled selected>Seleccione un cliente...</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </flux:select>

                    <flux:input label="Marca" name="brand" placeholder="Ej: Cisco, Mikrotik..." value="{{ old('brand') }}" required />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input label="Modelo" name="model" placeholder="Ej: ISR 4331, RB5009..." value="{{ old('model') }}" required />
                    <flux:input label="Número de Serie" name="serial_number" placeholder="S/N único del equipo" value="{{ old('serial_number') }}" required />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input label="Dirección IP (Opcional)" name="ip_address" placeholder="Ej: 192.168.1.1" value="{{ old('ip_address') }}" />
                </div>

                <div class="flex gap-2">
                    <flux:button type="submit" variant="primary">Guardar Equipo</flux:button>
                    <flux:button href="{{ route('devices.index') }}" variant="ghost">Cancelar</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>
