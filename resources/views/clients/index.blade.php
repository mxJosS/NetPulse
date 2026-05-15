<x-layouts::app :title="__('Clientes')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">Clientes</flux:heading>
            <flux:button icon="plus" variant="primary" href="{{ route('clients.create') }}" wire:navigate>Nuevo Cliente</flux:button>
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
                            <th class="px-4 py-3 font-semibold text-zinc-900 dark:text-white">Nombre</th>
                            <th class="px-4 py-3 font-semibold text-zinc-900 dark:text-white">Email</th>
                            <th class="px-4 py-3 font-semibold text-zinc-900 dark:text-white">Teléfono</th>
                            <th class="px-4 py-3 font-semibold text-zinc-900 dark:text-white">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse($clients as $client)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                                <td class="px-4 py-3 text-zinc-700 dark:text-zinc-300 font-medium">{{ $client->name }}</td>
                                <td class="px-4 py-3 text-zinc-600 dark:text-zinc-400">{{ $client->email }}</td>
                                <td class="px-4 py-3 text-zinc-600 dark:text-zinc-400">{{ $client->phone ?? 'N/A' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <flux:button size="sm" icon="pencil-square" href="{{ route('clients.edit', $client) }}" variant="ghost" wire:navigate />
                                        <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('¿Eliminar cliente?')">
                                            @csrf
                                            @method('DELETE')
                                            <flux:button size="sm" icon="trash" type="submit" variant="ghost" class="text-red-500 hover:text-red-600" />
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-zinc-500">No hay clientes registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>
