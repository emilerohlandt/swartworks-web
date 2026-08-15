<div
    x-show="quoteOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 backdrop-blur-none"
    x-transition:enter-end="opacity-100 backdrop-blur-none"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 backdrop-blur-md"
    x-transition:leave-end="opacity-0 backdrop-blur-none"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-zinc-950/80 backdrop-blur-md overflow-y-auto"
    style="display: none;">

    <!-- Modal Card -->
    <div
        @click.away="quoteOpen = false"
        x-show="quoteOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        x-data="{
            unit: 'mm',
            materialCat: 'PLA',
            materialType: 'Standard white material (UTR 8360)',
            color: 'Matte white',
            process: 'SLA'
        }"
        class="bg-zinc-900 border border-zinc-800 w-full max-w-6xl rounded-3xl p-6 sm:p-8 shadow-2xl relative my-auto max-h-[90vh] overflow-y-auto no-scrollbar">

        <button @click="quoteOpen = false" class="absolute top-6 right-6 text-zinc-400 hover:text-white transition-colors z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <!-- Step Header -->
        <div class="flex items-center gap-3 mb-6">
            <span class="flex items-center justify-center w-7 h-7 rounded-full bg-zinc-800 border border-zinc-700 text-xs font-bold text-emerald-400">1</span>
            <h2 class="text-xl font-bold text-white">Upload Design and configure parts to get a quote</h2>
        </div>

        <!-- Form Layout: Left Configuration & Right Summary Sidebar -->
        <form action="#" method="POST" @submit.prevent="alert('Quote submitted!'); quoteOpen = false;" class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Main Form Column -->
            <div class="lg:col-span-8 space-y-6">

                <!-- File Upload Dropzone -->
                <div class="border-2 border-dashed border-zinc-700 hover:border-emerald-500/50 rounded-2xl p-8 text-center bg-zinc-950/50 transition-colors cursor-pointer group">
                    <div class="w-12 h-12 mx-auto mb-3 bg-emerald-500/10 text-emerald-400 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    </div>
                    <p class="text-base font-semibold text-white mb-1">Drag and drop here or select files</p>
                    <p class="text-xs text-zinc-400 mb-2">File size &lt; 500 MB (3D CAD: <span class="text-zinc-300 font-mono">*.stl, *.obj, *.step, *.stp, *.3mf</span>)</p>
                    <p class="text-[11px] text-zinc-500">You can add up to 24 rows of files. To ensure efficiency, do NOT upload compressed ZIP folders.</p>
                    <p class="text-[11px] text-rose-400/90 mt-2 font-medium">Note: No broken holes in design documents. Wall thickness &gt; 1.2mm, thinnest part &ge; 0.8mm.</p>
                </div>

                <!-- Compliance / Policy Notice -->
                <div class="p-3 bg-zinc-950/80 border border-zinc-800/80 rounded-xl flex items-start gap-2.5 text-xs text-zinc-400">
                    <svg class="w-4 h-4 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p>
                        Uploading files for weapons, military items, or export-controlled items (ITAR, EAR, EU Dual-Use regulations) is strictly prohibited under our <a href="#" class="text-white hover:underline">Terms of Service</a>. Files are kept strictly confidential. You may <a href="#" class="text-white hover:underline">sign an NDA here</a>.
                    </p>
                </div>

                <!-- Part Configuration Inputs -->
                <div class="space-y-5 pt-2">

                    <!-- Contact Details Block -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pb-4 border-b border-zinc-800">
                        <div>
                            <label class="block text-xs font-medium text-zinc-300 mb-1.5"><span class="text-rose-500">*</span> Your Name</label>
                            <input type="text" required class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-indigo-500 transition-colors" placeholder="John Doe">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-zinc-300 mb-1.5"><span class="text-rose-500">*</span> Email Address</label>
                            <input type="email" required class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-indigo-500 transition-colors" placeholder="john@example.com">
                        </div>
                    </div>

                    <!-- Quantity & Design Units -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                        <div>
                            <label class="block text-xs font-medium text-zinc-300 mb-1.5"><span class="text-rose-500">*</span> Quantity:</label>
                            <input type="number" min="1" value="1" required class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-indigo-500 transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-zinc-300 mb-1.5"><span class="text-rose-500">*</span> Size:</label>
                            <input type="number" min="5" value="10" required class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-indigo-500 transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-zinc-300 mb-1.5">Design Units:</label>
                            <div class="inline-flex p-1 bg-zinc-950 border border-zinc-800 rounded-xl gap-1">
                                <template x-for="u in ['mm', 'inch', 'cm']">
                                    <button type="button" @click="unit = u" :class="unit === u ? 'bg-indigo-500/20 text-indigo-400 border-indigo-500/50' : 'text-zinc-400 hover:text-white border-transparent'" class="px-3 py-1 border rounded-lg text-xs font-medium transition-all" x-text="u"></button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Material Selection Pills -->
                    <div>
                        <label class="block text-xs font-medium text-zinc-300 mb-2"><span class="text-rose-500">*</span> Material Category:</label>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="mat in ['PLA', 'ABS', 'PETG', 'TPU', 'PC', 'ASA', 'PEEK', 'PPS', 'Custom']">
                                <button type="button" @click="materialCat = mat" :class="materialCat === mat ? 'bg-indigo-500/20 text-indigo-300 border-indigo-500' : 'bg-zinc-950 text-zinc-400 border-zinc-800 hover:border-zinc-700 hover:text-zinc-200'" class="px-3 py-1.5 border rounded-lg text-xs font-medium transition-all" x-text="mat"></button>
                            </template>
                        </div>
                    </div>

                    <!-- Specific Material Type -->
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <label class="block text-xs font-medium text-zinc-300">Type of Material:</label>
                            <span class="text-[11px] text-amber-400 flex items-center gap-1 bg-amber-400/10 px-2 py-0.5 rounded border border-amber-400/20">
                                ⚠️ Deformation warning (For non-metal parts with thin structures)
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="t in ['Standard white material (UTR 8360)', 'UTR Imagine Black', 'UTR-8100 (transparent)', 'PWR Dark Black', 'UTR-8100 (translucent)', 'Somos ® Ledo', 'UTR 8220', 'Somos ® Taurus', 'UTR 3000', 'UTR Therm', 'Somos ® EvoLVE 128', 'UTR Flex', 'Somos ® PerFORM', 'TDS EvoDent', 'Formlabs ESD Resin']">
                                <button type="button" @click="materialType = t" :class="materialType === t ? 'bg-indigo-500/20 text-indigo-300 border-indigo-500' : 'bg-zinc-950 text-zinc-400 border-zinc-800 hover:border-zinc-700 hover:text-zinc-200'" class="px-3 py-1.5 border rounded-lg text-xs font-medium transition-all" x-text="t"></button>
                            </template>
                        </div>
                    </div>

                    <!-- Material Color & Process -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-zinc-300 mb-2"><span class="text-rose-500">*</span> Material Color:</label>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="c in ['Matte white', 'Black', 'Grey', 'Clear']">
                                    <button type="button" @click="color = c" :class="color === c ? 'bg-indigo-500/20 text-indigo-300 border-indigo-500' : 'bg-zinc-950 text-zinc-400 border-zinc-800 hover:border-zinc-700 hover:text-zinc-200'" class="px-3 py-1.5 border rounded-lg text-xs font-medium transition-all" x-text="c"></button>
                                </template>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <label class="block text-xs font-medium text-zinc-300"><span class="text-rose-500">*</span> Process:</label>
                                <span class="text-[11px] text-amber-400 flex items-center gap-1">⚠️ Support surface</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="p in ['SLA', 'FDM', 'SLS', 'MJF']">
                                    <button type="button" @click="process = p" :class="process === p ? 'bg-indigo-500/20 text-indigo-300 border-indigo-500' : 'bg-zinc-950 text-zinc-400 border-zinc-800 hover:border-zinc-700 hover:text-zinc-200'" class="px-3 py-1.5 border rounded-lg text-xs font-medium transition-all" x-text="p"></button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Selected Material Details Card & Surface Finish Dropdown -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-zinc-950 border border-zinc-800 rounded-2xl">
                        <div>
                            <span class="text-[11px] font-semibold text-zinc-400 uppercase tracking-wider block mb-2">Selected Material</span>
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-zinc-900 border border-zinc-800 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-white" x-text="materialType"></p>
                                    <a href="#" class="text-[11px] text-emerald-400 hover:underline">Show material description</a>
                                    <div class="text-[11px] text-amber-400 flex items-center gap-1 mt-0.5">
                                        <span>★ 5.0</span>
                                        <span class="text-zinc-500">(1176 Reviews)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="text-xs font-medium text-zinc-300">Surface Finish - 5 options</label>
                                <span class="text-[11px] text-amber-400">⚠️ Discrepancy warning</span>
                            </div>
                            <select class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-indigo-500 transition-colors">
                                <option>Standard Sanded (Supports Removed)</option>
                                <option>Smooth Painted</option>
                                <option>Clear Coat Gloss</option>
                                <option>Matte Polished</option>
                                <option>Custom Post-Processing</option>
                            </select>
                        </div>
                    </div>

                    <!-- Special Instructions -->
                    <div>
                        <label class="block text-xs font-medium text-zinc-300 mb-1">Additional Project Details / Requirements</label>
                        <textarea rows="2" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-indigo-500 transition-colors resize-none" placeholder="Dimensions, special tolerances, or specific assembly instructions..."></textarea>
                    </div>

                </div>
            </div>

            <!-- Summary Sidebar Column -->
            <div class="lg:col-span-4 flex flex-col justify-between space-y-6">
                <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-5 space-y-5">

                    <!-- Order Subtotal -->
                    <div class="flex items-center justify-between pb-4 border-b border-zinc-800">
                        <div>
                            <h3 class="text-sm font-bold text-white">Subtotal <span class="text-xs text-zinc-400 font-normal">(0 part)</span></h3>
                            <p class="text-[11px] text-zinc-500">VAT and freight excluded</p>
                        </div>
                        <span class="px-2 py-0.5 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-xs font-bold rounded">RFQ</span>
                    </div>

                    <!-- Lead Time Indicator -->
                    <div>
                        <span class="text-xs font-medium text-zinc-400 block mb-2">Lead Time</span>
                        <div class="p-3 bg-zinc-900 border border-zinc-800 rounded-xl flex items-start gap-2.5">
                            <div class="w-4 h-4 rounded-full border-2 border-emerald-500 flex items-center justify-center shrink-0 mt-0.5">
                                <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></div>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-white">2–3 Business Days</p>
                                <p class="text-[11px] text-zinc-500">Estimated shipment: 3-7 Days</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-2.5 pt-2">
                        <button type="button" class="w-full bg-zinc-800 hover:bg-zinc-700 text-white text-xs font-semibold py-2.5 rounded-xl transition-colors border border-zinc-700 flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Add Another Part
                        </button>

                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold py-3 rounded-xl transition-colors shadow-lg shadow-emerald-600/20 cursor-pointer">
                            Submit Request
                        </button>
                    </div>

                    <!-- Terms -->
                    <p class="text-[11px] text-zinc-500 text-center leading-relaxed">
                        By submit request, you agree to the <a href="#" class="text-zinc-300 hover:underline">Terms of Service</a> and <a href="#" class="text-zinc-300 hover:underline">Privacy Policy &amp; Agreement</a>.
                    </p>
                </div>

                <!-- Contact Direct Info -->
                <div class="p-4 bg-zinc-950/50 border border-zinc-800/60 rounded-2xl text-center space-y-1">
                    <p class="text-xs text-zinc-400">Direct Contact: <a href="mailto:info@swartworks.co.uk" class="text-indigo-400 font-medium hover:underline">info@swartworks.co.uk</a></p>
                    <p class="text-[11px] text-zinc-500">We aim to respond to all RFQ requests within 24 hours.</p>
                </div>
            </div>

        </form>
    </div>
</div>
