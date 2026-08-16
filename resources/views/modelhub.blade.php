<!DOCTYPE html>
<html lang="en" class="h-full bg-zinc-950 text-zinc-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Model Hub | SwartWorks</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
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
                <h1 class="text-5xl sm:text-6xl font-bold tracking-tight text-center mb-2 bg-gradient-to-r from-zinc-200 via-zinc-400 to-zinc-600 bg-clip-text text-transparent">3D Model Hub</h1>
                <p class="text-lg text-zinc-400 max-w-2xl mt-1 text-center">Browse our recommended platforms to discover STL files, CAD models, and high-quality 3D assets for your next print project.</p>
            </div>

            <!-- 3-Column Resource Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl w-full px-4 mb-12">
                @foreach($repositories as $repo)
                    @php
                        // Dynamic badge styling fallback if not stored in DB
                        $isFree = Str::contains(strtolower($repo->type), 'free');
                        $badgeColor = $repo->badge_color ?? ($isFree
                            ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30'
                            : 'bg-amber-500/10 text-amber-400 border-amber-500/30');
                    @endphp

                    <div class="bg-zinc-900/80 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-3xl p-6 flex flex-col justify-between shadow-xl transition-all duration-300 hover:scale-[1.01] group">

                        <div>
                          <!-- Top Image & Badge Header -->
<div class="w-full h-40 rounded-2xl overflow-hidden bg-zinc-950 flex-none relative mb-5 flex items-center justify-center p-6">
  <img src="{{ $repo->logo_path ? Storage::url($repo->logo_path) : ($repo->image ? asset($repo->image) : asset('images/1.webp')) }}"
       alt="{{ $repo->name }}"
       class="max-w-full max-h-full object-contain px-8 group-hover:scale-105 transition-transform duration-500">

  <span class="absolute top-3 left-3 text-[11px] font-semibold px-3 py-1 rounded-full border backdrop-blur-md bg-zinc-950/80 {{ $badgeColor }}">
      {{ $repo->type }}
  </span>
</div>

                            <!-- Name & Description -->
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-emerald-400 transition-colors">
                                {{ $repo->name }}
                            </h3>
                            <p class="text-zinc-400 text-sm leading-relaxed mb-6">
                                {{ $repo->description }}
                            </p>
                        </div>

                        <!-- External Link Button -->
                        <a href="{{ $repo->url }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="w-full text-xs font-semibold bg-zinc-800 hover:bg-emerald-500 hover:text-zinc-950 border border-zinc-700 hover:border-emerald-400 text-zinc-100 px-4 py-3 rounded-full transition-all duration-200 shadow-md active:scale-95 cursor-pointer flex items-center justify-center gap-2">
                            <span>Visit Website</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>

                    </div>
                @endforeach
            </div>

            <!-- Custom Model Request CTA -->
            <div class="max-w-7xl w-full px-4 mb-8">
                <div class="bg-zinc-900/40 border border-zinc-800/80 rounded-3xl p-8 flex flex-col sm:flex-row items-center justify-between gap-6 text-center sm:text-left">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-1">Can't find the exact model you need?</h2>
                        <p class="text-zinc-400 text-sm">Send us your brief, technical drawings, or reference photos and we'll model and print it for you.</p>
                    </div>
                    <button @click="quoteOpen = true" class="text-xs font-semibold bg-emerald-500 hover:bg-emerald-400 text-zinc-950 px-6 py-3 rounded-full transition-all duration-200 shadow-lg active:scale-95 cursor-pointer whitespace-nowrap">
                        Request Custom Design
                    </button>
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
