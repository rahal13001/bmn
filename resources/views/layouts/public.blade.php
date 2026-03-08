<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BMN | @yield('title', 'Manajemen Aset Negara')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Essential background animations from Landing Page */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 20s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')

    @stack('styles')
</head>

<body class="antialiased min-h-screen bg-slate-100 relative selection:bg-teal-500 selection:text-white font-sans text-slate-900 overflow-x-hidden" x-data="{ pageLoaded: false }" x-init="setTimeout(() => pageLoaded = true, 50)">

    <!-- Dynamic Background -->
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-[40%] -left-[20%] w-[80%] h-[80%] rounded-full bg-teal-100/50 blur-[120px] mix-blend-multiply opacity-70 animate-blob"></div>
        <div class="absolute top-[20%] -right-[20%] w-[60%] h-[60%] rounded-full bg-blue-100/50 blur-[100px] mix-blend-multiply opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-[20%] left-[20%] w-[70%] h-[70%] rounded-full bg-indigo-100/40 blur-[100px] mix-blend-multiply opacity-70 animate-blob animation-delay-4000"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMTQ4LCAxNjMsIDE4NCwgMC4xKSIvPjwvc3ZnPg==')] opacity-60"></div>
    </div>

    <!-- Header Section -->
    <div class="bg-white/80 backdrop-blur-md border-b border-white/50 relative z-20 shadow-sm"
         x-show="pageLoaded" 
         x-transition:enter="transition-all ease-out duration-700"
         x-transition:enter-start="-translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100">
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-6 flex flex-col md:flex-row items-center gap-4 md:gap-6 justify-center text-center md:text-left">
                <!-- Logo -->
                <div class="shrink-0 transition-all duration-500 hover:scale-110 shadow-sm rounded-xl bg-white border border-slate-100 p-2 group">
                    <img src="{{ asset('img/logokkp.jpg') }}" alt="Logo KKP" class="h-16 md:h-20 w-auto object-contain transition-transform duration-500 group-hover:scale-105">
                </div>
                
                <!-- Title -->
                <div class="flex-1 flex justify-between items-center w-full">
                    <div>
                        <h1 class="text-xl md:text-2xl font-extrabold text-slate-800 tracking-tight leading-tight">
                            <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-700 to-blue-800">Loka Penataan Ruang Laut</span>
                        </h1>
                        <div class="mt-1 text-slate-500 font-medium text-sm">
                            Sistem Informasi Manajemen BMN
                        </div>
                    </div>
                    
                    @auth
                        <div class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-teal-50 text-teal-700 text-xs font-bold border border-teal-200">
                            <i class="ph ph-user-circle text-lg"></i> Admin Aktif
                        </div>
                    @endauth
                </div>
                
                @auth
                    <div class="sm:hidden inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-teal-50 text-teal-700 text-xs font-bold border border-teal-200 mt-2">
                        <i class="ph ph-user-circle text-lg"></i> Admin Aktif
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="py-8 relative z-10"
          x-show="pageLoaded" 
          x-transition:enter="transition-all ease-out duration-1000 delay-300"
          x-transition:enter-start="opacity-0 translate-y-8"
          x-transition:enter-end="opacity-100 translate-y-0">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="relative z-10 pb-8 text-center"
            x-show="pageLoaded" 
            x-transition:enter="transition-all ease-out duration-1000 delay-500"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100">
        <p class="text-sm font-medium text-slate-500 drop-shadow-sm">
            &copy; {{ date('Y') }} Loka Penataan Ruang Laut Sorong
        </p>
    </footer>

    @filamentScripts
    @vite('resources/js/app.js')
</body>
</html>