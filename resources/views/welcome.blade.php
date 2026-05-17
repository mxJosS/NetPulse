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
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

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
        .glow-blob {
            filter: blur(130px);
            opacity: 0.15;
            transition: all 0.5s ease;
        }
        .dark .glow-blob {
            opacity: 0.25;
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-zinc-950 text-slate-800 dark:text-zinc-100 antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen relative overflow-x-hidden transition-colors duration-300">

    <!-- Glowing Background Atmosphere -->
    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-gradient-to-tr from-blue-600 to-indigo-500 rounded-full glow-blob -z-10"></div>
    <div class="absolute bottom-[20%] right-[-10%] w-[45%] h-[45%] bg-gradient-to-tr from-cyan-400 to-blue-600 rounded-full glow-blob -z-10"></div>

    <!-- Top Navigation Header -->
    <header class="fixed top-5 left-1/2 transform -translate-x-1/2 z-50 w-[92%] max-w-6xl bg-white/70 dark:bg-zinc-900/70 backdrop-blur-xl border border-slate-200/80 dark:border-zinc-800/80 rounded-2xl px-6 py-3 shadow-lg shadow-slate-100/50 dark:shadow-none flex items-center justify-between transition-all duration-300">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center shadow-md shadow-blue-500/20">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <div class="flex flex-col">
                <span class="font-display font-extrabold text-lg tracking-tight leading-none bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-zinc-300 bg-clip-text text-transparent">NetPulse</span>
                <span class="text-[9px] font-bold text-blue-600 dark:text-blue-400 tracking-widest uppercase">NOC LITE SYSTEM</span>
            </div>
        </div>

        <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600 dark:text-zinc-300">
            <a href="#features" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Características</a>
            <a href="#mockup" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Visualizador</a>
            <a href="#stats" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Métricas</a>
        </nav>

        <div class="flex items-center gap-3">
            <!-- Theme Toggle -->
            <button id="theme-toggle" type="button" class="text-slate-500 dark:text-zinc-400 hover:bg-slate-100 dark:hover:bg-zinc-800 focus:outline-none rounded-xl text-sm p-2 transition-colors" aria-label="Toggle dark mode">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>

            @if (Route::has('login'))
                <div class="flex items-center gap-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white font-semibold text-xs rounded-xl tracking-wider uppercase transition-all shadow-md shadow-blue-500/20" id="nav-dashboard">
                            <span>Panel</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-zinc-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 transition-colors" id="nav-login">
                            Ingresar
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 dark:bg-zinc-800 hover:bg-slate-800 dark:hover:bg-zinc-700 active:scale-95 text-xs font-bold tracking-wider uppercase text-white rounded-xl transition-all shadow-sm" id="nav-register">
                                Registro
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-grow flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 pt-32 pb-20 relative">
        <!-- Dot Grid overlay -->
        <div class="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] dark:bg-[radial-gradient(#3f3f46_1px,transparent_1px)] [background-size:16px_16px] opacity-30 -z-20"></div>

        <div class="max-w-4xl mx-auto text-center mt-6">
            <!-- Pulsing Badge -->
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-[10px] font-bold uppercase tracking-widest mb-8 border border-blue-100/80 dark:border-blue-900/50 shadow-sm">
                <span class="flex w-2 h-2 rounded-full bg-blue-600 dark:bg-blue-400 animate-pulse"></span>
                <span>NOC LITE INTEGRADO • 100% OPERATIVO</span>
            </div>

            <!-- Main Heading -->
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-8 leading-[1.1] font-display">
                Gestión Autónoma de <br class="hidden sm:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-500 to-cyan-400 dark:from-blue-400 dark:via-indigo-400 dark:to-cyan-300">
                    Infraestructura NOC
                </span>
            </h1>

            <!-- Subtitle Description -->
            <p class="text-base sm:text-lg text-slate-600 dark:text-zinc-400 mb-10 max-w-2xl mx-auto leading-relaxed">
                Controla tickets de soporte, gestiona equipos de telecomunicaciones y automatiza el envío real de bitácoras en PDF vía <b>Gmail SMTP</b> y notificaciones <b>Twilio WhatsApp</b>. La suite de nivel empresarial definitiva.
            </p>

            <!-- Action CTA Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-20">
                @auth
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-8 py-4 bg-blue-600 hover:bg-blue-700 active:scale-98 text-white font-bold rounded-2xl transition-all shadow-lg shadow-blue-500/25 border border-blue-500/10" id="hero-cta-dashboard">
                        <span>Ingresar al Panel Administrativo</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-8 py-4 bg-blue-600 hover:bg-blue-700 active:scale-98 text-white font-bold rounded-2xl transition-all shadow-lg shadow-blue-500/25 border border-blue-500/10" id="hero-cta-login">
                        <span>Acceso para Ingenieros</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-8 py-4 bg-white dark:bg-zinc-900 hover:bg-slate-50 dark:hover:bg-zinc-800 text-slate-800 dark:text-white font-bold rounded-2xl transition-all border border-slate-200 dark:border-zinc-800 shadow-sm" id="hero-cta-register">
                            <span>Registrar Nueva Cuenta</span>
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Dashboard Preview Glassmorphism Mockup -->
        <section id="mockup" class="w-full max-w-5xl mx-auto px-2 sm:px-6 mb-24">
            <div class="relative rounded-2xl border border-slate-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 shadow-2xl p-2 sm:p-4 transition-all duration-300">
                <!-- Browser top bar -->
                <div class="flex items-center justify-between pb-3 sm:pb-4 border-b border-slate-100 dark:border-zinc-800/80 px-2">
                    <div class="flex gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-red-400"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                        <span class="w-3 h-3 rounded-full bg-green-400"></span>
                    </div>
                    <div class="text-[10px] sm:text-xs bg-slate-100 dark:bg-zinc-800/60 text-slate-500 dark:text-zinc-400 px-8 py-1 rounded-lg font-mono">
                        netpulse.test/work-orders
                    </div>
                    <div class="w-8"></div>
                </div>

                <!-- Mock Dashboard content -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 pt-4 text-left">
                    <!-- Left Mini menu -->
                    <div class="hidden md:block md:col-span-1 border-r border-slate-100 dark:border-zinc-800/50 pr-4 space-y-2">
                        <div class="p-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 font-bold rounded-xl text-xs flex items-center gap-2">
                            <span class="w-2.5 h-2.5 bg-blue-600 rounded-sm"></span>
                            Dashboard
                        </div>
                        <div class="p-2 text-slate-500 dark:text-zinc-400 font-medium rounded-xl text-xs flex items-center gap-2 hover:bg-slate-50 dark:hover:bg-zinc-800/30 transition-colors">
                            <span class="w-2.5 h-2.5 bg-slate-300 dark:bg-zinc-700 rounded-sm"></span>
                            Órdenes de Trabajo
                        </div>
                        <div class="p-2 text-slate-500 dark:text-zinc-400 font-medium rounded-xl text-xs flex items-center gap-2 hover:bg-slate-50 dark:hover:bg-zinc-800/30 transition-colors">
                            <span class="w-2.5 h-2.5 bg-slate-300 dark:bg-zinc-700 rounded-sm"></span>
                            Clientes
                        </div>
                        <div class="p-2 text-slate-500 dark:text-zinc-400 font-medium rounded-xl text-xs flex items-center gap-2 hover:bg-slate-50 dark:hover:bg-zinc-800/30 transition-colors">
                            <span class="w-2.5 h-2.5 bg-slate-300 dark:bg-zinc-700 rounded-sm"></span>
                            Equipos de Red
                        </div>
                    </div>

                    <!-- Right Main panel -->
                    <div class="col-span-1 md:col-span-3 space-y-4 px-2 sm:px-4">
                        <div class="flex items-center justify-between">
                            <h2 class="font-display font-bold text-lg text-slate-900 dark:text-white">Órdenes de Trabajo Recientes</h2>
                            <span class="px-2.5 py-0.5 rounded-full bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-[10px] text-green-700 dark:text-green-400 font-bold">NOC Online</span>
                        </div>

                        <!-- Table -->
                        <div class="overflow-hidden rounded-xl border border-slate-100 dark:border-zinc-800/80">
                            <table class="w-full text-left text-xs">
                                <thead class="bg-slate-50 dark:bg-zinc-800/40 text-slate-600 dark:text-zinc-400 font-semibold border-b border-slate-100 dark:border-zinc-800">
                                    <tr>
                                        <th class="p-3">Cliente</th>
                                        <th class="p-3">Equipo</th>
                                        <th class="p-3">Estado</th>
                                        <th class="p-3 text-right">Notificación</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-zinc-800/50">
                                    <tr>
                                        <td class="p-3 font-semibold text-slate-800 dark:text-zinc-200">Tech Solutions SA</td>
                                        <td class="p-3 text-slate-500">MikroTik Switch</td>
                                        <td class="p-3">
                                            <span class="px-2 py-0.5 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-[10px] font-bold">COMPLETADO</span>
                                        </td>
                                        <td class="p-3 text-right">
                                            <span class="inline-flex items-center gap-1 text-blue-600 dark:text-blue-400 font-bold text-[10px]">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                                PDF Enviado
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 font-semibold text-slate-800 dark:text-zinc-200">RACA Electromecánicas</td>
                                        <td class="p-3 text-slate-500">Huawei GPON OLT</td>
                                        <td class="p-3">
                                            <span class="px-2 py-0.5 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 text-[10px] font-bold">EN SITIO</span>
                                        </td>
                                        <td class="p-3 text-right">
                                            <span class="inline-flex items-center gap-1 text-green-600 dark:text-green-400 font-bold text-[10px]">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                WhatsApp OK
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 font-semibold text-slate-800 dark:text-zinc-200">Corporativo ACME</td>
                                        <td class="p-3 text-slate-500">Cisco ISR Router</td>
                                        <td class="p-3">
                                            <div class="flex items-center gap-1.5">
                                                <span class="px-2 py-0.5 rounded-full bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-[10px] font-bold">CANCELADO</span>
                                                <!-- Red Tooltip Trigger Simulated -->
                                                <span class="w-3.5 h-3.5 rounded-full bg-red-500/10 text-red-500 flex items-center justify-center font-bold text-[9px] cursor-help" title="Soporte denegado por falta de acceso físico al rack.">!</span>
                                            </div>
                                        </td>
                                        <td class="p-3 text-right">
                                            <span class="text-slate-400 text-[9px]">SLA Alert</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section Grid -->
        <section id="features" class="w-full max-w-6xl mx-auto px-4 mb-24 relative">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white font-display mb-4">Arquitectura Modular NOC Lite</h2>
                <p class="text-slate-600 dark:text-zinc-400 max-w-xl mx-auto">Una solución de ingeniería diseñada de extremo a extremo para optimizar tiempos de respuesta y documentar incidentes.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Feature 1: Twilio WhatsApp -->
                <div class="group relative bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800/80 rounded-2xl p-6 shadow-sm hover:shadow-xl dark:hover:shadow-zinc-900/30 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-green-500/10 text-green-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
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
        <section id="stats" class="w-full max-w-5xl mx-auto px-4 mb-12">
            <div class="rounded-3xl bg-slate-900 dark:bg-zinc-900 border border-slate-800 dark:border-zinc-800 p-8 sm:p-12 relative overflow-hidden shadow-2xl">
                <!-- Grid background inside stats -->
                <div class="absolute inset-0 bg-[radial-gradient(#1e293b_1px,transparent_1px)] dark:bg-[radial-gradient(#27272a_1px,transparent_1px)] [background-size:24px_24px] opacity-40"></div>

                <div class="relative grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                    <div class="space-y-1">
                        <h4 class="text-3xl sm:text-4xl font-extrabold text-white font-display">99.98%</h4>
                        <p class="text-xs text-slate-400 dark:text-zinc-400 font-bold uppercase tracking-wider">Uptime del SLA</p>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-3xl sm:text-4xl font-extrabold text-blue-400 font-display">&lt; 15 min</h4>
                        <p class="text-xs text-slate-400 dark:text-zinc-400 font-bold uppercase tracking-wider">Despacho de Alertas</p>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-3xl sm:text-4xl font-extrabold text-indigo-400 font-display">48 Horas</h4>
                        <p class="text-xs text-slate-400 dark:text-zinc-400 font-bold uppercase tracking-wider">SLA Automatizado</p>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-3xl sm:text-4xl font-extrabold text-cyan-400 font-display">100%</h4>
                        <p class="text-xs text-slate-400 dark:text-zinc-400 font-bold uppercase tracking-wider">Encriptado Web</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="w-full py-10 bg-white dark:bg-zinc-950 border-t border-slate-200/80 dark:border-zinc-900 text-center text-xs text-slate-500 dark:text-zinc-500 mt-auto transition-colors">
        <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="font-display font-bold text-slate-700 dark:text-zinc-300">NetPulse Telecom</span>
                <span class="text-slate-300 dark:text-zinc-800">|</span>
                <span>Sistema NOC Lite Administrativo</span>
            </div>
            <p>&copy; {{ date('Y') }} NetPulse. Desarrollado con Laravel 11, Livewire & Twilio API.</p>
        </div>
    </footer>

    <!-- Theme toggle logic -->
    <script>
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
    </script>
</body>
</html>
