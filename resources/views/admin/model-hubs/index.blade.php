@extends('admin.layouts.app')

@section('title', 'Model Hubs')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Model Hubs</h1>
        <p class="text-sm text-zinc-400 mt-1">Manage external 3D model resources and repository links.</p>
    </div>

    <a href="{{ route('admin.model-hubs.create') }}"
       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg text-sm font-semibold transition-colors">
        Add Model Hub
    </a>
</div>

<div class="bg-zinc-950 border border-zinc-800 rounded-xl overflow-hidden">
    <table class="w-full text-left text-sm text-zinc-400">
        <thead class="bg-zinc-900 border-b border-zinc-800 text-xs text-zinc-300 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-3 font-semibold">Hub</th>
                <th class="px-6 py-3 font-semibold">Type</th>
                <th class="px-6 py-3 font-semibold">URL</th>
                <th class="px-6 py-3 font-semibold">Status</th>
                <th class="px-6 py-3 font-semibold">Order</th>
                <th class="px-6 py-3 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-800">
            @forelse ($hubs as $hub)
                <tr class="hover:bg-zinc-900/50 transition-colors">
                    <td class="px-6 py-4 font-medium text-white flex items-center gap-3">
                        @if($hub->logo_path)
                            <img src="{{ asset('storage/' . $hub->logo_path) }}" alt="{{ $hub->name }}" class="w-8 h-8 rounded-lg object-cover bg-zinc-900">
                        @else
                            <div class="w-8 h-8 rounded-lg bg-zinc-800 flex items-center justify-center text-xs font-bold text-zinc-400">
                                {{ strtoupper(substr($hub->name, 0, 2)) }}
                            </div>
                        @endif
                        <div>
                            <div class="font-semibold text-white">{{ $hub->name }}</div>
                            <div class="text-xs text-zinc-500 line-clamp-1">{{ $hub->description }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-zinc-300">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-800 text-zinc-300 border border-zinc-700">
                            {{ ucfirst($hub->type) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-zinc-400">
                        <a href="{{ $hub->url }}" target="_blank" rel="noopener noreferrer" class="hover:text-indigo-400 transition-colors inline-flex items-center gap-1">
                            {{ $hub->url }}
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        @if($hub->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-950/80 text-emerald-400 border border-emerald-800/60">
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-900 text-zinc-500 border border-zinc-800">
                                Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-zinc-400">{{ $hub->sort_order ?? 0 }}</td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.model-hubs.edit', $hub) }}" class="text-zinc-400 hover:text-white transition-colors">Edit</a>

                        <form method="POST" action="{{ route('admin.model-hubs.destroy', $hub) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this Model Hub?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-zinc-500">
                        No model hubs found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
