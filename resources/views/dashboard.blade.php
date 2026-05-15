<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:heading size="xl" level="1">Panel de Control</flux:heading>
        
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-blue-100 p-3 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                        <flux:icon name="users" />
                    </div>
                    <div>
                        <flux:text size="sm" class="font-medium">Clientes</flux:text>
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
                        <flux:text size="sm" class="font-medium">Equipos</flux:text>
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
                        <flux:text size="sm" class="font-medium">Pendientes</flux:text>
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
        </div>

        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
             <flux:heading size="lg" class="mb-4">Actividad Reciente</flux:heading>
             <flux:text>Bienvenido al sistema NOC Lite. Utilice el menú lateral para gestionar clientes, equipos y órdenes de trabajo.</flux:text>
        </div>
    </div>
</x-layouts::app>
