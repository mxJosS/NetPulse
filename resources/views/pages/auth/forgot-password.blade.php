<x-layouts::auth :title="__('Recuperar Contraseña')">
    <div class="flex flex-col gap-6">
        <x-auth-header 
            :title="__('¿Olvidaste tu contraseña?')" 
            :description="__('No te preocupes. Ingresa tu correo y te enviaremos un enlace para restablecerla.')" 
        />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Correo Electrónico')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="ejemplo@netpulse.com"
                icon="envelope"
            />

            <div class="flex flex-col gap-4">
                <flux:button type="submit" variant="primary" class="w-full bg-blue-600 hover:bg-blue-700">
                    {{ __('Enviar enlace de recuperación') }}
                </flux:button>

                <flux:button href="{{ route('login') }}" variant="ghost" class="w-full" wire:navigate>
                    {{ __('Volver al inicio de sesión') }}
                </flux:button>
            </div>
        </form>
    </div>
</x-layouts::auth>
