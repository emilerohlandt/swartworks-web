@extends('admin.layouts.app')

@section('title', 'Edit Model Hub')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Edit Model Hub</h1>
            <p class="text-sm text-zinc-400 mt-1">Update details for <span class="text-zinc-200 font-medium">{{ $modelHub->name }}</span>.</p>
        </div>

        <a href="{{ route('admin.model-hubs.index') }}" class="inline-flex items-center gap-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm px-4 py-2.5 rounded-lg font-semibold transition-colors border border-zinc-700/80">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Hubs
        </a>
    </div>

    <form method="POST" action="{{ route('admin.model-hubs.update', $modelHub) }}" enctype="multipart/form-data" class="bg-zinc-800/60 border border-zinc-700/60 rounded-xl shadow-xl p-6 backdrop-blur-sm space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-zinc-300 mb-2">Hub Name <span class="text-indigo-400">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $modelHub->name) }}" required
                       placeholder="e.g. Printables, MakerWorld, Thingiverse"
                       class="w-full bg-zinc-900 border border-zinc-700/80 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
                @error('name')
                    <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type -->
            <div>
                <label for="type" class="block text-sm font-medium text-zinc-300 mb-2">Access Type <span class="text-indigo-400">*</span></label>
                <select name="type" id="type" required
                        class="w-full bg-zinc-900 border border-zinc-700/80 rounded-lg px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
                    <option value="Free" {{ old('type', $modelHub->type) == 'Free' ? 'selected' : '' }}>Free</option>
                    <option value="Premium" {{ old('type', $modelHub->type) == 'Premium' ? 'selected' : '' }}>Premium</option>
                </select>
                @error('type')
                    <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- URL -->
        <div>
            <label for="url" class="block text-sm font-medium text-zinc-300 mb-2">URL <span class="text-indigo-400">*</span></label>
            <input type="url" name="url" id="url" value="{{ old('url', $modelHub->url) }}" required
                   placeholder="https://..."
                   class="w-full bg-zinc-900 border border-zinc-700/80 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
            @error('url')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-zinc-300 mb-2">Description <span class="text-indigo-400">*</span></label>
            <textarea name="description" id="description" rows="3" required
                      placeholder="Brief overview of the resource..."
                      class="w-full bg-zinc-900 border border-zinc-700/80 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">{{ old('description', $modelHub->description) }}</textarea>
            @error('description')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Logo Upload -->
            <div>
                <label for="logo" class="block text-sm font-medium text-zinc-300 mb-2">Logo Image</label>

                @if($modelHub->logo_path)
                    <div class="flex items-center gap-3 mb-3 p-2 bg-zinc-900/60 border border-zinc-700/50 rounded-lg">
                        <img src="{{ Storage::url($modelHub->logo_path) }}" alt="{{ $modelHub->name }}" class="w-10 h-10 object-contain rounded bg-zinc-800 p-1 border border-zinc-700/50">
                        <div class="text-xs">
                            <p class="text-zinc-300 font-medium">Current Logo</p>
                            <p class="text-zinc-500">Upload a new file to replace</p>
                        </div>
                    </div>
                @endif

                <input type="file" name="logo" id="logo" accept="image/*"
                       class="w-full text-sm text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-zinc-700 file:text-zinc-200 hover:file:bg-zinc-600 file:cursor-pointer transition-colors bg-zinc-900 border border-zinc-700/80 rounded-lg p-1.5">
                @error('logo')
                    <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sort Order -->
            <div>
                <label for="sort_order" class="block text-sm font-medium text-zinc-300 mb-2">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $modelHub->sort_order) }}" min="0"
                       class="w-full bg-zinc-900 border border-zinc-700/80 rounded-lg px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
                @error('sort_order')
                    <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Active Toggle -->
        <div class="flex items-center gap-3 pt-2">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $modelHub->is_active) ? 'checked' : '' }}
                   class="w-4 h-4 rounded bg-zinc-900 border-zinc-700 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-zinc-900">
            <label for="is_active" class="text-sm font-medium text-zinc-300">Active (Visible on public index)</label>
        </div>

        <!-- Form Footer -->
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-700/60">
            <a href="{{ route('admin.model-hubs.index') }}" class="px-4 py-2.5 rounded-lg text-sm font-semibold text-zinc-400 hover:text-white transition-colors">
                Cancel
            </a>
            <button type="submit" class="bg-indigo-600 text-white text-sm px-5 py-2.5 rounded-lg hover:bg-indigo-500 font-semibold transition-colors shadow-md shadow-indigo-600/20">
                Update Model Hub
            </button>
        </div>
    </form>
</div>
@endsection
