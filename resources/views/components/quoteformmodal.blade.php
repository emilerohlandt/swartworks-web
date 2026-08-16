<div x-show="quoteOpen"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 backdrop-blur-none"
     x-transition:enter-end="opacity-100 backdrop-blur-none"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 backdrop-blur-md"
     x-transition:leave-end="opacity-0 backdrop-blur-none"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-zinc-950/80 backdrop-blur-md overflow-y-auto"
     style="display: none;">

    <!-- Modal Card -->
    <div @click.away="quoteOpen = false"
         x-show="quoteOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-4"
         x-data="{
             mode: 'basic',
             unit: 'mm',
             materialsMap: {{ \Illuminate\Support\Js::from($materialsMap) }},
             materialCat: '',
             materialType: '',
             color: '',

             init() {
                 const cats = Object.keys(this.materialsMap);
                 if (cats.length > 0) {
                     this.selectCategory(cats[0]);
                 }
             },

             selectCategory(cat) {
                 this.materialCat = cat;
                 const materials = Object.keys(this.materialsMap[cat] || {});
                 if (materials.length > 0) {
                     this.selectMaterial(materials[0]);
                 } else {
                     this.materialType = '';
                     this.color = '';
                 }
             },

             selectMaterial(type) {
                 this.materialType = type;
                 const colors = this.availableColors;
                 this.color = colors.length > 0 ? colors[0] : '';
             },

             get availableMaterials() {
                 return Object.keys(this.materialsMap[this.materialCat] || {});
             },

             get availableColors() {
                 return (this.materialsMap[this.materialCat] && this.materialsMap[this.materialCat][this.materialType])
                     ? this.materialsMap[this.materialCat][this.materialType]
                     : [];
             }
         }"
         class="bg-zinc-900 border border-zinc-800 w-full max-w-6xl rounded-3xl p-6 sm:p-8 shadow-2xl relative my-auto max-h-[90vh] overflow-y-auto no-scrollbar">

        <!-- Close Button -->
        <button @click="quoteOpen = false" class="absolute top-6 right-6 text-zinc-400 hover:text-white transition-colors z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <!-- Header Bar with Mode Selector Tabs -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pr-8">
            <div>
                <h2 class="text-xl font-bold text-white">Upload Design & Get a Quote</h2>
                <p class="text-xs text-zinc-400 mt-0.5" x-text="mode === 'basic' ? 'Quick setup for standard 3D prints.' : 'Full control over materials, tolerances, and processes.'"></p>
            </div>

            <!-- Mode Switcher Tabs -->
            <div class="inline-flex p-1 bg-zinc-950 border border-zinc-800 rounded-xl self-start sm:self-auto shrink-0">
                <button type="button"
                        @click="mode = 'basic'"
                        :class="mode === 'basic' ? 'bg-indigo-600 text-white shadow-sm' : 'text-zinc-400 hover:text-white'"
                        class="px-4 py-1.5 rounded-lg text-xs font-semibold transition-all flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Basic Quote
                </button>
                <button type="button"
                        @click="mode = 'advanced'"
                        :class="mode === 'advanced' ? 'bg-indigo-600 text-white shadow-sm' : 'text-zinc-400 hover:text-white'"
                        class="px-4 py-1.5 rounded-lg text-xs font-semibold transition-all flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    Advanced Quote
                </button>
            </div>
        </div>

        <!-- Form Layout -->
        <form action="#" method="POST" @submit.prevent="alert('Quote submitted!'); quoteOpen = false;" class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Main Form Column -->
            <div class="lg:col-span-8 space-y-5">

                <!-- File Upload Dropzone -->
                <div class="border-2 border-dashed border-zinc-700 hover:border-emerald-500/50 rounded-2xl p-8 text-center bg-zinc-950/50 transition-colors cursor-pointer group">
                    <div class="w-12 h-12 mx-auto mb-3 bg-emerald-500/10 text-emerald-400 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    </div>
                    <p class="text-base font-semibold text-white mb-1">Drag and drop here or select files</p>
                    <p class="text-xs text-zinc-400 mb-2">3D CAD files: <span class="text-zinc-300 font-mono">*.stl, *.obj, *.step, *.3mf</span></p>

                    <template x-if="mode === 'advanced'">
                        <div class="space-y-1">
                            <p class="text-[11px] text-zinc-500">You can add up to 24 rows of files. To ensure efficiency, do NOT upload compressed ZIP folders.</p>
                            <p class="text-[11px] text-rose-400/90 mt-2 font-medium">Note: No broken holes in design documents. Wall thickness &gt; 1.2mm, thinnest part &ge; 0.8mm.</p>
                        </div>
                    </template>
                </div>

                <!-- FDM Technology Info Box -->
                <div class="p-3 bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center justify-between text-xs">
                    <div class="flex items-center gap-2.5">
                        <div class="p-1 bg-emerald-500/20 rounded border border-emerald-500/30 text-emerald-400 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <span class="text-emerald-200 font-semibold block">FDM Printing Service</span>
                            <span class="text-emerald-300/80 text-[11px]">We specialize exclusively in FDM (Fused Deposition Modeling) technology for durable, functional prototypes and parts.</span>
                        </div>
                    </div>
                    <span class="hidden sm:inline-block px-2 py-1 bg-emerald-500/20 text-emerald-300 text-[10px] font-mono font-bold rounded border border-emerald-500/30 uppercase shrink-0 ml-3">FDM Only</span>
                </div>

                <!-- Policy Notice -->
                <div class="p-3 bg-zinc-950/80 border border-zinc-800/80 rounded-xl flex items-start gap-2.5 text-xs text-zinc-400">
                    <svg class="w-4 h-4 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p>
                        Uploading files for weapons, military items, or export-controlled items is strictly prohibited under our <a href="#" class="text-white hover:underline">Terms of Service</a>. Files are kept strictly confidential.
                    </p>
                </div>

                <!-- Form Inputs Container -->
                <div class="space-y-5 pt-2">

                    <!-- Contact Details -->
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

                    <!-- BASIC FORM VIEW -->
                    <template x-if="mode === 'basic'">
                        <div class="space-y-5">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-zinc-300 mb-1.5"><span class="text-rose-500">*</span> Material Choice</label>
                                    <select x-model="materialType" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-indigo-500 transition-colors">
                                        <option value="PLA - Basic">Standard PLA (Prototyping)</option>
                                        <option value="PETG - HF">PETG (Durable & Water-resistant)</option>
                                        <option value="ABS - Standard">ABS (High Strength)</option>
                                        <option value="TPU - 95A HF">TPU (Flexible / Rubber-like)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-zinc-300 mb-1.5"><span class="text-rose-500">*</span> Color</label>
                                    <select x-model="color" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-indigo-500 transition-colors">
                                        <option value="Matte white">Matte White</option>
                                        <option value="Black">Black</option>
                                        <option value="Grey">Grey</option>
                                        <option value="Clear">Clear</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-zinc-300 mb-1.5"><span class="text-rose-500">*</span> Quantity</label>
                                    <input type="number" min="1" value="1" required class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-indigo-500 transition-colors">
                                </div>
                            </div>

                            <div class="p-3 bg-indigo-500/10 border border-indigo-500/20 rounded-xl flex items-center justify-between text-xs">
                                <span class="text-indigo-300">Need custom infill, extra materials, specific tolerances, or composite options?</span>
                                <button type="button" @click="mode = 'advanced'" class="text-indigo-400 font-semibold hover:underline shrink-0 ml-2">Switch to Advanced &rarr;</button>
                            </div>
                        </div>
                    </template>

                    <!-- ADVANCED FORM VIEW -->
                    <template x-if="mode === 'advanced'">
                        <div class="space-y-5">
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

                            <!-- Material Category Buttons -->
                            <div>
                                <label class="block text-xs font-medium text-zinc-300 mb-2"><span class="text-rose-500">*</span> Material Category:</label>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="cat in Object.keys(materialsMap)" :key="cat">
                                        <button type="button"
                                                @click="selectCategory(cat)"
                                                :class="materialCat === cat ? 'bg-indigo-500/20 text-indigo-300 border-indigo-500' : 'bg-zinc-950 text-zinc-400 border-zinc-800 hover:border-zinc-700 hover:text-zinc-200'"
                                                class="px-3 py-1.5 border rounded-lg text-xs font-medium transition-all"
                                                x-text="cat"></button>
                                    </template>
                                </div>
                            </div>

                            <!-- Specific Material Type Buttons -->
                            <div>
                                <label class="block text-xs font-medium text-zinc-300 mb-2">Type of Material:</label>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="t in availableMaterials" :key="t">
                                        <button type="button"
                                                @click="selectMaterial(t)"
                                                :class="materialType === t ? 'bg-indigo-500/20 text-indigo-300 border-indigo-500' : 'bg-zinc-950 text-zinc-400 border-zinc-800 hover:border-zinc-700 hover:text-zinc-200'"
                                                class="px-3 py-1.5 border rounded-lg text-xs font-medium transition-all"
                                                x-text="t"></button>
                                    </template>
                                </div>
                            </div>

                            <!-- Material Color Buttons -->
                            <div>
                                <label class="block text-xs font-medium text-zinc-300 mb-2"><span class="text-rose-500">*</span> Material Color:</label>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="c in availableColors" :key="c">
                                        <button type="button"
                                                @click="color = c"
                                                :class="color === c ? 'bg-indigo-500/20 text-indigo-300 border-indigo-500' : 'bg-zinc-950 text-zinc-400 border-zinc-800 hover:border-zinc-700 hover:text-zinc-200'"
                                                class="px-3 py-1.5 border rounded-lg text-xs font-medium transition-all"
                                                x-text="c"></button>
                                    </template>
                                    <template x-if="availableColors.length === 0">
                                        <span class="text-xs text-zinc-500 italic">No colors available for this material</span>
                                    </template>
                                </div>
                            </div>

                            <!-- Additional Details -->
                            <div>
                                <label class="block text-xs font-medium text-zinc-300 mb-1">Additional Project Details / Requirements</label>
                                <textarea rows="2" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-indigo-500 transition-colors resize-none" placeholder="Layer height, infill density, special tolerances, or assembly instructions..."></textarea>
                            </div>
                        </div>
                    </template>

                </div>
            </div>

            <!-- Summary Sidebar -->
            <div class="lg:col-span-4 flex flex-col justify-between space-y-6">
                <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-5 space-y-5">

                    <!-- Selected Material Box -->
                    <div class="pb-4 border-b border-zinc-800">
                        <span class="text-[11px] font-semibold text-zinc-400 uppercase tracking-wider block mb-2">Selected Material & Color</span>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-zinc-900 border border-zinc-800 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-white" x-text="materialType || 'None selected'"></p>
                                <p class="text-[11px] text-zinc-400" x-text="'Color: ' + (color || 'N/A')"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Subtotal Header -->
                    <div class="flex items-center justify-between pb-4 border-b border-zinc-800">
                        <div>
                            <h3 class="text-sm font-bold text-white">Subtotal <span class="text-xs text-zinc-400 font-normal">(0 part)</span></h3>
                            <p class="text-[11px] text-zinc-500">VAT and freight excluded</p>
                        </div>
                        <span class="px-2 py-0.5 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-xs font-bold rounded">RFQ</span>
                    </div>

                    <!-- Lead Time -->
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
                        By submitting this request, you agree to the <a href="#" class="text-zinc-300 hover:underline">Terms of Service</a> and <a href="#" class="text-zinc-300 hover:underline">Privacy Policy &amp; Agreement</a>.
                    </p>
                </div>

                <!-- Direct Contact Footer -->
                <div class="p-4 bg-zinc-950/50 border border-zinc-800/60 rounded-2xl text-center space-y-1">
                    <p class="text-xs text-zinc-400">Direct Contact: <a href="mailto:info@swartworks.co.uk" class="text-indigo-400 font-medium hover:underline">info@swartworks.co.uk</a></p>
                    <p class="text-[11px] text-zinc-500">We aim to respond to all RFQ requests within 24 hours.</p>
                </div>
            </div>

        </form>
    </div>
</div>
