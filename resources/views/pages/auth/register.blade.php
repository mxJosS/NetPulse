<x-layouts::auth :title="__('Crear Cuenta')">
    <div class="flex flex-col gap-6">
        <x-auth-header 
            :title="__('Únete a NetPulse')" 
            :description="__('Completa los datos a continuación para crear tu cuenta de ingeniero')" 
        />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Name -->
            <flux:input
                name="name"
                :label="__('Nombre Completo')"
                :value="old('name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Tu nombre y apellido')"
                icon="user"
            />

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Correo Electrónico')"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                placeholder="ejemplo@netpulse.com"
                icon="envelope"
            />

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Contraseña')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Crea una contraseña segura')"
                passwordrules="{{ \Illuminate\Validation\Rules\Password::defaults()->toPasswordRulesString() }}"
                icon="lock-closed"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('Confirmar Contraseña')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Repite tu contraseña')"
                icon="lock-closed"
                viewable
            />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full bg-blue-600 hover:bg-blue-700" data-test="register-user-button">
                    {{ __('Crear mi cuenta') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('¿Ya tienes una cuenta?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Inicia sesión aquí') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>

