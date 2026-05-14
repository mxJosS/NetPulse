@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="NetPulse" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <img src="/assets/img/netpulse.png" alt="NetPulse Logo" class="size-7 object-contain" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="NetPulse" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <img src="/assets/img/netpulse.png" alt="NetPulse Logo" class="size-7 object-contain" />
        </x-slot>
    </flux:brand>
@endif
