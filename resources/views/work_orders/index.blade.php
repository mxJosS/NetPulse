<x-layouts::app :title="__('Órdenes de Trabajo')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">Órdenes de Trabajo</flux:heading>
            @if(auth()->user()->isAdmin())
                <flux:button icon="plus" variant="primary" href="{{ route('work-orders.create') }}" wire:navigate>Nueva Orden</flux:button>
            @endif
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
                            <th class="px-4 py-3 font-semibold text-zinc-900 dark:text-white">Orden / Cliente</th>
                            <th class="px-4 py-3 font-semibold text-zinc-900 dark:text-white hidden sm:table-cell">Equipo</th>
                            <th class="px-4 py-3 font-semibold text-zinc-900 dark:text-white hidden md:table-cell">Ingeniero</th>
                            <th class="px-4 py-3 font-semibold text-zinc-900 dark:text-white text-center">Estado</th>
                            <th class="px-4 py-3 font-semibold text-zinc-900 dark:text-white text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse($workOrders as $order)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                                <td class="px-4 py-3 text-zinc-700 dark:text-zinc-300 font-medium">
                                    <span class="font-bold text-zinc-900 dark:text-white">#{{ $order->id }} - {{ $order->title }}</span>
                                    <div class="text-xs text-zinc-500 mt-0.5">
                                        <span>{{ $order->client->name }}</span>
                                        <!-- Mobile info -->
                                        <span class="sm:hidden block text-[11px] text-zinc-400 mt-1">
                                            @if($order->device)
                                                Equipo: {{ $order->device->brand }} {{ $order->device->model }}
                                            @else
                                                Equipo: N/A
                                            @endif
                                        </span>
                                        <span class="md:hidden block text-[11px] text-zinc-400 mt-0.5">
                                            Ing: {{ $order->engineer->name ?? 'Sin asignar' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-zinc-600 dark:text-zinc-400 hidden sm:table-cell">
                                    @if($order->device)
                                        {{ $order->device->brand }} <br>
                                        <span class="text-xs text-zinc-500">SN: {{ $order->device->serial_number }}</span>
                                    @else
                                        <span class="text-red-500 italic text-xs">Equipo no disponible</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-zinc-600 dark:text-zinc-400 hidden md:table-cell">
                                    {{ $order->engineer->name ?? 'Sin asignar' }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <flux:badge :color="match($order->status) {
                                            'pending' => 'yellow',
                                            'on_site' => 'blue',
                                            'completed' => 'green',
                                            'cancelled' => 'red',
                                            default => 'zinc',
                                        }" size="sm">
                                            {{ $order->formattedStatus() }}
                                        </flux:badge>
 
                                        @if($order->status === 'cancelled' && $order->cancellation_reason)
                                            <flux:tooltip :content="$order->cancellation_reason" position="top" class="cursor-help">
                                                <flux:icon name="exclamation-circle" class="text-red-500 hover:text-red-600 h-4 w-4" />
                                            </flux:tooltip>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end items-center gap-1">
                                        @if(auth()->user()->isAdmin())
                                            <flux:button size="sm" icon="pencil-square" href="{{ route('work-orders.edit', $order) }}" variant="ghost" wire:navigate />
                                            @if($order->status === 'completed')
                                                <flux:button size="sm" icon="arrow-down-tray" href="{{ route('work-orders.download', $order) }}" variant="ghost" />
                                            @endif
                                        @else
                                            <flux:button size="sm" icon="eye" href="{{ route('work-orders.show', $order) }}" variant="ghost" wire:navigate>Gestionar</flux:button>
                                            @if($order->status === 'completed')
                                                <form action="{{ route('work-orders.report', $order) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <flux:button size="sm" icon="document-text" type="submit" variant="filled" class="bg-blue-600 hover:bg-blue-700 text-white border-none" />
                                                </form>
                                                <flux:button size="sm" icon="arrow-down-tray" href="{{ route('work-orders.download', $order) }}" variant="ghost" />
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-zinc-500">No hay órdenes de trabajo registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>
