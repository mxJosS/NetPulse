<x-layouts::app :title="__('Órdenes de Trabajo')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">Órdenes de Trabajo</flux:heading>
            <flux:button icon="plus" variant="primary" href="#">Nueva Orden</flux:button>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-zinc-200 dark:border-zinc-700">
                            <th class="px-4 py-3 font-semibold text-zinc-900 dark:text-white">ID / Cliente</th>
                            <th class="px-4 py-3 font-semibold text-zinc-900 dark:text-white">Equipo</th>
                            <th class="px-4 py-3 font-semibold text-zinc-900 dark:text-white">Estado</th>
                            <th class="px-4 py-3 font-semibold text-zinc-900 dark:text-white">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse($workOrders as $order)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                                <td class="px-4 py-3 text-zinc-700 dark:text-zinc-300 font-medium">
                                    <b>#{{ $order->id }}</b> <br>
                                    <span class="text-xs text-zinc-500">{{ $order->client->name }}</span>
                                </td>
                                <td class="px-4 py-3 text-zinc-600 dark:text-zinc-400">
                                    {{ $order->device->brand }} <br>
                                    <span class="text-xs text-zinc-500">SN: {{ $order->device->serial_number }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <flux:badge :color="match($order->status) {
                                        'pending' => 'yellow',
                                        'on_site' => 'blue',
                                        'completed' => 'green',
                                        default => 'zinc',
                                    }" size="sm">
                                        {{ strtoupper($order->status) }}
                                    </flux:badge>
                                </td>
                                <td class="px-4 py-3">
                                    <flux:button size="sm" icon="pencil-square" href="{{ route('work-orders.edit', $order) }}" variant="ghost" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-zinc-500">No hay órdenes de trabajo registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>
