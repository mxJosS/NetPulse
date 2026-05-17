<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        <style>
            body { 
                font-family: 'Plus Jakarta Sans', sans-serif; 
            }
            h1, h2, h3, h4, .font-display {
                font-family: 'Outfit', sans-serif;
            }
            .auth-gradient {
                background: radial-gradient(circle at top right, #090919 0%, #020205 100%);
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
                background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, transparent 70%);
                filter: blur(80px);
                animation: float 20s infinite alternate;
            }
            .auth-gradient::after {
                content: '';
                position: absolute;
                bottom: -20%;
                left: -10%;
                width: 80%;
                height: 80%;
                background: radial-gradient(circle, rgba(99, 102, 241, 0.12) 0%, transparent 70%);
                filter: blur(80px);
                animation: float 15s infinite alternate-reverse;
            }
            @keyframes float {
                0% { transform: translate(0, 0) scale(1); }
                100% { transform: translate(4%, 4%) scale(1.08); }
            }
        </style>
    </head>
    <body class="min-h-screen bg-slate-50 dark:bg-zinc-950 antialiased transition-colors duration-300">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0 relative overflow-hidden">
            
            <!-- Left Panel (Visual Showcase & Quotes) -->
            <div class="auth-gradient relative hidden h-full flex-col p-12 text-white lg:flex dark:border-e dark:border-zinc-900">
                <div class="absolute inset-0 bg-zinc-950/20"></div>
                
                <!-- Background Dot Grid -->
                <div class="absolute inset-0 z-10 opacity-[0.02]" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 24px 24px;"></div>

                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="relative z-20 flex items-center gap-3 text-2xl font-bold tracking-tight" wire:navigate>
                    <img src="{{ asset('assets/img/netpulse.png') }}" alt="NetPulse Logo" class="h-10 w-auto hover:scale-105 transition-transform duration-300">
                    <div class="flex flex-col">
                        <span class="font-display font-extrabold text-lg tracking-tight leading-none">NetPulse</span>
                        <span class="text-[9px] font-bold text-blue-400 tracking-widest uppercase mt-0.5">NOC LITE SYSTEM</span>
                    </div>
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

                <!-- Quote Section -->
                <div class="relative z-20 flex flex-1 flex-col items-center justify-center text-center">
                    <div class="max-w-lg space-y-12">
                        <!-- Author Image with Premium Rings -->
                        <div class="relative mx-auto h-56 w-56">
                            <div class="absolute -inset-6 rounded-full bg-gradient-to-tr from-blue-600/30 to-indigo-500/30 blur-3xl animate-pulse"></div>
                            <div class="absolute -inset-1 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 opacity-60"></div>
                            <div class="absolute -inset-2.5 rounded-full border border-white/10"></div>
                            <img src="{{ asset('assets/img/' . $quote['image']) }}" 
                                 alt="{{ $quote['author'] }}" 
                                 class="relative h-full w-full rounded-full border-4 border-white/20 object-cover shadow-[0_0_60px_rgba(0,0,0,0.6)]">
                        </div>

                        <!-- Quote Block -->
                        <blockquote class="space-y-6">
                            <div class="relative">
                                <svg class="absolute -top-12 -left-4 h-20 w-20 text-blue-500/10" fill="currentColor" viewBox="0 0 32 32">
                                    <path d="M10 8v8H6c0 4.411 3.589 8 8 8V8H10zm12 0v8h-4c0 4.411 3.589 8 8 8V8h-4z"/>
                                </svg>
                                <p class="text-3xl font-light italic leading-tight text-white/95 lg:text-4xl font-display">
                                    &ldquo;{{ $quote['quote'] }}&rdquo;
                                </p>
                            </div>
                            
                            <footer class="flex flex-col items-center gap-3">
                                <span class="text-2xl font-bold tracking-tight text-white font-display">{{ $quote['author'] }}</span>
                                <div class="flex items-center gap-4">
                                    <div class="h-px w-10 bg-gradient-to-r from-transparent to-blue-500/80"></div>
                                    <span class="text-[9px] uppercase tracking-[0.5em] text-blue-400 font-extrabold">Mentalidad NetPulse</span>
                                    <div class="h-px w-10 bg-gradient-to-l from-transparent to-blue-500/80"></div>
                                </div>
                            </footer>
                        </blockquote>
                    </div>
                </div>

                <!-- Left Panel Footer -->
                <div class="relative z-20 mt-auto flex justify-between text-[9px] font-bold text-white/20 uppercase tracking-[0.3em]">
                    <span>Infraestructura</span>
                    <span>Seguridad</span>
                    <span>Rendimiento</span>
                </div>
            </div>
            
            <!-- Right Panel (Login Container) -->
            <div class="w-full lg:p-8 bg-slate-50 dark:bg-zinc-950 flex items-center justify-center min-h-screen relative z-10">
                <!-- Dot Grid overlay for Right Panel -->
                <div class="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] dark:bg-[radial-gradient(#27272a_1px,transparent_1px)] [background-size:16px_16px] opacity-25 -z-10"></div>
                <div class="absolute top-[10%] right-[10%] w-[30%] h-[30%] bg-blue-500/5 rounded-full blur-[80px] -z-10"></div>

                <div class="mx-auto flex w-full flex-col justify-center space-y-8 sm:w-[420px] px-4">
                    <!-- Mobile View Logo -->
                    <div class="flex flex-col items-center gap-4 lg:hidden">
                        <a href="{{ route('home') }}" class="flex items-center gap-3" wire:navigate>
                            <img src="{{ asset('assets/img/netpulse.png') }}" alt="NetPulse Logo" class="h-12 w-auto hover:scale-105 transition-transform duration-300">
                        </a>
                        <div class="text-center">
                            <h1 class="text-2xl font-extrabold text-zinc-900 dark:text-white font-display">NetPulse</h1>
                            <span class="text-[9px] font-bold text-blue-600 dark:text-blue-400 tracking-widest uppercase">NOC LITE SYSTEM</span>
                        </div>
                    </div>
                    
                    <!-- Glassmorphism Container Card -->
                    <div class="rounded-3xl border border-slate-200/80 bg-white/90 p-8 shadow-2xl shadow-slate-100 dark:border-zinc-800/80 dark:bg-zinc-900/60 dark:backdrop-blur-xl dark:shadow-none">
                        {{ $slot }}
                    </div>
                    
                    <p class="px-8 text-center text-xs text-zinc-400 dark:text-zinc-500">
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

