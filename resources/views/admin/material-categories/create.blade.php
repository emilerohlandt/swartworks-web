@extends('admin.layouts.app')

@section('title', 'Add Material Category')

@section('content')
<div class="max-w-2xl mx-auto bg-zinc-800/60 border border-zinc-700/60 p-8 rounded-xl shadow-xl backdrop-blur-sm">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-white tracking-tight">Create Material Category</h2>
        <p class="text-sm text-zinc-400 mt-1">Add a primary filament or resin family (e.g., PLA, PETG, TPU)</p>
    </div>

    <form method="POST" action="{{ route('admin.material-categories.store') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-zinc-300">Category Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. PLA" required
                   class="mt-1.5 w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-700 rounded-lg text-white placeholder-zinc-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors text-sm">
            @error('name')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-zinc-700/60">
            <a href="{{ route('admin.material-categories.index') }}"
               class="px-4 py-2.5 border border-zinc-700 rounded-lg text-sm font-medium text-zinc-300 hover:bg-zinc-800 hover:text-white transition-colors">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-500 transition-colors shadow-md shadow-indigo-600/20">
                Save Category
            </button>
        </div>
    </form>
</div>
@endsection
