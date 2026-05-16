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
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activity / Tickets Column -->
                <div class="lg:col-span-2 rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <flux:heading size="lg" class="mb-4">Últimas Órdenes del NOC</flux:heading>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="border-b border-zinc-100 dark:border-zinc-800">
                                    <th class="py-3 pr-4 font-semibold text-zinc-900 dark:text-white">ID</th>
                                    <th class="py-3 px-4 font-semibold text-zinc-900 dark:text-white">Cliente</th>
                                    <th class="py-3 px-4 font-semibold text-zinc-900 dark:text-white text-center">Estado</th>
                                    <th class="py-3 pl-4 font-semibold text-zinc-900 dark:text-white text-right">Ingeniero</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                                @foreach($stats['recent_activity'] as $activity)
                                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                                        <td class="py-3 pr-4 font-bold text-zinc-700 dark:text-zinc-300">
                                            #{{ $activity->id }}
                                        </td>
                                        <td class="py-3 px-4 text-zinc-500">
                                            {{ $activity->client->name }}
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <flux:badge :color="match($activity->status) {
                                                    'pending' => 'yellow',
                                                    'on_site' => 'blue',
                                                    'completed' => 'green',
                                                    'cancelled' => 'red',
                                                    default => 'zinc',
                                                }" size="sm">
                                                    {{ $activity->formattedStatus() }}
                                                </flux:badge>

                                                @if($activity->status === 'cancelled' && $activity->cancellation_reason)
                                                    <flux:tooltip :content="$activity->cancellation_reason" position="top" class="cursor-help">
                                                        <flux:icon name="exclamation-circle" class="text-red-500 hover:text-red-600 h-4 w-4" />
                                                    </flux:tooltip>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-3 pl-4 text-right text-zinc-500 text-xs">
                                            {{ $activity->engineer->name ?? 'Sin asignar' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Metrics & Reports Column -->
                <div class="space-y-6">
                    <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900 shadow-sm">
                        <flux:heading size="lg" class="mb-4 text-center">Métricas del NOC</flux:heading>
                        <div class="flex justify-center mb-6">
                            <canvas id="ordersChart" class="max-h-48"></canvas>
                        </div>
                        
                        <div class="border-t border-zinc-100 dark:border-zinc-800 pt-6">
                            <flux:heading size="sm" class="mb-4 text-zinc-500 uppercase tracking-wider">Exportar Reportes Ejecutivos</flux:heading>
                            <div class="flex flex-col gap-2">
                                <flux:button href="{{ route('admin.reports.weekly') }}" icon="document-arrow-down" variant="filled" class="bg-blue-600 hover:bg-blue-700 text-white border-none w-full justify-start">Reporte Semanal</flux:button>
                                <flux:button href="{{ route('admin.reports.monthly') }}" icon="document-arrow-down" variant="ghost" class="w-full justify-start border-zinc-200 dark:border-zinc-700">Reporte Mensual</flux:button>
                                <flux:button href="{{ route('admin.reports.yearly') }}" icon="document-arrow-down" variant="ghost" class="w-full justify-start border-zinc-200 dark:border-zinc-700">Reporte Anual</flux:button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart.js Initialization -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                function initDashboardChart() {
                    const canvas = document.getElementById('ordersChart');
                    if (!canvas) return;

                    // Destroy existing chart instance if it exists on window
                    if (window.dashboardOrdersChart) {
                        window.dashboardOrdersChart.destroy();
                    }

                    const ctx = canvas.getContext('2d');
                    window.dashboardOrdersChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Pendientes', 'En Sitio', 'Completadas', 'Canceladas'],
                            datasets: [{
                                data: [
                                    {{ $stats['orders_by_status']['pending'] }},
                                    {{ $stats['orders_by_status']['on_site'] }},
                                    {{ $stats['orders_by_status']['completed'] }},
                                    {{ $stats['orders_by_status']['cancelled'] }}
                                ],
                                backgroundColor: ['#EAB308', '#2563EB', '#16A34A', '#EF4444'],
                                borderWidth: 0,
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 20,
                                        font: { size: 11 }
                                    }
                                }
                            },
                            cutout: '70%',
                            maintainAspectRatio: false
                        }
                    });
                }

                // If document is already loaded (e.g., via wire:navigate), execute immediately with a tiny delay
                if (document.readyState === 'complete' || document.readyState === 'interactive') {
                    setTimeout(initDashboardChart, 50);
                } else {
                    document.addEventListener('DOMContentLoaded', initDashboardChart);
                }
                
                // Also hook into livewire's navigated event just in case
                document.addEventListener('livewire:navigated', initDashboardChart);
            </script>
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
                                        @if($order->device)
                                            {{ $order->device->brand }} <br>
                                            <span class="text-xs text-zinc-500">SN: {{ $order->device->serial_number }}</span>
                                        @else
                                            <span class="text-red-500 italic text-xs">Equipo no disponible</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
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
