@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-white tracking-tight">Dashboard Overview</h1>
    <p class="text-sm text-zinc-400 mt-1">Welcome back, {{ Auth::user()->name }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Role Card -->
    <div class="bg-zinc-800/60 border border-zinc-700/60 p-6 rounded-xl shadow-lg backdrop-blur-sm">
        <div class="flex items-center justify-between">
            <h3 class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Role ID</h3>
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-500/10 text-indigo-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </span>
        </div>
        <p class="text-2xl font-bold text-white mt-3">{{ Auth::user()->role_id }}</p>
    </div>

    <!-- Email Card -->
    <div class="bg-zinc-800/60 border border-zinc-700/60 p-6 rounded-xl shadow-lg backdrop-blur-sm">
        <div class="flex items-center justify-between">
            <h3 class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Account Email</h3>
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-zinc-700/50 text-zinc-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </span>
        </div>
        <p class="text-xl font-semibold text-white mt-3 truncate" title="{{ Auth::user()->email }}">
            {{ Auth::user()->email }}
        </p>
    </div>

    <!-- Status Card -->
    <div class="bg-zinc-800/60 border border-zinc-700/60 p-6 rounded-xl shadow-lg backdrop-blur-sm">
        <div class="flex items-center justify-between">
            <h3 class="text-xs font-semibold uppercase tracking-wider text-zinc-400">System Status</h3>
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </span>
        </div>
        <div class="mt-3 flex items-center gap-2">
            <span class="relative flex h-3 w-3">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
            </span>
            <p class="text-2xl font-bold text-emerald-400">Active</p>
        </div>
    </div>
</div>
@endsection
