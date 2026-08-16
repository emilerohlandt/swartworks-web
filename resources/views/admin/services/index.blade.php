@extends('admin.layouts.app')

@section('title', 'Services Management')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Services</h1>
        <p class="text-sm text-zinc-400 mt-1">Manage offering details, assigned materials, and showcase media</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white text-sm px-4 py-2.5 rounded-lg hover:bg-indigo-500 font-semibold transition-colors shadow-md shadow-indigo-600/20">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add New Service
    </a>
</div>

<div class="bg-zinc-800/60 border border-zinc-700/60 rounded-xl shadow-xl overflow-hidden backdrop-blur-sm">
    <table class="w-full text-left border-collapse">
        <thead class="bg-zinc-900/80 border-b border-zinc-700/60 text-xs text-zinc-400 uppercase tracking-wider">
            <tr>
                <th class="py-3.5 px-6">Service</th>
                <th class="py-3.5 px-6">Description</th>
                <th class="py-3.5 px-6">Assigned Materials</th>
                <th class="py-3.5 px-6 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-700/60 text-sm text-zinc-300">
            @forelse ($services as $service)
                <tr class="hover:bg-zinc-700/30 transition-colors">
                    <td class="py-4 px-6 font-semibold text-white">
                        <div class="flex items-center gap-3">
                            @if ($service->image_path)
                                <img src="{{ Storage::url($service->image_path) }}" alt="{{ $service->name }}" class="w-10 h-10 rounded-lg object-cover border border-zinc-700/80">
                            @else
                                <div class="w-10 h-10 rounded-lg bg-zinc-900 border border-zinc-700/80 flex items-center justify-center text-zinc-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <span>{{ $service->name }}</span>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-zinc-400 max-w-xs truncate">
                        {{ $service->description ?? '—' }}
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex flex-wrap gap-1.5">
                            @forelse ($service->materials as $material)
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-950/70 text-indigo-300 border border-indigo-800/50">
                                    {{ $material->name }}
                                </span>
                            @empty
                                <span class="text-xs text-zinc-500 italic">None assigned</span>
                            @endforelse
                        </div>
                    </td>
                    <td class="py-4 px-6 text-right space-x-3">
                        <a href="{{ route('admin.services.edit', $service) }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">Edit</a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="inline" onsubmit="return confirm('Delete this service?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 font-medium transition-colors">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-8 px-6 text-center text-zinc-500">
                        No services added yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="p-4 border-t border-zinc-700/60 bg-zinc-900/40">
        {{ $services->links() }}
    </div>
</div>
@endsection
