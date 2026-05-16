<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <style>
            .auth-gradient {
                background: radial-gradient(circle at top right, #1e293b, #020617);
                position: relative;
                overflow: hidden;
            }
            .auth-gradient::before {
                content: '';
                position: absolute;
                top: -10%;
                right: -10%;
                width: 70%;
                height: 70%;
                background: radial-gradient(circle, rgba(37, 99, 235, 0.15) 0%, transparent 70%);
                filter: blur(60px);
                animation: float 20s infinite alternate;
            }
            .auth-gradient::after {
                content: '';
                position: absolute;
                bottom: -20%;
                left: -10%;
                width: 80%;
                height: 80%;
                background: radial-gradient(circle, rgba(79, 70, 229, 0.1) 0%, transparent 70%);
                filter: blur(60px);
                animation: float 15s infinite alternate-reverse;
            }
            @keyframes float {
                0% { transform: translate(0, 0) scale(1); }
                100% { transform: translate(5%, 5%) scale(1.1); }
            }
        </style>
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-zinc-950">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <div class="auth-gradient relative hidden h-full flex-col p-12 text-white lg:flex dark:border-e dark:border-zinc-800">
                <div class="absolute inset-0 bg-zinc-950/40"></div>
                
                <!-- Background Pattern -->
                <div class="absolute inset-0 z-10 opacity-[0.03]" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 32px 32px;"></div>

                <a href="{{ route('home') }}" class="relative z-20 flex items-center gap-3 text-2xl font-bold tracking-tight" wire:navigate>
                    <img src="{{ asset('assets/img/netpulse.png') }}" alt="NetPulse Logo" class="h-10 w-auto">
                    <span>NetPulse</span>
                </a>

                @php
                    $quotes = [
                        [
                            'quote' => 'La excelencia no es un acto, sino un hábito.',
                            'author' => 'Aristóteles',
                            'image' => 'aristoteles.png'
                        ],
                        [
                            'quote' => 'El éxito es la suma de pequeños esfuerzos repetidos día tras día.',
                            'author' => 'Robert Collier',
                            'image' => 'robert collier.png'
                        ],
                        [
                            'quote' => 'La innovación distingue a los líderes de los seguidores.',
                            'author' => 'Steve Jobs',
                            'image' => 'Steve Jos.png'
                        ]
                    ];
                    $quote = $quotes[array_rand($quotes)];
                @endphp

                <div class="relative z-20 flex flex-1 flex-col items-center justify-center text-center">
                    <div class="max-w-lg space-y-12">
                        <!-- Large Author Image -->
                        <div class="relative mx-auto h-56 w-56">
                            <div class="absolute -inset-6 rounded-full bg-gradient-to-tr from-blue-600/20 to-indigo-500/20 blur-3xl animate-pulse"></div>
                            <div class="absolute -inset-1 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 opacity-50"></div>
                            <div class="absolute -inset-2 rounded-full border border-white/10"></div>
                            <img src="{{ asset('assets/img/' . $quote['image']) }}" 
                                 alt="{{ $quote['author'] }}" 
                                 class="relative h-full w-full rounded-full border-4 border-white/20 object-cover shadow-[0_0_50px_rgba(0,0,0,0.5)]">
                        </div>

                        <blockquote class="space-y-8">
                            <div class="relative">
                                <svg class="absolute -top-12 -left-4 h-24 w-24 text-blue-500/10" fill="currentColor" viewBox="0 0 32 32">
                                    <path d="M10 8v8H6c0 4.411 3.589 8 8 8V8H10zm12 0v8h-4c0 4.411 3.589 8 8 8V8h-4z"/>
                                </svg>
                                <p class="text-4xl font-light italic leading-tight text-white/95 lg:text-5xl">
                                    &ldquo;{{ $quote['quote'] }}&rdquo;
                                </p>
                            </div>
                            
                            <footer class="flex flex-col items-center gap-4">
                                <span class="text-3xl font-bold tracking-tight text-white">{{ $quote['author'] }}</span>
                                <div class="flex items-center gap-4">
                                    <div class="h-px w-12 bg-gradient-to-r from-transparent to-blue-500"></div>
                                    <span class="text-xs uppercase tracking-[0.5em] text-blue-400 font-black">Mentalidad NetPulse</span>
                                    <div class="h-px w-12 bg-gradient-to-l from-transparent to-blue-500"></div>
                                </div>
                            </footer>
                        </blockquote>
                    </div>
                </div>

                <div class="relative z-20 mt-auto flex justify-between text-[10px] font-bold text-white/20 uppercase tracking-[0.3em]">
                    <span>Infraestructura</span>
                    <span>Seguridad</span>
                    <span>Rendimiento</span>
                </div>
            </div>
            
            <div class="w-full lg:p-8 bg-zinc-50 dark:bg-zinc-950">
                <div class="mx-auto flex w-full flex-col justify-center space-y-8 sm:w-[400px]">
                    <div class="flex flex-col items-center gap-4 lg:hidden">
                        <a href="{{ route('home') }}" wire:navigate>
                            <img src="{{ asset('assets/img/netpulse.png') }}" alt="NetPulse Logo" class="h-16 w-auto">
                        </a>
                        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">NetPulse</h1>
                    </div>
                    
                    <div class="rounded-2xl border border-zinc-200 bg-white p-8 shadow-xl dark:border-zinc-800 dark:bg-zinc-900/50 dark:backdrop-blur-xl">
                        {{ $slot }}
                    </div>
                    
                    <p class="px-8 text-center text-sm text-zinc-500 dark:text-zinc-400">
                        &copy; {{ date('Y') }} NetPulse NOC. Todos los derechos reservados.
                    </p>
                </div>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>

