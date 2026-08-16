<!DOCTYPE html>
<html lang="en" class="bg-zinc-950 text-zinc-100 min-h-full">
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
<body class="antialiased select-none bg-zinc-950 flex flex-col" x-data="{ quoteOpen: false }">

  <!-- Fixed/Sticky Header -->
  @include('components.siteheader')

    <!-- App Shell Wrapper (Sticky header + full min-height) -->
    <div class="flex flex-col w-full mx-auto px-0 sm:px-0 lg:px-0">

        <!-- Main Horizontal Scroll Content Area -->
        <main
            x-data="{
                isDown: false,
                startX: 0,
                scrollLeft: 0,
                activeIndex: 0,
                isSmooth: false,

                handleWheel(e) {
                    const slider = $refs.slider;
                    const delta = e.deltaY !== 0 ? e.deltaY : e.deltaX;
                    const maxScrollLeft = slider.scrollWidth - slider.clientWidth;

                    // Check boundaries (1px tolerance for sub-pixel browser rounding)
                    const isAtEnd = slider.scrollLeft >= maxScrollLeft - 1;
                    const isAtStart = slider.scrollLeft <= 1;

                    if (delta > 0 && !isAtEnd) {
                        e.preventDefault();
                        this.isSmooth = false;
                        slider.scrollLeft += delta * 1.2;
                    }
                    else if (delta < 0 && !isAtStart) {
                        e.preventDefault();
                        this.isSmooth = false;
                        slider.scrollLeft += delta * 1.2;
                    }
                },

                startDragging(e) {
                    this.isSmooth = true;
                    this.isDown = true;
                    this.startX = e.pageX - $refs.slider.offsetLeft;
                    this.scrollLeft = $refs.slider.scrollLeft;
                },
                stopDragging() {
                    this.isDown = false;
                },
                drag(e) {
                    if(!this.isDown) return;
                    e.preventDefault();
                    const x = e.pageX - $refs.slider.offsetLeft;
                    const walk = (x - this.startX) * 1.6;
                    $refs.slider.scrollLeft = this.scrollLeft - walk;
                },

                scrollToIndex(index) {
                    this.isSmooth = true;
                    const slider = $refs.slider;
                    const cardWidth = slider.children[0].offsetWidth + 32;
                    slider.scrollTo({ left: cardWidth * index, behavior: 'smooth' });
                },

                updateActiveIndex() {
                    const slider = $refs.slider;
                    const cardWidth = slider.children[0].offsetWidth + 32;
                    this.activeIndex = Math.max(0, Math.min(Math.round(slider.scrollLeft / cardWidth), slider.children.length - 1));
                }
            }"
            class="flex-1 flex flex-col justify-center gap-6 py-10 my-auto">

            <!-- Section Header -->
            <div class="px-10 flex-col flex items-center justify-between">
                <h1 class="text-6xl font-bold tracking-tight leading-20 text-center mb-2 bg-gradient-to-r from-zinc-400 to-zinc-700 bg-clip-text text-transparent">Precision 3D Printing Services</h1>
                <p class="text-lg text-zinc-400 max-w-280 mt-1 text-center">At SwartWorks, we provide high-quality custom 3D printing services using advanced dual-extrusion technology. We focus purely on printing — you supply the design, and we deliver accurate, reliable parts with fast turnaround. <span class="text-emerald-400">Standard Jobs: (3–7 working days)</span></p>
            </div>

            <!-- Horizontal Slider Container -->
            <div
                x-ref="slider"
                @wheel="handleWheel($event)"
                @mousedown="startDragging($event)"
                @mouseleave="stopDragging()"
                @mouseup="stopDragging()"
                @mousemove="drag($event)"
                @scroll.debounce.30ms="updateActiveIndex()"
                :class="{
                    'cursor-grabbing': isDown,
                    'cursor-grab': !isDown,
                    'scroll-smooth': isSmooth
                }"
                class="group/cards flex-1 flex items-center overflow-x-auto no-scrollbar gap-8 py-6 will-change-scroll">

                <!-- Card 0 (Static Intro) -->
                <div class="flex-none ml-12 w-[85vw] sm:w-[620px] h-[540px] bg-zinc-900/80 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-3xl p-6 flex flex-row justify-center justify-items-center gap-8 shadow-xl relative overflow-hidden group">
                    <div class="absolute z-1 top-0 left-0 opacity-0 w-full h-full bg-[url(/images/1.webp)] bg-cover pointer-events-none"></div>
                    <div class="relative p-12 z-2 flex-1 flex flex-col h-full items-center justify-center">
                        <div>
                            <div class="h-16 w-16 mb-6 bg-zinc-800 rounded-xl flex items-center justify-center font-black text-xl text-white">
                                <img src="{{ asset('images/logo-icon.svg') }}" alt="Icon" class="w-6 h-6 object-contain">
                            </div>
                            <h2 class="text-4xl font-extrabold text-white mb-4">How it works</h2>
                            <p class="text-zinc-400 text-3xl tracking-tight leading-tight mb-5">Simply send us your design file(s) and we’ll print and ship your parts.</p>
                            <p class="text-zinc-500 text-xl leading-relaxed">Pricing is calculated precisely by the gram of material used and includes machine time, electricity and all associated running costs — so you only pay for exactly what your part requires.</p>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Service Cards from Database -->
                @foreach($services as $index => $service)
                    <div class="flex-none {{ $loop->last ? 'mr-12' : '' }} w-[85vw] sm:w-[480px] h-[540px] bg-zinc-900/80 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-3xl p-6 flex flex-col justify-between shadow-xl relative overflow-hidden group
                        transition-all duration-500 ease-out
                        group-hover/cards:brightness-75 group-hover/cards:opacity-70 group-hover/cards:scale-[0.98]
                        hover:!brightness-100 hover:!opacity-100 hover:!scale-[1.0] hover:z-10 hover:shadow-2xl">

                        <!-- Service Image & Badge Header -->
                        <div class="relative h-48 sm:h-40 rounded-2xl overflow-hidden bg-zinc-950 mb-4 flex-none pointer-events-none">
                            <img src="{{ $service->image_path ? asset('storage/' . $service->image_path) : asset('images/8.webp') }}"
                                 alt="{{ $service->title ?? $service->name }}"
                                 class="w-full h-full object-cover">

                            @php
                                $badge = filled($service->callout_text) ? $service->callout_text : $service->badge_text;
                            @endphp

                            @if(filled($badge))
                                <span class="absolute top-3 left-3 z-10 bg-zinc-950/80 backdrop-blur-md text-amber-400 text-xs font-semibold px-3.5 py-1.5 rounded-full border border-zinc-600/80 shadow-md pointer-events-auto">
                                    {{ $badge }}
                                </span>
                            @endif
                        </div>

                        <!-- Service Content -->
                        <div class="flex-1 flex flex-col justify-between">
                            <div>
                                <h2 class="text-3xl font-bold text-white mb-2">{{ $service->title ?? $service->name }}</h2>
                                <p class="text-zinc-400 text-md leading-normal mb-4 line-clamp-3">{{ $service->description }}</p>
                            </div>

                            <!-- Assigned Materials -->
                            <div>
                                <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 block mb-2">Available Materials</span>
                                <div class="flex flex-wrap gap-2">
                                    @forelse($service->materials as $material)
                                        <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">
                                            {{ $material->name }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-zinc-600 italic">No specific materials assigned</span>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Quote Action Button -->
                            <button
                                @click="quoteOpen = true"
                                class="w-full text-sm mt-4 font-semibold bg-zinc-800 hover:bg-zinc-950 border border-zinc-600 hover:border-emerald-500 text-white px-5 py-3 rounded-full transition-all duration-200 shadow-md hover:shadow-emerald-500/20 active:scale-95 cursor-pointer">
                                Get a Quote
                            </button>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Dynamic Indicator Dots -->
            <div class="flex justify-center items-center gap-2 mt-2">
                <template x-for="(card, index) in Array.from($refs.slider?.children || []).length" :key="index">
                    <button
                        type="button"
                        @click="scrollToIndex(index - 1)"
                        class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                        :class="activeIndex === (index - 1) ? 'w-8 bg-zinc-200' : 'w-2 bg-zinc-800 hover:bg-zinc-700'">
                    </button>
                </template>
            </div>
        </main>
    </div>

    <!-- Site Footer -->
    @include('components.sitefooter')

    <!-- Get A Quote Modal Container -->
    @include('components.quoteformmodal')

</body>
</html>
