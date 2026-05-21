<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NetPulse • Sistema NOC Lite Integrado</title>
    <meta name="description" content="NetPulse es el panel definitivo de administración NOC Lite para monitorear infraestructura, automatizar bitácoras de servicio en PDF y disparar alertas en tiempo real vía WhatsApp y SMTP.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Dark Mode Initial Script -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }
        h1, h2, h3, h4, .font-display {
            font-family: 'Outfit', sans-serif;
        }
        
        /* Floating Orbiting Blobs */
        .glow-blob {
            filter: blur(140px);
            opacity: 0.18;
            transition: all 0.8s ease;
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: -10;
        }
        .dark .glow-blob {
            opacity: 0.32;
        }
        
        @keyframes float-blob-1 {
            0% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(40px, -60px) scale(1.15); }
            66% { transform: translate(-30px, 30px) scale(0.9); }
            100% { transform: translate(0, 0) scale(1); }
        }
        
        @keyframes float-blob-2 {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-50px, 40px) scale(0.85); }
            100% { transform: translate(0, 0) scale(1); }
        }
        
        .animate-blob-1 {
            animation: float-blob-1 18s infinite ease-in-out;
        }
        .animate-blob-2 {
            animation: float-blob-2 15s infinite ease-in-out;
        }

        /* Hover border animation utility */
        .gradient-border-card {
            position: relative;
            background: linear-gradient(to bottom right, rgba(255,255,255,0.8), rgba(255,255,255,0.5));
        }
        .dark .gradient-border-card {
            background: linear-gradient(to bottom right, rgba(24,24,27,0.8), rgba(18,18,18,0.9));
        }

        /* Glow effect for main CTA buttons */
        .btn-glow:hover {
            box-shadow: 0 0 25px rgba(59, 130, 246, 0.45);
        }
        .dark .btn-glow:hover {
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.35);
        }
        
        /* Grid Dots Overlay */
        .grid-dots {
            background-image: radial-gradient(rgba(99, 102, 241, 0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .dark .grid-dots {
            background-image: radial-gradient(rgba(99, 102, 241, 0.15) 1px, transparent 1px);
        }

        /* Smooth accordion height transition */
        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s cubic-bezier(0, 1, 0, 1);
        }
        .accordion-content.open {
            max-height: 1000px;
            transition: max-height 0.4s cubic-bezier(1, 0, 1, 0);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-zinc-950 text-slate-800 dark:text-zinc-100 antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen relative overflow-x-hidden transition-colors duration-300">

    <!-- Ambient Glowing Background shapes -->
    <div class="glow-blob animate-blob-1 top-[-5%] left-[-5%] w-[45vw] h-[45vw] bg-gradient-to-tr from-blue-600/30 to-indigo-500/20"></div>
    <div class="glow-blob animate-blob-2 bottom-[15%] right-[-5%] w-[40vw] h-[40vw] bg-gradient-to-tr from-cyan-400/20 to-blue-600/30"></div>
    <div class="glow-blob top-[40%] left-[20%] w-[30vw] h-[30vw] bg-gradient-to-tr from-purple-500/10 to-indigo-600/20"></div>

    <!-- Navigation Header -->
    <header class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[94%] max-w-6xl">
        <div class="bg-white/80 dark:bg-zinc-900/80 backdrop-blur-xl border border-slate-200/50 dark:border-zinc-800/60 rounded-2xl px-4 sm:px-6 py-3.5 shadow-lg shadow-slate-100/30 dark:shadow-none flex items-center justify-between transition-all duration-300">
            <!-- Brand Logo -->
            <a href="#" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                    <!-- Network pulse SVG -->
                    <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"></path>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="font-display font-extrabold text-lg tracking-tight leading-none bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 dark:from-white dark:via-zinc-200 dark:to-white bg-clip-text text-transparent group-hover:opacity-95 transition-opacity">NetPulse</span>
                    <div class="flex items-center gap-1">
                        <span class="text-[8px] font-bold text-blue-600 dark:text-blue-400 tracking-widest uppercase">NOC LITE SYSTEM</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                    </div>
                </div>
            </a>

            <!-- Mid Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-zinc-400">
                <a href="#features" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Características</a>
                <a href="#showcase" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Demostración en vivo</a>
                <a href="#metrics" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Métricas SLA</a>
                <a href="#faq" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Preguntas Frecuentes</a>
            </nav>

            <!-- Actions and Theme Toggle -->
            <div class="flex items-center gap-3">
                <!-- Theme Toggle Button -->
                <button id="theme-toggle" type="button" class="text-slate-500 dark:text-zinc-400 hover:bg-slate-100 dark:hover:bg-zinc-800 focus:outline-none rounded-xl text-sm p-2.5 transition-colors border border-slate-200/40 dark:border-zinc-800/40" aria-label="Toggle dark mode">
                    <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>

                @if (Route::has('login'))
                    <div class="flex items-center gap-2">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold text-xs rounded-xl tracking-wider uppercase transition-all shadow-md shadow-blue-500/20 active:scale-95 btn-glow" id="nav-dashboard">
                                <span>Panel</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-zinc-300 hover:text-blue-600 dark:hover:text-blue-400 px-3.5 py-2 transition-colors" id="nav-login">
                                Ingresar
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 dark:bg-zinc-800 hover:bg-slate-800 dark:hover:bg-zinc-700 active:scale-95 text-xs font-bold tracking-wider uppercase text-white rounded-xl transition-all shadow-sm border border-transparent dark:border-zinc-700" id="nav-register">
                                    Registro
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-grow flex flex-col items-center px-4 sm:px-6 lg:px-8 pt-36 pb-20 relative z-10 grid-dots bg-fixed">

        <!-- Hero Section -->
        <section class="max-w-5xl mx-auto text-center mt-6 flex flex-col items-center">
            <!-- Pulsing Badge -->
            <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-blue-500/10 dark:bg-blue-500/5 text-blue-700 dark:text-blue-400 text-xs font-semibold tracking-wide mb-8 border border-blue-500/20 dark:border-blue-400/15 shadow-sm">
                <span class="flex w-2 h-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-500 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600 dark:bg-blue-400"></span>
                </span>
                <span>NOC LITE INTEGRADO • 100% OPERATIVO</span>
            </div>

            <!-- Main Title -->
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-8 leading-[1.1] font-display max-w-4xl">
                Gestión Autónoma de <br />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 dark:from-blue-400 dark:via-indigo-400 dark:to-cyan-400">
                    Infraestructura NOC
                </span>
            </h1>

            <!-- Subtitle Description -->
            <p class="text-base sm:text-xl text-slate-600 dark:text-zinc-400 mb-10 max-w-3xl leading-relaxed">
                Controla tickets de soporte, gestiona equipos de telecomunicaciones y automatiza el envío en tiempo real de bitácoras en PDF vía <span class="text-slate-900 dark:text-zinc-100 font-semibold">Gmail SMTP</span> y alertas automatizadas a técnicos por <span class="text-slate-900 dark:text-zinc-100 font-semibold">Twilio WhatsApp</span>.
            </p>

            <!-- Action CTA Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full max-w-md mb-24">
                @auth
                    <a href="{{ route('dashboard') }}" class="w-full inline-flex justify-center items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold rounded-2xl transition-all shadow-lg shadow-blue-500/25 border border-blue-500/10 active:scale-98 btn-glow text-sm uppercase tracking-wider" id="hero-cta-dashboard">
                        <span>Ingresar al Panel Administrativo</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full inline-flex justify-center items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold rounded-2xl transition-all shadow-lg shadow-blue-500/25 border border-blue-500/10 active:scale-98 btn-glow text-sm uppercase tracking-wider" id="hero-cta-login">
                        <span>Acceso para Ingenieros</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"></path>
                        </svg>
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="w-full inline-flex justify-center items-center gap-2 px-8 py-4 bg-white dark:bg-zinc-900 hover:bg-slate-50 dark:hover:bg-zinc-800 text-slate-800 dark:text-zinc-100 font-bold rounded-2xl transition-all border border-slate-200 dark:border-zinc-800/80 shadow-sm text-sm" id="hero-cta-register">
                            <span>Registrar Nueva Cuenta</span>
                        </a>
                    @endif
                @endauth
            </div>
        </section>

        <!-- Dynamic Dashboard Live Simulator Showcase -->
        <section id="showcase" class="w-full max-w-5xl mx-auto px-2 sm:px-6 mb-32">
            <div class="text-center mb-10">
                <span class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest bg-blue-100/50 dark:bg-blue-900/30 px-3 py-1 rounded-md">Consola NOC Interactiva</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white font-display mt-3">Estado Operativo en Tiempo Real</h2>
                <p class="text-slate-500 dark:text-zinc-400 mt-2 text-sm">Visualiza las métricas críticas del sistema de monitoreo integrado.</p>
            </div>

            <div class="relative rounded-2xl border border-slate-200 dark:border-zinc-800/80 bg-white/70 dark:bg-zinc-900/80 backdrop-blur-md shadow-2xl p-2 sm:p-5 transition-all duration-300">
                <!-- Browser window top bar -->
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-zinc-800 px-3">
                    <div class="flex gap-2">
                        <span class="w-3.5 h-3.5 rounded-full bg-red-500/90 shadow-sm"></span>
                        <span class="w-3.5 h-3.5 rounded-full bg-yellow-400/90 shadow-sm"></span>
                        <span class="w-3.5 h-3.5 rounded-full bg-emerald-500/90 shadow-sm"></span>
                    </div>
                    <!-- Mock address bar -->
                    <div class="text-xs bg-slate-100 dark:bg-zinc-950 text-slate-500 dark:text-zinc-400 px-12 py-1.5 rounded-xl font-mono border border-slate-200/30 dark:border-zinc-800/60 max-w-xs truncate">
                        https://netpulse.noc/dashboard
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-bold text-emerald-500 uppercase tracking-wider hidden sm:inline">LIVE</span>
                    </div>
                </div>

                <!-- Showcase Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 pt-5">
                    <!-- Left Sidebar Menu Mockup -->
                    <div class="hidden lg:block lg:col-span-1 border-r border-slate-100 dark:border-zinc-800 pr-5 space-y-1">
                        <div class="p-2.5 bg-blue-500/10 dark:bg-blue-500/5 text-blue-600 dark:text-blue-400 font-bold rounded-xl text-xs flex items-center gap-3">
                            <span class="w-2 h-2 bg-blue-600 dark:bg-blue-400 rounded-full"></span>
                            Panel Principal
                        </div>
                        <div class="p-2.5 text-slate-500 dark:text-zinc-400 font-bold rounded-xl text-xs flex items-center gap-3 hover:bg-slate-100/50 dark:hover:bg-zinc-800/30 transition-all cursor-pointer">
                            <span class="w-2 h-2 bg-transparent border border-slate-400 dark:border-zinc-500 rounded-full"></span>
                            Órdenes de Trabajo
                        </div>
                        <div class="p-2.5 text-slate-500 dark:text-zinc-400 font-bold rounded-xl text-xs flex items-center gap-3 hover:bg-slate-100/50 dark:hover:bg-zinc-800/30 transition-all cursor-pointer">
                            <span class="w-2 h-2 bg-transparent border border-slate-400 dark:border-zinc-500 rounded-full"></span>
                            Catálogo de Clientes
                        </div>
                        <div class="p-2.5 text-slate-500 dark:text-zinc-400 font-bold rounded-xl text-xs flex items-center gap-3 hover:bg-slate-100/50 dark:hover:bg-zinc-800/30 transition-all cursor-pointer">
                            <span class="w-2 h-2 bg-transparent border border-slate-400 dark:border-zinc-500 rounded-full"></span>
                            Equipos de Red
                        </div>
                        <div class="pt-8 px-2.5 text-[10px] font-extrabold text-slate-400 dark:text-zinc-500 uppercase tracking-widest">Monitoreo</div>
                        <div class="p-2.5 text-slate-500 dark:text-zinc-400 font-bold rounded-xl text-xs flex items-center gap-3 hover:bg-slate-100/50 dark:hover:bg-zinc-800/30 transition-all cursor-pointer">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                            SLA Live Pings
                        </div>
                    </div>

                    <!-- Right panel main content -->
                    <div class="col-span-1 lg:col-span-3 space-y-6 text-left px-2 sm:px-4">
                        <!-- Upper Metrics Row -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            <div class="p-4 bg-slate-50 dark:bg-zinc-950 rounded-xl border border-slate-150 dark:border-zinc-800/80">
                                <span class="text-[10px] font-bold text-slate-400 dark:text-zinc-500 uppercase tracking-wider">Router Principal</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="text-xl font-extrabold text-slate-800 dark:text-zinc-100 font-display">10.0.0.1</span>
                                    <span class="text-xs font-bold text-emerald-500">UP</span>
                                </div>
                            </div>
                            <div class="p-4 bg-slate-50 dark:bg-zinc-950 rounded-xl border border-slate-150 dark:border-zinc-800/80">
                                <span class="text-[10px] font-bold text-slate-400 dark:text-zinc-500 uppercase tracking-wider">Latencia Media</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="text-xl font-extrabold text-slate-800 dark:text-zinc-100 font-display">1.42 ms</span>
                                    <span class="text-xs font-bold text-slate-500 dark:text-zinc-500">Excelente</span>
                                </div>
                            </div>
                            <div class="p-4 bg-slate-50 dark:bg-zinc-950 rounded-xl border border-slate-150 dark:border-zinc-800/80 col-span-2 sm:col-span-1">
                                <span class="text-[10px] font-bold text-slate-400 dark:text-zinc-500 uppercase tracking-wider">SLA General</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="text-xl font-extrabold text-slate-800 dark:text-zinc-100 font-display">99.98%</span>
                                    <span class="text-[9px] font-bold px-1.5 py-0.5 rounded bg-emerald-500/10 text-emerald-500 uppercase">OK</span>
                                </div>
                            </div>
                        </div>

                        <!-- Live Terminal Widget Simulation -->
                        <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-zinc-800 bg-slate-950 dark:bg-zinc-950/60 shadow-inner">
                            <!-- Terminal title -->
                            <div class="bg-slate-900 dark:bg-zinc-900 px-4 py-2 border-b border-slate-800 flex items-center justify-between text-xs text-slate-400 dark:text-zinc-400 font-mono">
                                <span>Terminal de Diagnóstico de Red (Live Log)</span>
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></span>
                                    ping -t 10.0.0.1
                                </span>
                            </div>
                            <!-- Terminal body -->
                            <div id="live-terminal" class="p-4 font-mono text-[10px] sm:text-xs text-blue-400 space-y-1 min-h-[140px] max-h-[140px] overflow-y-auto selection:bg-slate-800">
                                <!-- Lines will be added here by JS -->
                                <p class="text-slate-500">// Iniciando servicio de telemetría NetPulse...</p>
                                <p class="text-slate-500">// Escuchando en el puerto 443. Protocolo ICMP activo.</p>
                            </div>
                        </div>

                        <!-- Mock Data Table -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-600 dark:text-zinc-300">Órdenes de Trabajo Recientes</span>
                                <span class="text-[10px] text-blue-600 dark:text-blue-400 font-semibold cursor-pointer hover:underline">Ver todas</span>
                            </div>
                            <div class="overflow-x-auto rounded-xl border border-slate-200/80 dark:border-zinc-800/80">
                                <table class="w-full text-left text-xs border-collapse">
                                    <thead class="bg-slate-50 dark:bg-zinc-800/30 text-slate-500 dark:text-zinc-400 font-bold border-b border-slate-200/50 dark:border-zinc-800">
                                        <tr>
                                            <th class="p-3">Cliente</th>
                                            <th class="p-3">Servicio / Equipo</th>
                                            <th class="p-3">Estado</th>
                                            <th class="p-3 text-right">Canal Notificado</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-150 dark:divide-zinc-800/60 bg-white dark:bg-zinc-900/40">
                                        <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800/20 transition-colors">
                                            <td class="p-3 font-semibold text-slate-800 dark:text-zinc-200">Tech Solutions SA</td>
                                            <td class="p-3 text-slate-500 dark:text-zinc-400">MikroTik Switch CRS326</td>
                                            <td class="p-3">
                                                <span class="inline-flex px-2 py-0.5 rounded-full bg-emerald-500/10 dark:bg-emerald-500/5 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold uppercase border border-emerald-500/15">Completado</span>
                                            </td>
                                            <td class="p-3 text-right">
                                                <span class="inline-flex items-center gap-1.5 text-blue-600 dark:text-blue-400 font-bold text-[10px]">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                                    PDF &amp; Gmail OK
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800/20 transition-colors">
                                            <td class="p-3 font-semibold text-slate-800 dark:text-zinc-200">RACA Electromecánicas</td>
                                            <td class="p-3 text-slate-500 dark:text-zinc-400">OLT GPON Huawei EA5800</td>
                                            <td class="p-3">
                                                <span class="inline-flex px-2 py-0.5 rounded-full bg-amber-500/10 dark:bg-amber-500/5 text-amber-600 dark:text-amber-400 text-[10px] font-bold uppercase border border-amber-500/15">En Sitio</span>
                                            </td>
                                            <td class="p-3 text-right">
                                                <span class="inline-flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 font-bold text-[10px]">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                    WhatsApp Enviado
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800/20 transition-colors">
                                            <td class="p-3 font-semibold text-slate-800 dark:text-zinc-200">Corporativo ACME</td>
                                            <td class="p-3 text-slate-500 dark:text-zinc-400">Router Cisco ISR 4331</td>
                                            <td class="p-3">
                                                <div class="flex items-center gap-2">
                                                    <span class="inline-flex px-2 py-0.5 rounded-full bg-rose-500/10 dark:bg-rose-500/5 text-rose-600 dark:text-rose-400 text-[10px] font-bold uppercase border border-rose-500/15">Cancelado</span>
                                                    <span class="w-3.5 h-3.5 rounded-full bg-rose-500/10 text-rose-500 flex items-center justify-center font-bold text-[9px] cursor-help" title="Falta de acceso físico al rack corporativo.">?</span>
                                                </div>
                                            </td>
                                            <td class="p-3 text-right">
                                                <span class="text-slate-400 dark:text-zinc-500 text-[10px]">Alerta de SLA</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Interactive Feature Tabs Explorer -->
        <section class="w-full max-w-5xl mx-auto px-4 mb-32">
            <div class="text-center mb-12">
                <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest bg-indigo-150/40 dark:bg-indigo-900/20 px-3 py-1 rounded-md">Demostración Visual</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white font-display mt-3">Explora el Flujo de Trabajo</h2>
                <p class="text-slate-500 dark:text-zinc-400 mt-2 max-w-2xl mx-auto text-sm">Alterna entre los diferentes módulos interactivos para observar cómo funciona la automatización.</p>
            </div>

            <!-- Tab Buttons Container -->
            <div class="grid grid-cols-3 gap-2 sm:gap-4 max-w-3xl mx-auto mb-8 bg-slate-100 dark:bg-zinc-900/60 p-1.5 rounded-2xl border border-slate-200/50 dark:border-zinc-800/80">
                <button onclick="switchTab('whatsapp-tab')" id="btn-whatsapp-tab" class="tab-btn py-3 px-2 sm:px-4 rounded-xl text-xs font-extrabold uppercase tracking-wide flex flex-col sm:flex-row items-center justify-center gap-2 transition-all bg-white dark:bg-zinc-800 text-blue-600 dark:text-white shadow-sm border border-slate-200/20 dark:border-zinc-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.73-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.725 1.45 5.503 0 9.98-4.47 9.985-9.97.002-2.665-1.03-5.166-2.91-7.048C16.57 1.75 14.09.718 11.43.718 5.925.718 1.448 5.2 1.443 10.7c-.001 1.637.426 3.233 1.238 4.673l-.997 3.637 3.73-.979zm11.23-6.524c-.302-.15-1.786-.882-2.062-.983-.277-.1-.478-.15-.68.15-.2.3-.777.983-.95 1.183-.175.2-.35.225-.65.075-.3-.15-1.272-.47-2.423-1.496-.895-.8-1.5-1.787-1.277-2.18.22-.38.074-.59-.074-.74-.14-.14-.3-.35-.45-.526-.15-.175-.2-.3-.3-.5-.1-.2-.05-.375.025-.525.075-.15.68-1.65.93-2.15.244-.5.488-.4.68-.4.175-.01.375-.01.575-.01.2 0 .525.075.8.375.275.3 1.05 2.56 1.14 2.74.09.18.15.39.03.63-.12.24-.25.39-.375.54-.125.15-.262.337-.375.45-.125.125-.25.263-.1.525.15.263.663 1.092 1.425 1.77 1 .9 1.838 1.182 2.1 1.307.262.125.412.1.562-.075.15-.175.637-.74.812-1 .175-.263.35-.225.65-.075s1.787.882 2.062.983c.277.1.462.15.525.263.063.112.063.65-.187.95z"></path>
                    </svg>
                    <span>Alertas WhatsApp</span>
                </button>
                <button onclick="switchTab('pdf-tab')" id="btn-pdf-tab" class="tab-btn py-3 px-2 sm:px-4 rounded-xl text-xs font-extrabold uppercase tracking-wide flex flex-col sm:flex-row items-center justify-center gap-2 transition-all text-slate-500 dark:text-zinc-400 hover:text-slate-800 dark:hover:text-zinc-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                    </svg>
                    <span>Bitácoras PDF</span>
                </button>
                <button onclick="switchTab('monitoring-tab')" id="btn-monitoring-tab" class="tab-btn py-3 px-2 sm:px-4 rounded-xl text-xs font-extrabold uppercase tracking-wide flex flex-col sm:flex-row items-center justify-center gap-2 transition-all text-slate-500 dark:text-zinc-400 hover:text-slate-800 dark:hover:text-zinc-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a3 3 0 013-3v-3a3 3 0 013-3h6a3 3 0 013 3v3a3 3 0 013 3M4.5 9h15"></path>
                    </svg>
                    <span>Monitoreo SLA</span>
                </button>
            </div>

            <!-- Tab Contents Wrapper -->
            <div class="relative bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800/80 rounded-2xl p-4 sm:p-8 min-h-[380px] shadow-lg flex flex-col justify-center">
                <!-- 1. WhatsApp Tab -->
                <div id="whatsapp-tab" class="tab-content block space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div class="space-y-4 text-left">
                            <div class="w-10 h-10 rounded-lg bg-emerald-500/10 text-emerald-500 flex items-center justify-center font-bold text-xl">W</div>
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white font-display">Notificaciones de Campo en Tiempo Real</h3>
                            <p class="text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                                Cuando una orden de trabajo cambia su estado a <strong class="text-slate-800 dark:text-zinc-200 font-semibold">"En Sitio"</strong>, NetPulse utiliza la API oficial de Twilio WhatsApp para enviar alertas inmediatas con geolocalización y datos del cliente a los ingenieros en campo.
                            </p>
                            <div class="flex items-center gap-4 text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-500/5 p-3 rounded-lg border border-emerald-500/10">
                                <span>✔ Activador en tiempo real</span>
                                <span>✔ Sin dependencias adicionales</span>
                            </div>
                        </div>
                        <!-- Simulated Smartphone screen -->
                        <div class="bg-slate-100 dark:bg-zinc-950 p-4 rounded-3xl border-4 border-slate-300 dark:border-zinc-800 shadow-xl max-w-sm mx-auto w-full">
                            <div class="bg-zinc-900 text-white rounded-2xl overflow-hidden text-xs">
                                <!-- Chat Header -->
                                <div class="bg-zinc-850 px-3 py-3 border-b border-zinc-800 flex items-center gap-2">
                                    <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center font-bold text-[10px] text-white">N</div>
                                    <div class="text-left">
                                        <div class="font-bold flex items-center gap-1">NetPulse NOC Alerts <span class="text-[8px] bg-emerald-500/20 text-emerald-400 px-1 rounded-sm">Verificado</span></div>
                                        <div class="text-[8px] text-zinc-400">Cuenta de empresa</div>
                                    </div>
                                </div>
                                <!-- Chat Body -->
                                <div class="p-3 space-y-3 min-h-[160px] bg-slate-900 text-left font-sans flex flex-col justify-end">
                                    <div class="bg-zinc-800 p-2.5 rounded-lg max-w-[85%] text-[10px] space-y-1.5 shadow-sm text-zinc-200">
                                        <p class="font-bold text-amber-400">🚨 ACTUALIZACIÓN DE TICKET</p>
                                        <p><strong>ID:</strong> #WO-2026-089</p>
                                        <p><strong>Cliente:</strong> RACA Electromecánicas</p>
                                        <p><strong>Estado:</strong> <span class="bg-amber-500/20 text-amber-300 px-1 py-0.5 rounded font-mono font-bold">EN SITIO</span></p>
                                        <p class="text-[9px] text-zinc-400 mt-1">Ing. asignado para diagnóstico en switch de agregación Core-3.</p>
                                    </div>
                                    <div class="bg-zinc-800 p-2 rounded-lg max-w-[85%] text-[9px] text-zinc-300 self-start shadow-sm">
                                        Enlace a bitácora de servicio disponible para edición local.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. PDF Tab -->
                <div id="pdf-tab" class="tab-content hidden space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div class="space-y-4 text-left">
                            <div class="w-10 h-10 rounded-lg bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-xl">PDF</div>
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white font-display">Generación de Bitácoras Profesionales</h3>
                            <p class="text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                                Documenta cada intervención técnica con firmas digitales de aceptación. Exporta documentos PDF limpios con estructura corporativa y envíalos de manera automática al cliente final mediante nuestra cola SMTP.
                            </p>
                            <div class="flex items-center gap-4 text-xs font-semibold text-blue-600 dark:text-blue-400 bg-blue-500/5 p-3 rounded-lg border border-blue-500/10">
                                <span>✔ Firma digital integrada</span>
                                <span>✔ Envío automático por correo</span>
                            </div>
                        </div>
                        <!-- Simulated PDF viewer document -->
                        <div class="bg-slate-100 dark:bg-zinc-950 p-4 rounded-xl border border-slate-200 dark:border-zinc-800 shadow-md max-w-sm mx-auto w-full text-left font-serif text-[9px] text-slate-700 dark:text-zinc-400 space-y-3">
                            <div class="flex justify-between border-b pb-2 border-slate-200 dark:border-zinc-800">
                                <div>
                                    <h4 class="font-bold font-sans text-slate-900 dark:text-zinc-200 text-xs">BITÁCORA DE SERVICIO NOC</h4>
                                    <p class="text-[8px]">Folio: #NP-9928-2026</p>
                                </div>
                                <span class="font-sans font-extrabold text-[10px] text-blue-600">NetPulse</span>
                            </div>
                            <div class="space-y-1 font-sans text-[8px]">
                                <p><strong>Cliente:</strong> Tech Solutions SA de CV</p>
                                <p><strong>Fecha de Emisión:</strong> 2026-05-20</p>
                                <p><strong>Dispositivo:</strong> MikroTik RouterBoard 3011</p>
                            </div>
                            <div class="space-y-1 font-sans">
                                <p class="font-bold text-[8px] border-b pb-0.5 border-slate-200 dark:border-zinc-800">ACTIVIDADES REALIZADAS</p>
                                <p class="text-slate-500">1. Diagnóstico de cableado y reemplazo de patchcord categoría 6A.</p>
                                <p class="text-slate-500">2. Reconfiguración de NAT e interfaces WAN del balanceador.</p>
                            </div>
                            <div class="pt-4 flex justify-between items-end font-sans">
                                <div class="text-center w-24">
                                    <!-- Fake handwriting signature -->
                                    <span class="font-sans text-[11px] italic text-blue-500 block border-b border-slate-300 pb-1">M. Ramos</span>
                                    <span class="text-[7px]">Firma Técnico</span>
                                </div>
                                <div class="text-center w-24">
                                    <span class="font-sans text-[11px] italic text-indigo-500 block border-b border-slate-300 pb-1">Ing. A. Cabrera</span>
                                    <span class="text-[7px]">Firma Cliente</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Monitoring Tab -->
                <div id="monitoring-tab" class="tab-content hidden space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div class="space-y-4 text-left">
                            <div class="w-10 h-10 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-xl">SLA</div>
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white font-display">Monitoreo Continuo e Historial de Ping</h3>
                            <p class="text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                                Mantén a la vista el estado de cada switch, OLT, router o gateway asociado a tus clientes. La vista consolidada permite detectar problemas antes de recibir la llamada de soporte y calcular el cumplimiento del SLA real de forma matemática.
                            </p>
                            <div class="flex items-center gap-4 text-xs font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-500/5 p-3 rounded-lg border border-indigo-500/10">
                                <span>✔ Cálculo de disponibilidad en %</span>
                                <span>✔ Gestión centralizada de IPs</span>
                            </div>
                        </div>
                        <!-- Monitoring diagram simulation -->
                        <div class="bg-slate-50 dark:bg-zinc-950 p-4 rounded-xl border border-slate-200 dark:border-zinc-800 shadow-sm max-w-sm mx-auto w-full space-y-3.5 text-left font-sans text-xs">
                            <span class="text-[10px] font-bold text-slate-400 dark:text-zinc-500 uppercase tracking-widest block">Dispositivos en Red</span>
                            
                            <div class="flex items-center justify-between p-2 bg-white dark:bg-zinc-900 rounded-lg border border-slate-150 dark:border-zinc-800/80">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                    <span class="font-bold text-slate-800 dark:text-zinc-200">Core-Switch-01</span>
                                </div>
                                <span class="font-mono text-slate-500 dark:text-zinc-400 text-[10px]">10.0.1.10 - 2ms</span>
                            </div>

                            <div class="flex items-center justify-between p-2 bg-white dark:bg-zinc-900 rounded-lg border border-slate-150 dark:border-zinc-800/80">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full"></span>
                                    <span class="font-bold text-slate-800 dark:text-zinc-200">GPON-OLT-R1</span>
                                </div>
                                <span class="font-mono text-slate-500 dark:text-zinc-400 text-[10px]">10.0.2.1 - 4ms</span>
                            </div>

                            <div class="flex items-center justify-between p-2 bg-white dark:bg-zinc-900 rounded-lg border border-slate-150 dark:border-zinc-800/80">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 bg-rose-500 rounded-full animate-ping"></span>
                                    <span class="font-bold text-slate-800 dark:text-zinc-200">Client-Router-Cisco</span>
                                </div>
                                <span class="font-mono text-rose-500 text-[10px] font-bold">Timeout</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section Grid -->
        <section id="features" class="w-full max-w-6xl mx-auto px-4 mb-32 relative">
            <div class="text-center mb-16">
                <span class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest bg-blue-100/50 dark:bg-blue-900/30 px-3 py-1 rounded-md">Arquitectura del Sistema</span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-900 dark:text-white font-display mt-3">Diseñado para Operaciones Críticas</h2>
                <p class="text-slate-600 dark:text-zinc-400 max-w-xl mx-auto mt-2 text-sm sm:text-base">Una suite modular de telecomunicaciones construida para resolver incidentes en la mitad del tiempo.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Feature 1: Twilio WhatsApp -->
                <div class="group relative bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800/80 rounded-2xl p-6 shadow-sm hover:shadow-xl dark:hover:shadow-zinc-900/30 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <!-- WhatsApp SVG Icon -->
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.73-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.725 1.45 5.503 0 9.98-4.47 9.985-9.97.002-2.665-1.03-5.166-2.91-7.048C16.57 1.75 14.09.718 11.43.718 5.925.718 1.448 5.2 1.443 10.7c-.001 1.637.426 3.233 1.238 4.673l-.997 3.637 3.73-.979zm11.23-6.524c-.302-.15-1.786-.882-2.062-.983-.277-.1-.478-.15-.68.15-.2.3-.777.983-.95 1.183-.175.2-.35.225-.65.075-.3-.15-1.272-.47-2.423-1.496-.895-.8-1.5-1.787-1.277-2.18.22-.38.074-.59-.074-.74-.14-.14-.3-.35-.45-.526-.15-.175-.2-.3-.3-.5-.1-.2-.05-.375.025-.525.075-.15.68-1.65.93-2.15.244-.5.488-.4.68-.4.175-.01.375-.01.575-.01.2 0 .525.075.8.375.275.3 1.05 2.56 1.14 2.74.09.18.15.39.03.63-.12.24-.25.39-.375.54-.125.15-.262.337-.375.45-.125.125-.25.263-.1.525.15.263.663 1.092 1.425 1.77 1 .9 1.838 1.182 2.1 1.307.262.125.412.1.562-.075.15-.175.637-.74.812-1 .175-.263.35-.225.65-.075s1.787.882 2.062.983c.277.1.462.15.525.263.063.112.063.65-.187.95z"></path>
                        </svg>
                    </div>
                    <h3 class="font-display font-bold text-lg text-slate-900 dark:text-white mb-2">WhatsApp Twilio API</h3>
                    <p class="text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">Notificaciones inmediatas a técnicos en campo cuando las órdenes cambian a estado de servicio "En Sitio".</p>
                </div>

                <!-- Feature 2: SMTP real con Gmail -->
                <div class="group relative bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800/80 rounded-2xl p-6 shadow-sm hover:shadow-xl dark:hover:shadow-zinc-900/30 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l8-5.333a2 2 0 012.22 0l8 5.333A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-2.25-1.5a2 2 0 00-2.22 0l-2.25 1.5"></path>
                        </svg>
                    </div>
                    <h3 class="font-display font-bold text-lg text-slate-900 dark:text-white mb-2">SMTP Gmail Integrado</h3>
                    <p class="text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">Envío de bitácoras de servicio directo en PDF con firmas del técnico, enviado con total seguridad en segundo plano.</p>
                </div>

                <!-- Feature 3: Exportes de PDF e informes -->
                <div class="group relative bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800/80 rounded-2xl p-6 shadow-sm hover:shadow-xl dark:hover:shadow-zinc-900/30 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-display font-bold text-lg text-slate-900 dark:text-white mb-2">Descargas sin Spam</h3>
                    <p class="text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">Exclusivo doble flujo que permite al ingeniero previsualizar y descargar PDFs directamente sin saturar de notificaciones.</p>
                </div>

                <!-- Feature 4: Device monitoring -->
                <div class="group relative bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800/80 rounded-2xl p-6 shadow-sm hover:shadow-xl dark:hover:shadow-zinc-900/30 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/10 text-cyan-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                        </svg>
                    </div>
                    <h3 class="font-display font-bold text-lg text-slate-900 dark:text-white mb-2">Equipos y Dispositivos</h3>
                    <p class="text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">Catálogo unificado para rastrear hardware de red (Cisco, Huawei, MikroTik) asociado por cliente y números de serie.</p>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section id="metrics" class="w-full max-w-5xl mx-auto px-4 mb-32">
            <div class="rounded-3xl bg-slate-900 dark:bg-zinc-900 border border-slate-800 dark:border-zinc-800 p-8 sm:p-12 relative overflow-hidden shadow-2xl">
                <!-- Grid background inside stats -->
                <div class="absolute inset-0 bg-[radial-gradient(#1e293b_1px,transparent_1px)] dark:bg-[radial-gradient(#27272a_1px,transparent_1px)] [background-size:24px_24px] opacity-40"></div>

                <div class="relative grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                    <div class="space-y-1">
                        <div class="text-xs text-blue-400 font-bold uppercase tracking-widest flex items-center justify-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-ping"></span>
                            Uptime SLA
                        </div>
                        <h4 class="text-3xl sm:text-5xl font-extrabold text-white font-display mt-2">99.98%</h4>
                        <p class="text-[10px] text-slate-400 dark:text-zinc-400">Garantía Operativa</p>
                    </div>
                    <div class="space-y-1">
                        <div class="text-xs text-emerald-400 font-bold uppercase tracking-widest flex items-center justify-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                            Despacho
                        </div>
                        <h4 class="text-3xl sm:text-5xl font-extrabold text-white font-display mt-2">&lt; 15s</h4>
                        <p class="text-[10px] text-slate-400 dark:text-zinc-400">Latencia de Alerta</p>
                    </div>
                    <div class="space-y-1">
                        <div class="text-xs text-indigo-400 font-bold uppercase tracking-widest flex items-center justify-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                            Bitácoras
                        </div>
                        <h4 class="text-3xl sm:text-5xl font-extrabold text-white font-display mt-2">100%</h4>
                        <p class="text-[10px] text-slate-400 dark:text-zinc-400">Generadas en Digital</p>
                    </div>
                    <div class="space-y-1">
                        <div class="text-xs text-cyan-400 font-bold uppercase tracking-widest flex items-center justify-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                            Seguridad
                        </div>
                        <h4 class="text-3xl sm:text-5xl font-extrabold text-white font-display mt-2">SSL/TLS</h4>
                        <p class="text-[10px] text-slate-400 dark:text-zinc-400">Conexión Encriptada</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section id="faq" class="w-full max-w-4xl mx-auto px-4 mb-16">
            <div class="text-center mb-12">
                <span class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest bg-blue-100/50 dark:bg-blue-900/30 px-3 py-1 rounded-md">Preguntas Frecuentes</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white font-display mt-3">Preguntas Frecuentes</h2>
                <p class="text-slate-500 dark:text-zinc-400 mt-2 text-sm">Resuelve tus dudas sobre la implementación y arquitectura de NetPulse.</p>
            </div>

            <!-- Accordion Container -->
            <div class="space-y-4">
                <!-- Item 1 -->
                <div class="bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800/80 rounded-2xl overflow-hidden transition-all shadow-sm">
                    <button onclick="toggleAccordion('faq-1')" class="w-full p-5 text-left font-bold text-sm sm:text-base text-slate-900 dark:text-white flex items-center justify-between gap-4 focus:outline-none hover:bg-slate-50/50 dark:hover:bg-zinc-800/20 transition-all">
                        <span>¿Qué es NetPulse NOC Lite?</span>
                        <svg id="arrow-faq-1" class="w-5 h-5 text-slate-400 transition-transform duration-350" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                        </svg>
                    </button>
                    <div id="faq-1" class="accordion-content">
                        <div class="p-5 pt-0 border-t border-slate-100 dark:border-zinc-800 text-xs sm:text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                            Es una solución integrada para la gestión de incidencias de red orientada a NOCs (Network Operation Centers) pequeños y medianos. Permite realizar seguimiento de órdenes de trabajo, registrar equipos del lado del cliente y disparar notificaciones inmediatas a técnicos vía WhatsApp y por correo.
                        </div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800/80 rounded-2xl overflow-hidden transition-all shadow-sm">
                    <button onclick="toggleAccordion('faq-2')" class="w-full p-5 text-left font-bold text-sm sm:text-base text-slate-900 dark:text-white flex items-center justify-between gap-4 focus:outline-none hover:bg-slate-50/50 dark:hover:bg-zinc-800/20 transition-all">
                        <span>¿Cómo funciona la integración de notificaciones de WhatsApp?</span>
                        <svg id="arrow-faq-2" class="w-5 h-5 text-slate-400 transition-transform duration-350" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                        </svg>
                    </button>
                    <div id="faq-2" class="accordion-content">
                        <div class="p-5 pt-0 border-t border-slate-100 dark:border-zinc-800 text-xs sm:text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                            NetPulse integra la API oficial de Twilio para WhatsApp. Cuando un administrador o técnico actualiza una orden de trabajo asignándole un estado "En Sitio", el backend envía automáticamente un mensaje JSON con formato estructurado al número registrado del técnico de campo.
                        </div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800/80 rounded-2xl overflow-hidden transition-all shadow-sm">
                    <button onclick="toggleAccordion('faq-3')" class="w-full p-5 text-left font-bold text-sm sm:text-base text-slate-900 dark:text-white flex items-center justify-between gap-4 focus:outline-none hover:bg-slate-50/50 dark:hover:bg-zinc-800/20 transition-all">
                        <span>¿Es posible usar el sistema sin configurar Twilio o Gmail SMTP?</span>
                        <svg id="arrow-faq-3" class="w-5 h-5 text-slate-400 transition-transform duration-350" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                        </svg>
                    </button>
                    <div id="faq-3" class="accordion-content">
                        <div class="p-5 pt-0 border-t border-slate-100 dark:border-zinc-800 text-xs sm:text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                            Sí, NetPulse es completamente funcional para control interno de tickets y base de datos de equipos incluso sin configurar credenciales externas. Los PDFs de las bitácoras pueden previsualizarse y descargarse de forma directa en el navegador sin disparar los flujos de correo saliente.
                        </div>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800/80 rounded-2xl overflow-hidden transition-all shadow-sm">
                    <button onclick="toggleAccordion('faq-4')" class="w-full p-5 text-left font-bold text-sm sm:text-base text-slate-900 dark:text-white flex items-center justify-between gap-4 focus:outline-none hover:bg-slate-50/50 dark:hover:bg-zinc-800/20 transition-all">
                        <span>¿Qué tecnologías componen el backend de NetPulse?</span>
                        <svg id="arrow-faq-4" class="w-5 h-5 text-slate-400 transition-transform duration-350" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                        </svg>
                    </button>
                    <div id="faq-4" class="accordion-content">
                        <div class="p-5 pt-0 border-t border-slate-100 dark:border-zinc-800 text-xs sm:text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                            Está construido bajo Laravel 11, utilizando el motor de renderizado Livewire para componentes interactivos dinámicos del panel principal. La base de datos es gestionada a través de Eloquent ORM brindando soporte nativo para PostgreSQL, MySQL o SQLite.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="w-full py-12 bg-white dark:bg-zinc-950 border-t border-slate-200/60 dark:border-zinc-900/80 mt-auto transition-colors text-xs text-slate-500 dark:text-zinc-500">
        <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <span class="font-display font-extrabold text-sm text-slate-800 dark:text-zinc-300">NetPulse NOC Systems</span>
                <span class="text-slate-300 dark:text-zinc-800">|</span>
                <span>Suite de Telecomunicaciones Integrada</span>
            </div>
            <div class="flex flex-col items-center md:items-end gap-1.5">
                <p>&copy; {{ date('Y') }} NetPulse. Desarrollado con Laravel 11, Livewire &amp; Twilio API.</p>
                <div class="flex gap-4 font-semibold">
                    <a href="#features" class="hover:text-blue-600 transition-colors">Características</a>
                    <a href="#showcase" class="hover:text-blue-600 transition-colors">Visualizador</a>
                    <a href="#metrics" class="hover:text-blue-600 transition-colors">SLA</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Interactive Scripts (Tabs, Accordeon, Live Terminal) -->
    <script>
        // Theme toggler logic
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });

        // Tabs switcher logic
        function switchTab(tabId) {
            // Hide all tab contents
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('block');
            });

            // Show current tab content
            const activeContent = document.getElementById(tabId);
            activeContent.classList.remove('hidden');
            activeContent.classList.add('block');

            // Deactivate all tab buttons styling
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => {
                btn.classList.remove('bg-white', 'dark:bg-zinc-800', 'text-blue-600', 'dark:text-white', 'shadow-sm', 'border', 'border-slate-200/20', 'dark:border-zinc-700');
                btn.classList.add('text-slate-500', 'dark:text-zinc-400', 'hover:text-slate-800', 'dark:hover:text-zinc-200');
            });

            // Activate current button styling
            const currentBtn = document.getElementById('btn-' + tabId);
            currentBtn.classList.remove('text-slate-500', 'dark:text-zinc-400', 'hover:text-slate-800', 'dark:hover:text-zinc-200');
            currentBtn.classList.add('bg-white', 'dark:bg-zinc-800', 'text-blue-600', 'dark:text-white', 'shadow-sm', 'border', 'border-slate-200/20', 'dark:border-zinc-700');
        }

        // Accordion logic
        function toggleAccordion(id) {
            const el = document.getElementById(id);
            const arrow = document.getElementById('arrow-' + id);
            
            // Check if open
            if (el.classList.contains('open')) {
                el.classList.remove('open');
                arrow.classList.remove('rotate-180');
            } else {
                // Close all others
                document.querySelectorAll('.accordion-content').forEach(acc => {
                    acc.classList.remove('open');
                });
                document.querySelectorAll('[id^="arrow-faq"]').forEach(arr => {
                    arr.classList.remove('rotate-180');
                });
                
                // Open selected
                el.classList.add('open');
                arrow.classList.add('rotate-180');
            }
        }

        // Live Diagnostic Terminal Simulation Script
        const terminalEl = document.getElementById('live-terminal');
        const simulatedIps = ['10.0.0.1', '10.0.1.10', '10.0.2.1'];
        let seq = 1;

        function addPingLine() {
            if (!terminalEl) return;
            
            // Limit lines count
            if (terminalEl.children.length > 15) {
                terminalEl.removeChild(terminalEl.children[2]); // Keep first two comments
            }
            
            const randomIp = simulatedIps[Math.floor(Math.random() * simulatedIps.length)];
            const time = (Math.random() * 2 + 0.5).toFixed(2);
            const ttl = Math.floor(Math.random() * 4) + 60;
            
            const p = document.createElement('p');
            p.className = 'transition-all duration-300 opacity-0 translate-y-2';
            p.innerHTML = `<span class="text-zinc-500 font-bold">[${new Date().toLocaleTimeString()}]</span> 64 bytes from <span class="text-indigo-400">${randomIp}</span>: icmp_seq=${seq} ttl=${ttl} time=<span class="text-emerald-400 font-semibold">${time} ms</span>`;
            
            terminalEl.appendChild(p);
            
            // Scroll to bottom
            terminalEl.scrollTop = terminalEl.scrollHeight;
            seq++;

            // Trigger animation
            setTimeout(() => {
                p.classList.remove('opacity-0', 'translate-y-2');
            }, 50);
        }

        // Start ping stream and add new line every 2.5 seconds
        setInterval(addPingLine, 2500);
        addPingLine(); // Initial call
    </script>
</body>
</html>
