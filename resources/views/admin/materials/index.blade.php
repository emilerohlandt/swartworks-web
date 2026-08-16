@extends('admin.layouts.app')

@section('title', '3D Printing Materials')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">3D Printing Materials</h1>
        <p class="text-sm text-zinc-400 mt-1">Manage available filaments, resins, and color variants</p>
    </div>

    <div class="flex items-center gap-3">
        <!-- Category Filter -->
        <form method="GET" action="{{ route('admin.materials.index') }}" class="flex items-center">
            <select name="category" onchange="this.form.submit()"
                    class="bg-zinc-800 border border-zinc-700/80 text-zinc-300 text-sm rounded-lg px-3.5 py-2.5 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
                <option value="uncategorized" {{ request('category') === 'uncategorized' ? 'selected' : '' }}>Uncategorized</option>
            </select>
        </form>

        <a href="{{ route('admin.materials.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white text-sm px-4 py-2.5 rounded-lg hover:bg-indigo-500 font-semibold transition-colors shadow-md shadow-indigo-600/20 whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add New Material
        </a>
    </div>
</div>

<div class="bg-zinc-800/60 border border-zinc-700/60 rounded-xl shadow-xl overflow-hidden backdrop-blur-sm">
    <table class="w-full text-left border-collapse">
        <thead class="bg-zinc-900/80 border-b border-zinc-700/60 text-xs text-zinc-400 uppercase tracking-wider">
            <tr>
                <th class="py-3.5 px-6">Category</th>
                <th class="py-3.5 px-6">Material Name</th>
                <th class="py-3.5 px-6">Available Colors</th>
                <th class="py-3.5 px-6 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-700/60 text-sm text-zinc-300">
            @forelse ($materials as $material)
                <tr class="hover:bg-zinc-700/30 transition-colors">
                    <td class="py-4 px-6">
                        <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-indigo-950/60 text-indigo-300 border border-indigo-800/50">
                            {{ $material->category->name ?? 'Uncategorized' }}
                        </span>
                    </td>
                    <td class="py-4 px-6 font-semibold text-white">{{ $material->name }}</td>
                    <td class="py-4 px-6">
                        <div class="flex flex-wrap gap-1.5">
                            @foreach ($material->colors as $color)
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-900 text-zinc-300 border border-zinc-700/80">
                                    {{ $color }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="py-4 px-6 text-right space-x-3">
                        <a href="{{ route('admin.materials.edit', $material) }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">Edit</a>
                        <form method="POST" action="{{ route('admin.materials.destroy', $material) }}" class="inline" onsubmit="return confirm('Delete this material?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 font-medium transition-colors">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-8 px-6 text-center text-zinc-500">
                        No materials found matching the selected filter.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="p-4 border-t border-zinc-700/60 bg-zinc-900/40">
        {{ $materials->links('admin.partials.pagination') }}
    </div>
</div>
@endsection
