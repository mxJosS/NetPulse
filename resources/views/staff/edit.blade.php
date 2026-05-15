<x-layouts::app :title="__('Editar Ingeniero')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">Editar Ingeniero: {{ $staff->name }}</flux:heading>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <form action="{{ route('staff.update', $staff) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <flux:input label="Nombre completo" name="name" value="{{ old('name', $staff->name) }}" required />
                    <flux:input label="Correo electrónico" name="email" type="email" value="{{ old('email', $staff->email) }}" required />
                    <flux:input label="Contraseña (dejar en blanco para no cambiar)" name="password" type="password" />
                </div>

                <div class="flex gap-2">
                    <flux:button type="submit" variant="primary">Actualizar Ingeniero</flux:button>
                    <flux:button href="{{ route('staff.index') }}" variant="ghost">Cancelar</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>
