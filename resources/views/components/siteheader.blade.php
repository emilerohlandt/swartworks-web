<div class="sticky top-0 z-30 bg-zinc-950/90 backdrop-blur-md">
<header x-data="{ mobileMenuOpen: false }" class="relative bg-zinc-950 h-20 px-6 md:px-10 flex-none flex items-center justify-between border-b border-zinc-800/80 z-20">
    <!-- Logo (Left Edge) -->
    <a href="{{ route('welcome') }}" class="flex items-center gap-3" title="Home">
        <div class="h-10 w-10 bg-zinc-600 rounded-xl flex items-center justify-center font-black text-xl text-white shadow-lg shadow-zinc-500/30">
            <img src="{{ asset('images/logo-icon.svg') }}" alt="Icon" class="w-6 h-6 object-contain">
        </div>
        <span class="font-extrabold text-2xl tracking-normal text-white">SwartWorks</span>
    </a>

    <!-- Desktop Navigation Links (Hidden on Mobile) -->
    <nav class="hidden md:flex items-center gap-8">
        <div class="flex items-center gap-6">
            <a href="{{ route('welcome') }}"
               @class([
                   'text-sm transition-colors',
                   'text-stone-300 font-semibold' => request()->routeIs('welcome'),
                   'text-zinc-400 hover:text-white' => !request()->routeIs('welcome'),
               ])>
               Welcome
            </a>

            <a href="{{ route('about') }}"
               @class([
                   'text-sm transition-colors',
                   'text-white font-semibold' => request()->routeIs('about'),
                   'text-zinc-400 hover:text-white' => !request()->routeIs('about'),
               ])>
               About
            </a>

            <img src="{{ asset('images/uk-flag.svg') }}" alt="Icon" class="w-7 h-auto block">
        </div>

        <button
            @click="quoteOpen = true"
            class="text-sm font-bold bg-zinc-800 hover:bg-zinc-700 border border-indigo-500 text-white px-5 py-2.5 rounded-full transition-all duration-200 shadow-md hover:shadow-indigo-500/20 active:scale-95 cursor-pointer whitespace-nowrap">
            Get a Quote
        </button>
    </nav>

    <!-- Mobile Hamburger Toggle Button (Shown on Mobile only) -->
    <button
        @click="mobileMenuOpen = !mobileMenuOpen"
        type="button"
        class="md:hidden p-2 rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800/60 focus:outline-none"
        aria-label="Toggle menu">
        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <!-- Mobile Dropdown Menu -->
    <div
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        @click.away="mobileMenuOpen = false"
        x-cloak
        class="absolute top-full left-0 w-full bg-zinc-950 border-b border-zinc-800/80 p-6 md:hidden flex flex-col gap-4 shadow-2xl">

        <a href="{{ route('welcome') }}"
           @class([
               'text-base py-2 transition-colors',
               'text-emerald-400 font-semibold' => request()->routeIs('welcome'),
               'text-zinc-400 hover:text-white' => !request()->routeIs('welcome'),
           ])>
           Welcome
        </a>

        <a href="{{ route('about') }}"
           @class([
               'text-base py-2 transition-colors',
               'text-emerald-400 font-semibold' => request()->routeIs('about'),
               'text-zinc-400 hover:text-white' => !request()->routeIs('about'),
           ])>
           About
        </a>

        <div class="flex items-center justify-between pt-4 border-t border-zinc-800/80">
            <img src="{{ asset('images/uk-flag.svg') }}" alt="Icon" class="w-7 h-auto block">
            <button
                @click="mobileMenuOpen = false; quoteOpen = true"
                class="w-full ml-4 text-sm font-semibold bg-zinc-800 hover:bg-zinc-700 border border-zinc-500 text-white px-5 py-2.5 rounded-full transition-all duration-200 text-center cursor-pointer">
                Get a Quote
            </button>
        </div>
    </div>
</header>
</div>
