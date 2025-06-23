<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inventory Management Login | InventoryPro</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            /* Add a background image with overlay */
            background:
                linear-gradient(rgba(54, 89, 226, 0.7), rgba(6, 182, 212, 0.7)),
                url('{{ asset('images/inventory.jpg') }}') center center/cover no-repeat fixed;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-6">

    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-2xl flex overflow-hidden border border-blue-200">
        <!-- Left Side with Branding and Real Image -->
        <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-indigo-500 to-cyan-400 flex-col justify-center items-center p-10 text-white">
            <h1 class="text-4xl font-black mb-3 tracking-wide drop-shadow-lg">InventoryPro</h1>
            <p class="text-base opacity-90 mb-8 text-center">Smart, simple, and secure inventory management for your business.</p>
            <img src="{{ asset('images/inventory.jpg') }}" alt="Inventory" class="w-72 rounded-2xl shadow-xl border-4 border-white" />
        </div>

        <!-- Right Side Login Form -->
        <div class="w-full lg:w-1/2 p-8 sm:p-14 flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-indigo-700 mb-4">Sign in to InventoryPro</h2>
            <p class="text-gray-500 mb-6">Access your dashboard and manage your stock efficiently.</p>

            @if (session('status'))
                <div class="mb-4 text-green-600 font-medium">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2 border border-cyan-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400"
                        placeholder="you@example.com" />
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-4 py-2 border border-cyan-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400"
                        placeholder="••••••••" />
                    @error('password')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-400" />
                        <span class="ml-2">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-cyan-600 hover:underline text-sm">Forgot password?</a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-500 to-cyan-400 text-white py-2.5 rounded-md font-semibold hover:from-indigo-600 hover:to-cyan-500 transition">
                    Sign In
                </button>
            </form>

            <p class="mt-7 text-center text-gray-400 text-sm">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-cyan-600 font-semibold hover:underline">Register here</a>
            </p>
        </div>
    </div>

</body>

</html>
