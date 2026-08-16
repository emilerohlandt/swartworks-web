@extends('admin.layouts.app')

@section('title', 'Add New User')

@section('content')
<div class="max-w-2xl mx-auto bg-zinc-800/60 border border-zinc-700/60 p-8 rounded-xl shadow-xl backdrop-blur-sm">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-white tracking-tight">Create New User</h2>
        <p class="text-sm text-zinc-400 mt-1">Add a new account and set their role permissions</p>
    </div>

    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-5">
        @csrf

        <!-- Full Name -->
        <div>
            <label class="block text-sm font-medium text-zinc-300">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="mt-1.5 w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-700 rounded-lg text-white placeholder-zinc-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors text-sm">
            @error('name')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label class="block text-sm font-medium text-zinc-300">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="mt-1.5 w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-700 rounded-lg text-white placeholder-zinc-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors text-sm">
            @error('email')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Role Select -->
        <div>
            <label class="block text-sm font-medium text-zinc-300">Role</label>
            <select name="role_id" required
                    class="mt-1.5 w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors text-sm">
                <option value="" disabled {{ old('role_id') ? '' : 'selected' }} class="text-zinc-500">Select a role...</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" class="bg-zinc-900 text-white" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label class="block text-sm font-medium text-zinc-300">Password</label>
            <input type="password" name="password" required
                   class="mt-1.5 w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-700 rounded-lg text-white placeholder-zinc-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors text-sm">
            @error('password')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-3 pt-4 border-t border-zinc-700/60">
            <a href="{{ route('admin.users.index') }}"
               class="px-4 py-2.5 border border-zinc-700 rounded-lg text-sm font-medium text-zinc-300 hover:bg-zinc-800 hover:text-white transition-colors">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-500 transition-colors shadow-md shadow-indigo-600/20">
                Save User
            </button>
        </div>
    </form>
</div>
@endsection
