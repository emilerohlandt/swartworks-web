@extends('admin.layouts.app')

@section('title', 'Material Categories')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white tracking-tight">Material Categories</h2>
            <p class="text-sm text-zinc-400 mt-1">Manage core material families (e.g., PLA, PETG, ABS)</p>
        </div>
        <a href="{{ route('admin.material-categories.create') }}"
           class="px-4 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-500 transition-colors shadow-md shadow-indigo-600/20">
            + Add Category
        </a>
    </div>

    <div class="bg-zinc-800/60 border border-zinc-700/60 rounded-xl shadow-xl overflow-hidden backdrop-blur-sm">
        <table class="w-full text-left text-sm text-zinc-300">
            <thead class="bg-zinc-900/80 border-b border-zinc-700/60 text-zinc-400 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3.5 font-medium">Category Name</th>
                    <th class="px-6 py-3.5 font-medium">Associated Types</th>
                    <th class="px-6 py-3.5 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-700/60">
                @forelse ($categories as $category)
                    <tr class="hover:bg-zinc-700/20 transition-colors">
                        <td class="px-6 py-4 font-semibold text-white">{{ $category->name }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-zinc-900 border border-zinc-700/80 rounded-md text-xs font-mono text-zinc-300">
                                {{ $category->materials_count }} Types
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('admin.material-categories.edit', $category) }}" class="text-indigo-400 hover:text-indigo-300 font-medium">Edit</a>
                            <form action="{{ route('admin.material-categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-zinc-500">No material categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>{{ $categories->links() }}</div>
</div>
@endsection
