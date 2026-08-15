<footer class="bg-zinc-950 border-t border-zinc-800/80 text-zinc-400 text-sm flex-none">
    <div class="max-w-7xl mx-auto px-6 md:px-10 py-12 md:py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 md:gap-8">

            <!-- Column 1: Brand & Bio -->
            <div class="md:col-span-1 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-zinc-600 rounded-xl flex items-center justify-center font-black text-xl text-white shadow-lg shadow-zinc-500/30">
                        <img src="{{ asset('images/logo-icon.svg') }}" alt="Icon" class="w-6 h-6 object-contain">
                    </div>
                    <span class="font-bold text-lg tracking-wide text-white">SwartWorks</span>
                </div>
                <p class="text-zinc-400 text-xs leading-relaxed">
                    Precision 3D printing and rapid prototyping services. Quality custom parts delivered with fast turnaround.
                </p>
            </div>

            <!-- Column 2: Navigation Links -->
            <div class="space-y-3">
                <h3 class="text-white font-semibold text-xs uppercase tracking-wider">Navigation</h3>
                <ul class="space-y-2 text-xs">
                    <li>
                        <a href="{{ route('welcome') }}"
                           @class([
                               'transition-colors hover:text-white',
                               'text-emerald-400 font-medium' => request()->routeIs('welcome'),
                           ])>
                           Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}"
                           @class([
                               'transition-colors hover:text-white',
                               'text-emerald-400 font-medium' => request()->routeIs('services'),
                           ])>
                           Our Services
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Services -->
            <div class="space-y-3">
                <h3 class="text-white font-semibold text-xs uppercase tracking-wider">Services</h3>
                <ul class="space-y-2 text-xs text-zinc-400">
                    <li>Functional Prototypes</li>
                    <li>Jigs and Manufacturing Aids</li>
                    <li>Low-Volume Production</li>
                    <li>Gifts and Marketing</li>
                </ul>
            </div>

            <!-- Column 4: Quick Action & Region -->
            <div class="space-y-4">
                <h3 class="text-white font-semibold text-xs uppercase tracking-wider">Get Started</h3>
                <p class="text-xs text-zinc-400 leading-relaxed">
                    Ready to bring your CAD designs to life? Get an estimation today.
                </p>
                <div class="flex items-center gap-3 pt-1">
                    <button
                        @click="quoteOpen = true"
                        class="text-xs font-semibold bg-zinc-800 hover:bg-zinc-700 border border-zinc-500 text-white px-4 py-2 rounded-full transition-all duration-200 shadow-md hover:shadow-indigo-500/20 active:scale-95 cursor-pointer">
                        Get a Quote
                    </button>
                    <img src="{{ asset('images/uk-flag.svg') }}" alt="UK Flag" class="w-6 h-auto block opacity-80" title="United Kingdom">
                </div>
            </div>

        </div>

        <!-- Bottom Bar: Copyright & Scroll to Top -->
        <div class="mt-12 pt-8 border-t border-zinc-900 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-zinc-400">
            <p>&copy; {{ date('Y') }} SwartWorks. All rights reserved.</p>

            <button
                @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="hover:text-white transition-colors flex items-center gap-1.5 cursor-pointer">
                <span>Back to top</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
            </button>
        </div>
    </div>
</footer>
