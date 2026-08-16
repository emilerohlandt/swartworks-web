<!DOCTYPE html>
<html lang="en" class="bg-zinc-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Swartworks</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js for lightweight dropdown interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Override Chrome/Edge autofill background and text colors */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #18181b inset !important;
            -webkit-text-fill-color: #ffffff !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>
<body class="bg-zinc-900 text-zinc-100 antialiased min-h-screen flex">

    <!-- Sidebar Navigation -->
    <aside class="w-64 bg-zinc-950 border-r border-zinc-800 flex flex-col flex-shrink-0">
        <!-- Brand Logo / Title -->
        <div class="h-16 flex items-center px-6 border-b border-zinc-800">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-white tracking-tight hover:text-zinc-200 transition-colors">
                Swartworks
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-grow p-4 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-zinc-800 text-indigo-400 font-semibold' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.users.*') || request()->routeIs('users.*') ? 'bg-zinc-800 text-indigo-400 font-semibold' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                User Management
            </a>

            <a href="{{ route('admin.material-categories.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.material-categories.*') || request()->routeIs('material-categories.*') ? 'bg-zinc-800 text-indigo-400 font-semibold' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h10M7 17h10M3 7h.01M3 12h.01M3 17h.01"/></svg>
                Material Categories
            </a>

            <a href="{{ route('admin.materials.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.materials.*') || request()->routeIs('materials.*') ? 'bg-zinc-800 text-indigo-400 font-semibold' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Materials
            </a>

            <a href="{{ route('admin.services.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.services.*') || request()->routeIs('services.*') ? 'bg-zinc-800 text-indigo-400 font-semibold' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Services
            </a>

            <a href="{{ route('admin.model-hubs.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.model-hubs.*') || request()->routeIs('model-hubs.*') ? 'bg-zinc-800 text-indigo-400 font-semibold' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                Model Hub
            </a>
        </nav>
    </aside>

    <!-- Main Outer Wrapper -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Header -->
        <header class="h-16 bg-zinc-900 border-b border-zinc-800 px-8 flex justify-end items-center">

            <!-- User Dropdown Menu -->
            <div x-data="{ open: false }" @click.outside="open = false" class="relative">
                <button @click="open = !open"
                        type="button"
                        class="flex items-center gap-2 text-sm font-medium text-zinc-300 hover:text-white focus:outline-none py-2 transition-colors">
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4 text-zinc-400 transition-transform duration-150" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown Menu Content -->
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-zinc-800 border border-zinc-700/80 rounded-xl shadow-xl py-1 z-50 focus:outline-none"
                     style="display: none;">

                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-2 px-4 py-2 text-sm text-zinc-300 hover:bg-zinc-700/60 hover:text-white transition-colors">
                        <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        View Profile
                    </a>

                    <div class="border-t border-zinc-700/60 my-1"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-red-400 hover:bg-red-950/40 hover:text-red-300 transition-colors">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 p-8 max-w-7xl w-full mx-auto">
            @if (session('success'))
                <div class="mb-6 p-4 rounded-lg bg-emerald-950/60 border border-emerald-800/50 text-emerald-400 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 rounded-lg bg-red-950/60 border border-red-800/50 text-red-400 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
