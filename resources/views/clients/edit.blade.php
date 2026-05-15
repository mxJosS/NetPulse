<x-layouts::app :title="__('Editar Cliente')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">Editar Cliente: {{ $client->name }}</flux:heading>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <form action="{{ route('clients.update', $client) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <flux:input label="Nombre completo" name="name" value="{{ old('name', $client->name) }}" required />
                    <flux:input label="Correo electrónico" name="email" type="email" value="{{ old('email', $client->email) }}" required />
                    <flux:input label="Teléfono" name="phone" value="{{ old('phone', $client->phone) }}" />
                </div>

                <flux:textarea label="Dirección" name="address">{{ old('address', $client->address) }}</flux:textarea>

                <div class="flex gap-2">
                    <flux:button type="submit" variant="primary">Actualizar Cliente</flux:button>
                    <flux:button href="{{ route('clients.index') }}" variant="ghost">Cancelar</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>
