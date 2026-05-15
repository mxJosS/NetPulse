<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:heading size="xl" level="1">Panel de Control</flux:heading>
        
        <div class="grid auto-rows-min gap-4 {{ $stats['is_admin'] ? 'md:grid-cols-4' : 'md:grid-cols-2' }}">
            @if($stats['is_admin'])
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="flex items-center gap-4">
                        <div class="rounded-lg bg-blue-100 p-3 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                            <flux:icon name="users" />
                        </div>
                        <div>
                            <flux:text size="sm" class="font-medium">Total Clientes</flux:text>
                            <flux:heading size="lg">{{ $stats['clients_count'] }}</flux:heading>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="flex items-center gap-4">
                        <div class="rounded-lg bg-purple-100 p-3 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400">
                            <flux:icon name="server-stack" />
                        </div>
                        <div>
                            <flux:text size="sm" class="font-medium">Total Equipos</flux:text>
                            <flux:heading size="lg">{{ $stats['devices_count'] }}</flux:heading>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="flex items-center gap-4">
                        <div class="rounded-lg bg-yellow-100 p-3 text-yellow-600 dark:bg-yellow-900/30 dark:text-yellow-400">
                            <flux:icon name="clipboard-document-list" />
                        </div>
                        <div>
                            <flux:text size="sm" class="font-medium">Órdenes Pendientes</flux:text>
                            <flux:heading size="lg">{{ $stats['pending_orders_count'] }}</flux:heading>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="flex items-center gap-4">
                        <div class="rounded-lg bg-green-100 p-3 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                            <flux:icon name="check-circle" />
                        </div>
                        <div>
                            <flux:text size="sm" class="font-medium">Total Órdenes</flux:text>
                            <flux:heading size="lg">{{ $stats['total_orders_count'] }}</flux:heading>
                        </div>
                    </div>
                </div>
            @else
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="flex items-center gap-4">
                        <div class="rounded-lg bg-yellow-100 p-3 text-yellow-600 dark:bg-yellow-900/30 dark:text-yellow-400">
                            <flux:icon name="clipboard-document-list" />
                        </div>
                        <div>
                            <flux:text size="sm" class="font-medium">Mis Órdenes Pendientes</flux:text>
                            <flux:heading size="lg">{{ $stats['pending_orders_count'] }}</flux:heading>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="flex items-center gap-4">
                        <div class="rounded-lg bg-green-100 p-3 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                            <flux:icon name="check-circle" />
                        </div>
                        <div>
                            <flux:text size="sm" class="font-medium">Mis Órdenes Completadas</flux:text>
                            <flux:heading size="lg">{{ $stats['completed_orders_count'] }}</flux:heading>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        @if($stats['is_admin'])
            <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                 <flux:heading size="lg" class="mb-4">Actividad Reciente</flux:heading>
                 <flux:text>Bienvenido al sistema NOC Lite. Utilice el menú lateral para gestionar clientes, equipos y órdenes de trabajo.</flux:text>
            </div>
        @else
            <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900 mt-4">
                <flux:heading size="lg" class="mb-4">Mis Órdenes Activas</flux:heading>
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
                            @forelse($stats['active_orders'] as $order)
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
                                            default => 'zinc',
                                        }" size="sm">
                                            {{ strtoupper($order->status) }}
                                        </flux:badge>
                                    </td>
                                    <td class="px-4 py-3">
                                        <flux:button size="sm" icon="eye" href="{{ route('work-orders.show', $order) }}" variant="ghost">Gestionar</flux:button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-zinc-500">No tienes órdenes activas en este momento.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-layouts::app>
