<!DOCTYPE html>
<html lang="en" class="bg-zinc-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Swartworks</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Override Chrome/Edge autofill background and text colors */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #18181b inset !important; /* #18181b matches zinc-900 */
            -webkit-text-fill-color: #ffffff !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>
<body class="bg-zinc-900 text-zinc-100 flex items-center justify-center min-h-screen antialiased">
    <div class="w-full max-w-md bg-zinc-800 border border-zinc-700/50 p-8 rounded-xl shadow-2xl">
        <h2 class="text-2xl font-bold mb-6 text-white text-center tracking-tight">Sign In</h2>

        @if ($errors->any())
            <div class="mb-5 text-sm text-red-400 bg-red-950/60 border border-red-800/50 p-3.5 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-zinc-300">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 block w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-700 text-white rounded-lg shadow-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-colors">
            </div>

            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-zinc-300">Password</label>
                <input type="password" id="password" name="password" required
                    class="mt-1 block w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-700 text-white rounded-lg shadow-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-colors">
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center text-sm text-zinc-400 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded bg-zinc-900 border-zinc-700 text-indigo-500 focus:ring-indigo-500 focus:ring-offset-zinc-900">
                    <span class="ml-2 select-none">Remember me</span>
                </label>
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white font-semibold py-2.5 px-4 rounded-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-zinc-900 transition-colors shadow-md shadow-indigo-600/20">
                Log In
            </button>
        </form>
    </div>
</body>
</html>
