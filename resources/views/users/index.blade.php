@extends('admin.layouts.app')

@section('title', 'User Management')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">User Management</h1>
        <p class="text-sm text-zinc-400 mt-1">Manage system accounts and access permissions</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white text-sm px-4 py-2.5 rounded-lg hover:bg-indigo-500 font-semibold transition-colors shadow-md shadow-indigo-600/20">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add New User
    </a>
</div>

<div class="bg-zinc-800/60 border border-zinc-700/60 rounded-xl shadow-xl overflow-hidden backdrop-blur-sm">
    <table class="w-full text-left border-collapse">
        <thead class="bg-zinc-900/80 border-b border-zinc-700/60 text-xs text-zinc-400 uppercase tracking-wider">
            <tr>
                <th class="py-3.5 px-6">ID</th>
                <th class="py-3.5 px-6">Name</th>
                <th class="py-3.5 px-6">Email</th>
                <th class="py-3.5 px-6">Role</th>
                <th class="py-3.5 px-6 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-700/60 text-sm text-zinc-300">
            @foreach ($users as $u)
                <tr class="hover:bg-zinc-700/30 transition-colors">
                    <td class="py-4 px-6 font-mono text-xs text-zinc-500">{{ $u->id }}</td>
                    <td class="py-4 px-6 font-medium text-white">{{ $u->name }}</td>
                    <td class="py-4 px-6 text-zinc-400">{{ $u->email }}</td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $u->role_id == 1 ? 'bg-purple-950/70 text-purple-300 border border-purple-800/50' : 'bg-blue-950/70 text-blue-300 border border-blue-800/50' }}">
                            {{ $u->role_name }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-right space-x-3">
                        <a href="{{ route('admin.users.edit', $u) }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">Edit</a>

                        @if (Auth::user()->role_name === 'Developer' && Auth::id() !== $u->id)
                            <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 font-medium transition-colors">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="p-4 border-t border-zinc-700/60 bg-zinc-900/40">
        {{ $users->links() }}
    </div>
</div>
@endsection
