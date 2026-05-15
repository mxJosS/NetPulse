<x-layouts::app :title="$client->name">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">{{ $client->name }}</flux:heading>
            <div class="flex gap-2">
                <flux:button icon="pencil-square" href="{{ route('clients.edit', $client) }}">Editar</flux:button>
                <flux:button icon="arrow-left" variant="ghost" href="{{ route('clients.index') }}">Volver</flux:button>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            <div class="col-span-1 rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <flux:heading size="lg" class="mb-4">Información de Contacto</flux:heading>
                <div class="space-y-4">
                    <div>
                        <flux:text size="sm" class="font-medium">Email</flux:text>
                        <flux:text>{{ $client->email }}</flux:text>
                    </div>
                    <div>
                        <flux:text size="sm" class="font-medium">Teléfono</flux:text>
                        <flux:text>{{ $client->phone ?? 'N/A' }}</flux:text>
                    </div>
                    <div>
                        <flux:text size="sm" class="font-medium">Dirección</flux:text>
                        <flux:text>{{ $client->address ?? 'N/A' }}</flux:text>
                    </div>
                </div>
            </div>

            <div class="col-span-2 space-y-4">
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <flux:heading size="lg" class="mb-4">Equipos Vinculados</flux:heading>
                    <flux:text>Sección para listar los equipos de este cliente (Próximamente).</flux:text>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <flux:heading size="lg" class="mb-4">Historial de Órdenes</flux:heading>
                    <flux:text>Sección para listar las órdenes de trabajo de este cliente (Próximamente).</flux:text>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
