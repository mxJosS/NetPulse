<x-layouts::app :title="__('Editar Orden #') . $workOrder->id">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <flux:heading size="xl" level="1">Editar Orden de Trabajo #{{ $workOrder->id }}</flux:heading>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <form action="{{ route('work-orders.update', $workOrder) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <flux:select label="Estado" name="status">
                    <option value="pending" {{ $workOrder->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="on_site" {{ $workOrder->status == 'on_site' ? 'selected' : '' }}>On Site</option>
                    <option value="completed" {{ $workOrder->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </flux:select>

                @if(!auth()->user()->isEngineer())
                    <flux:input label="Título" name="title" value="{{ $workOrder->title }}" required />
                    <flux:textarea label="Descripción" name="description" required>{{ $workOrder->description }}</flux:textarea>
                    
                    <flux:select label="Asignar Ingeniero" name="user_id" required>
                        @foreach($engineers as $engineer)
                            <option value="{{ $engineer->id }}" {{ $workOrder->user_id == $engineer->id ? 'selected' : '' }}>
                                {{ $engineer->name }}
                            </option>
                        @endforeach
                    </flux:select>
                @endif

                <div class="flex gap-2">
                    <flux:button type="submit" variant="primary">Actualizar</flux:button>
                    <flux:button href="{{ route('work-orders.index') }}" variant="ghost">Cancelar</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>
