@extends('admin.layouts.app')

@section('title', 'Add Material')

@section('content')
@php
    $colorMap = [
        'Black'        => '#18181b',
        'White'        => '#f4f4f5',
        'Red'          => '#ef4444',
        'Blue'         => '#3b82f6',
        'Green'        => '#22c55e',
        'Yellow'       => '#eab308',
        'Gold'         => '#f59e0b',
        'Silver'       => '#9ca3af',
        'Grey'         => '#64748b',
        'Gray'         => '#64748b',
        'Orange'       => '#f97316',
        'Purple'       => '#a855f7',
        'Pink'         => '#ec4899',
        'Brown'        => '#78350f',
        'Multi-Colour' => 'linear-gradient(135deg, #ef4444, #3b82f6, #22c55e)',
        'Transparent'  => 'transparent',
        'Carbon-Fibre'  => '#666666',
    ];
@endphp

<div class="max-w-2xl mx-auto bg-zinc-800/60 border border-zinc-700/60 p-8 rounded-xl shadow-xl backdrop-blur-sm">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-white tracking-tight">Add 3D Printing Material</h2>
        <p class="text-sm text-zinc-400 mt-1">Define a new filament or resin type along with supported color variants</p>
    </div>

    <form method="POST" action="{{ route('admin.materials.store') }}" class="space-y-6">
        @csrf

        <!-- Material Category -->
        <div>
            <label class="block text-sm font-medium text-zinc-300">Category</label>
            <select name="material_category_id" required
                    class="mt-1.5 w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors text-sm">
                <option value="" disabled {{ old('material_category_id') ? '' : 'selected' }}>Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('material_category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('material_category_id')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Material Name -->
        <div>
            <label class="block text-sm font-medium text-zinc-300">Material Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. PLA, PETG, ABS, Resin" required
                   class="mt-1.5 w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-700 rounded-lg text-white placeholder-zinc-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors text-sm">
            @error('name')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Available Colors -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label class="block text-sm font-medium text-zinc-300">Available Colors</label>
                <div class="flex items-center gap-2 text-xs">
                    <button type="button" onclick="toggleAllColors(true)" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">
                        Select All
                    </button>
                    <span class="text-zinc-600">|</span>
                    <button type="button" onclick="toggleAllColors(false)" class="text-zinc-400 hover:text-zinc-300 font-medium transition-colors">
                        Deselect All
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                @foreach ($availableColors as $color)
                    @php
                        $hexColor = $colorMap[$color] ?? '#a1a1aa';
                    @endphp
                    <label class="flex items-center justify-between text-sm text-zinc-300 bg-zinc-900/80 p-3 rounded-lg border border-zinc-700/80 cursor-pointer hover:bg-zinc-700/40 hover:border-zinc-600 transition-colors">
                        <div class="flex items-center space-x-2.5">
                            <input type="checkbox" name="colors[]" value="{{ $color }}"
                                {{ is_array(old('colors')) && in_array($color, old('colors')) ? 'checked' : '' }}
                                class="color-checkbox rounded border-zinc-700 bg-zinc-900 text-indigo-500 focus:ring-indigo-500 focus:ring-offset-zinc-900">
                            <span class="font-medium text-zinc-200">{{ $color }}</span>
                        </div>
                        <!-- 10x10px Visual Color Dot -->
                        <span class="w-[10px] h-[10px] rounded-full border border-zinc-600/80 shrink-0"
                              style="background: {{ $hexColor }};"
                              title="{{ $color }}"></span>
                    </label>
                @endforeach
            </div>
            @error('colors')
                <span class="text-red-400 text-xs block mt-1.5">{{ $message }}</span>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-3 pt-4 border-t border-zinc-700/60">
            <a href="{{ route('admin.materials.index') }}"
               class="px-4 py-2.5 border border-zinc-700 rounded-lg text-sm font-medium text-zinc-300 hover:bg-zinc-800 hover:text-white transition-colors">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-500 transition-colors shadow-md shadow-indigo-600/20">
                Save Material
            </button>
        </div>
    </form>
</div>

<script>
    function toggleAllColors(state) {
        document.querySelectorAll('.color-checkbox').forEach(checkbox => {
            checkbox.checked = state;
        });
    }
</script>
@endsection
