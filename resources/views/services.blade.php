<!DOCTYPE html>
<html lang="en" class="h-full bg-zinc-950 text-zinc-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwartWorks 3D Printing Services</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Hide scrollbars for a clean app feel while retaining functionality */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="antialiased select-none bg-zinc-950 min-h-screen flex flex-col justify-between" x-data="{ quoteOpen: false }">

    <!-- Site Header -->
    @include('components.siteheader')

    <!-- App Shell Wrapper -->
    <div class="flex flex-col w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col items-center justify-center">

            <!-- Section Header -->
            <div class="px-4 flex-col flex items-center mb-12">
                <h1 class="text-6xl font-bold tracking-tight leading-20 text-center mb-2 bg-gradient-to-r from-zinc-400 to-zinc-700 bg-clip-text text-transparent">SwartWorks Services</h1>
                <p class="text-lg text-zinc-400 max-w-280 mt-1 text-center">We turn your designs into high-quality FDM 3D printed parts — from prototypes to short production runs. Get expert consultation and a wide choice of materials including PLA, PETG, ABS, nylon and engineering polymers. <span class="text-emerald-500">Standard Jobs: (3–7 working days)</span></p>
            </div>

            <!-- 2x2 Bespoke Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl w-full px-4 mb-8">

                <!-- Card 1 -->
                <div class="bg-zinc-900/80 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-3xl p-6 flex flex-col sm:flex-row items-center gap-6 shadow-xl transition-all duration-300 hover:scale-[1.01] group">
                    <div class="w-full sm:w-48 h-40 rounded-2xl overflow-hidden bg-zinc-950 flex-none relative">
                        <img src="{{ asset('images/1.webp') }}" alt="Dual Extrusion Technology" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="flex flex-col justify-between h-full">
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-emerald-400 transition-colors">Dual-Extrusion Precision</h3>
                            <p class="text-zinc-400 text-sm leading-relaxed">Multi-material printing allows complex geometries, soluble support structures, and combined rigid-flexible parts in a single automated process.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-zinc-900/80 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-3xl p-6 flex flex-col sm:flex-row items-center gap-6 shadow-xl transition-all duration-300 hover:scale-[1.01] group">
                    <div class="w-full sm:w-48 h-40 rounded-2xl overflow-hidden bg-zinc-950 flex-none relative">
                        <img src="{{ asset('images/5.webp') }}" alt="Engineering Materials" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="flex flex-col justify-between h-full">
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-emerald-400 transition-colors">Engineering Grade Polymers</h3>
                            <p class="text-zinc-400 text-sm leading-relaxed">We print structural parts using high-performance engineering plastics including Nylon Carbon Fiber (PA-CF), Polycarbonate, and flexible TPU.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-zinc-900/80 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-3xl p-6 flex flex-col sm:flex-row items-center gap-6 shadow-xl transition-all duration-300 hover:scale-[1.01] group">
                    <div class="w-full sm:w-48 h-40 rounded-2xl overflow-hidden bg-zinc-950 flex-none relative">
                        <img src="{{ asset('images/3.webp') }}" alt="Production Rigor" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="flex flex-col justify-between h-full">
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-emerald-400 transition-colors">Custom Material Choices</h3>
                            <p class="text-zinc-400 text-sm leading-relaxed">We offer a wide selection of filaments, including durable and flexible options to suit your specific application requirements — such as PLA, PETG, ABS, nylon and engineering polymers.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 4 (Custom 3D Designs + Contact Button) -->
                <div class="bg-zinc-900/80 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-3xl p-6 flex flex-col sm:flex-row items-center gap-6 shadow-xl transition-all duration-300 hover:scale-[1.01] group">
                    <div class="w-full sm:w-48 h-40 rounded-2xl overflow-hidden bg-zinc-950 flex-none relative">
                        <img src="{{ asset('images/2.webp') }}" alt="Custom 3D Designs" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="flex flex-col justify-between h-full w-full">
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-emerald-400 transition-colors">Custom 3D designs</h3>
                            <p class="text-zinc-400 text-sm leading-relaxed mb-4">Have an idea or need assistance preparing a model for production? Send us your brief and specs, and we’ll turn your concept into reality.</p>
                        </div>
                        <button
                            @click="quoteOpen = true"
                            class="w-full sm:w-auto self-start text-xs font-semibold bg-zinc-800 hover:bg-emerald-500 hover:text-zinc-950 border border-zinc-700 hover:border-emerald-400 text-zinc-100 px-4 py-2.5 rounded-full transition-all duration-200 shadow-md active:scale-95 cursor-pointer flex items-center justify-center gap-2">
                            <span>Get a Quote</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <!-- Site Footer -->
    @include('components.sitefooter')

    <!-- Get A Quote Modal Container -->
    @include('components.quoteformmodal')

</body>
</html>
