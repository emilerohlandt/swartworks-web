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

                <!-- Card 0 -->
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

                <!-- Card 1 -->
                <div class="flex-none w-[85vw] sm:w-[480px] h-[540px] bg-zinc-900/80 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-3xl p-6 flex flex-col justify-between shadow-xl relative overflow-hidden group
                    transition-all duration-500 ease-out
                    group-hover/cards:brightness-75 group-hover/cards:opacity-40 group-hover/cards:scale-[0.98]
                    hover:!brightness-100 hover:!opacity-100 hover:!scale-[1.0] hover:z-10 hover:shadow-2xl">
                    <div class="relative h-48 sm:h-46 rounded-2xl overflow-hidden bg-zinc-950 mb-4 flex-none pointer-events-none">
                        <img src="{{ asset('images/8.webp') }}" alt="FDM Printing" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-zinc-950/80 backdrop-blur-md text-amber-400 text-xs font-semibold px-3 py-1 rounded-full border border-zinc-800">Standard &amp; Tough</span>
                    </div>
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-white mb-2">Functional Prototypes</h2>
                            <p class="text-zinc-400 text-md leading-normal mb-4">High-quality prototypes produced to your exact specifications. Perfect for fit, form, and functional testing during product development.</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 block mb-2">Available Materials</span>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">PETG</span>
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">ABS</span>
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">TPU (Flex)</span>
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">PA-CF (Nylon Carbon)</span>
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">Polycarbonate</span>
                            </div>
                        </div>
                        <button
                            @click="quoteOpen = true"
                            class="w-full text-sm mt-4 font-semibold bg-zinc-800 hover:bg-zinc-950 border border-zinc-600 hover:border-emerald-500 text-white px-5 py-3 rounded-full transition-all duration-200 shadow-md hover:shadow-emerald-500/20 active:scale-95 cursor-pointer">
                            Get a Quote
                        </button>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="flex-none w-[85vw] sm:w-[480px] h-[540px] bg-zinc-900/80 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-3xl p-6 flex flex-col justify-between shadow-xl relative overflow-hidden group
                    transition-all duration-500 ease-out
                    group-hover/cards:brightness-75 group-hover/cards:opacity-40 group-hover/cards:scale-[0.98]
                    hover:!brightness-100 hover:!opacity-100 hover:!scale-[1.0] hover:z-10 hover:shadow-2xl">
                    <div class="relative h-48 sm:h-46 rounded-2xl overflow-hidden bg-zinc-950 mb-4 flex-none pointer-events-none">
                        <img src="{{ asset('images/5.webp') }}" alt="FDM Printing" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-zinc-950/80 backdrop-blur-md text-amber-400 text-xs font-semibold px-3 py-1 rounded-full border border-zinc-800">Ultra High Detail</span>
                    </div>
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-white mb-2">Jigs, Fixtures and Manufacturing Aids</h2>
                            <p class="text-zinc-400 text-md leading-normal mb-4">Custom 3D printed tooling to support assembly, inspection, and production processes. Ideal for engineering environments.</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 block mb-2">Available Materials</span>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">Standard Resin</span>
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">Tough/ABS-Like</span>
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">Flexible Resin</span>
                            </div>
                        </div>
                        <button
                            @click="quoteOpen = true"
                            class="w-full text-sm mt-4 font-semibold bg-zinc-800 hover:bg-zinc-950 border border-zinc-600 hover:border-emerald-400 text-white px-5 py-3 rounded-full transition-all duration-200 shadow-md hover:shadow-emerald-500/20 active:scale-95 cursor-pointer">
                            Get a Quote
                        </button>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="flex-none w-[85vw] sm:w-[480px] h-[540px] bg-zinc-900/80 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-3xl p-6 flex flex-col justify-between shadow-xl relative overflow-hidden group
                    transition-all duration-500 ease-out
                    group-hover/cards:brightness-75 group-hover/cards:opacity-40 group-hover/cards:scale-[0.98]
                    hover:!brightness-100 hover:!opacity-100 hover:!scale-[1.0] hover:z-10 hover:shadow-2xl">
                    <div class="relative h-48 sm:h-46 rounded-2xl overflow-hidden bg-zinc-950 mb-4 flex-none pointer-events-none">
                        <img src="{{ asset('images/3.webp') }}" alt="FDM Printing" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-zinc-950/80 backdrop-blur-md text-amber-400 text-xs font-semibold px-3 py-1 rounded-full border border-zinc-800">Fast Turnaround</span>
                    </div>
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-white mb-2">Replacement Parts and Low-Volume Production</h2>
                            <p class="text-zinc-400 text-md leading-normal mb-4">Fast and cost-effective production of replacement parts and short runs without the need for expensive tooling.</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 block mb-2">Available Materials</span>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">PA-CF (Nylon Carbon)</span>
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">Polycarbonate</span>
                            </div>
                        </div>
                        <button
                            @click="quoteOpen = true"
                            class="w-full text-sm mt-4 font-semibold bg-zinc-800 hover:bg-zinc-950 border border-zinc-600 hover:border-emerald-400 text-white px-5 py-3 rounded-full transition-all duration-200 shadow-md hover:shadow-emerald-500/20 active:scale-95 cursor-pointer">
                            Get a Quote
                        </button>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="flex-none w-[85vw] sm:w-[480px] h-[540px] bg-zinc-900/80 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-3xl p-6 flex flex-col justify-between shadow-xl relative overflow-hidden group
                    transition-all duration-500 ease-out
                    group-hover/cards:brightness-75 group-hover/cards:opacity-40 group-hover/cards:scale-[0.98]
                    hover:!brightness-100 hover:!opacity-100 hover:!scale-[1.0] hover:z-10 hover:shadow-2xl">
                    <div class="relative h-48 sm:h-46 rounded-2xl overflow-hidden bg-zinc-950 mb-4 flex-none pointer-events-none">
                        <img src="{{ asset('images/2.webp') }}" alt="FDM Printing" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-zinc-950/80 backdrop-blur-md text-amber-400 text-xs font-semibold px-3 py-1 rounded-full border border-zinc-800">Get Creative</span>
                    </div>
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-white mb-2">Custom Components for Design and Interiors</h2>
                            <p class="text-zinc-400 text-md leading-normal mb-4">Bespoke printed parts for interior designers, architects, and product designers with excellent finish quality.</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 block mb-2">Available Materials</span>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">PA-CF (Nylon Carbon)</span>
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">Polycarbonate</span>
                            </div>
                        </div>
                        <button
                            @click="quoteOpen = true"
                            class="w-full text-sm mt-4 font-semibold bg-zinc-800 hover:bg-zinc-950 border border-zinc-600 hover:border-emerald-400 text-white px-5 py-3 rounded-full transition-all duration-200 shadow-md hover:shadow-emerald-500/20 active:scale-95 cursor-pointer">
                            Get a Quote
                        </button>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="flex-none mr-12 w-[85vw] sm:w-[480px] h-[540px] bg-zinc-900/80 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-3xl p-6 flex flex-col justify-between shadow-xl relative overflow-hidden group
                    transition-all duration-500 ease-out
                    group-hover/cards:brightness-75 group-hover/cards:opacity-40 group-hover/cards:scale-[0.98]
                    hover:!brightness-100 hover:!opacity-100 hover:!scale-[1.0] hover:z-10 hover:shadow-2xl">
                    <div class="relative h-48 sm:h-46 rounded-2xl overflow-hidden bg-zinc-950 mb-4 flex-none pointer-events-none">
                        <img src="{{ asset('images/8.webp') }}" alt="FDM Printing" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-zinc-950/80 backdrop-blur-md text-amber-400 text-xs font-semibold px-3 py-1 rounded-full border border-zinc-800">Promotional</span>
                    </div>
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-white mb-2">Gifts and Marketing Prints</h2>
                            <p class="text-zinc-400 text-md leading-normal mb-4">Custom 3D printed promotional items, branded merchandise, and personalised gifts. Great for marketing campaigns and events.</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 block mb-2">Available Materials</span>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">PA-CF (Nylon Carbon)</span>
                                <span class="px-3 py-1 bg-zinc-800 border border-zinc-700/50 text-zinc-200 text-xs font-medium rounded-full">Polycarbonate</span>
                            </div>
                        </div>
                        <button
                            @click="quoteOpen = true"
                            class="w-full text-sm mt-4 font-semibold bg-zinc-800 hover:bg-zinc-950 border border-zinc-600 hover:border-emerald-400 text-white px-5 py-3 rounded-full transition-all duration-200 shadow-md hover:shadow-emerald-500/20 active:scale-95 cursor-pointer">
                            Get a Quote
                        </button>
                    </div>
                </div>

            </div>

            <!-- Indicator Dots -->
            <div class="flex justify-center items-center gap-2 mt-2">
                <template x-for="(card, index) in [0, 1, 2]" :key="index">
                    <button
                        type="button"
                        @click="scrollToIndex(index)"
                        class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                        :class="activeIndex === index ? 'w-8 bg-zinc-200' : 'w-2 bg-zinc-800 hover:bg-zinc-700'">
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
