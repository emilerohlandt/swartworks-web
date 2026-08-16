@extends('admin.layouts.app')

@section('title', 'Add Service')

@section('content')
<div class="max-w-2xl mx-auto bg-zinc-800/60 border border-zinc-700/60 p-8 rounded-xl shadow-xl backdrop-blur-sm">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-white tracking-tight">Add New Service</h2>
        <p class="text-sm text-zinc-400 mt-1">Configure service parameters, compatible materials, callout badge, and media</p>
    </div>

    <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Service Name -->
        <div>
            <label class="block text-sm font-medium text-zinc-300">Service Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Functional Prototypes" required
                   class="mt-1.5 w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-700 rounded-lg text-white placeholder-zinc-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors text-sm">
            @error('name')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Callout Badge Text -->
        <div>
            <label class="block text-sm font-medium text-zinc-300">Callout Pill Text</label>
            <input type="text" name="callout_text" value="{{ old('callout_text') }}" placeholder="e.g. Standard & Tough"
                   class="mt-1.5 w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-700 rounded-lg text-white placeholder-zinc-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors text-sm">
            <p class="text-xs text-zinc-500 mt-1">Overlay pill badge displayed on top of the service image card.</p>
            @error('callout_text')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Service Description -->
        <div>
            <label class="block text-sm font-medium text-zinc-300">Description</label>
            <textarea name="description" rows="3" placeholder="Overview of processing steps, layer tolerances, and output finish..."
                      class="mt-1.5 w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-700 rounded-lg text-white placeholder-zinc-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors text-sm">{{ old('description') }}</textarea>
            @error('description')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Assign Created Materials -->
        <div>
            <label class="block text-sm font-medium text-zinc-300 mb-2">Assign Materials</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                @foreach ($materials as $material)
                    <label class="flex items-center space-x-2.5 text-sm text-zinc-300 bg-zinc-900/80 p-3 rounded-lg border border-zinc-700/80 cursor-pointer hover:bg-zinc-700/40 hover:border-zinc-600 transition-colors">
                        <input type="checkbox" name="materials[]" value="{{ $material->id }}"
                            {{ is_array(old('materials')) && in_array($material->id, old('materials')) ? 'checked' : '' }}
                            class="rounded border-zinc-700 bg-zinc-900 text-indigo-500 focus:ring-indigo-500 focus:ring-offset-zinc-900">
                        <span class="font-medium text-zinc-200">{{ $material->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('materials')
                <span class="text-red-400 text-xs block mt-1.5">{{ $message }}</span>
            @enderror
        </div>

        <!-- Upload Service Image -->
        <div>
            <label class="block text-sm font-medium text-zinc-300 mb-1.5">Service Image</label>
            <input type="file" name="image" accept="image/*"
                   class="block w-full text-sm text-zinc-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-zinc-700 file:text-zinc-200 hover:file:bg-zinc-600 cursor-pointer bg-zinc-900 border border-zinc-700 rounded-lg">
            @error('image')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-3 pt-4 border-t border-zinc-700/60">
            <a href="{{ route('admin.services.index') }}"
               class="px-4 py-2.5 border border-zinc-700 rounded-lg text-sm font-medium text-zinc-300 hover:bg-zinc-800 hover:text-white transition-colors">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-500 transition-colors shadow-md shadow-indigo-600/20">
                Save Service
            </button>
        </div>
    </form>
</div>
@endsection
