<x-layouts::auth :title="__('Restablecer Contraseña')">
    <div class="flex flex-col gap-6">
        <x-auth-header 
            :title="__('Nueva Contraseña')" 
            :description="__('Por favor, ingresa tu nueva contraseña para recuperar el acceso')" 
        />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Token -->
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <!-- Email Address -->
            <flux:input
                name="email"
                value="{{ request('email') }}"
                :label="__('Correo Electrónico')"
                type="email"
                required
                autocomplete="email"
                icon="envelope"
            />

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Nueva Contraseña')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Mínimo 8 caracteres')"
                passwordrules="{{ \Illuminate\Validation\Rules\Password::defaults()->toPasswordRulesString() }}"
                icon="lock-closed"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('Confirmar Nueva Contraseña')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Repite la contraseña')"
                icon="lock-closed"
                viewable
            />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full bg-blue-600 hover:bg-blue-700" data-test="reset-password-button">
                    {{ __('Restablecer Contraseña') }}
                </flux:button>
            </div>
        </form>
    </div>
</x-layouts::auth>

