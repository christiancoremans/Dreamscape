<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'DreamScape') }}</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-black antialiased">
    <!-- Navigation Bar -->
    <nav class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo/Site Name -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-semibold tracking-tight">
                        DreamScape
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium hover:text-black/60 transition-colors">
                        Home
                    </a>

                    <a href="{{ route('items.index') }}" class="text-sm font-medium hover:text-black/60 transition-colors">
                        Items
                    </a>

                    @auth
                        <a href="{{ route('inventory.index') }}" class="text-sm font-medium hover:text-black/60 transition-colors">
                            Inventory
                        </a>

                        <a href="{{ route('profile.edit') }}" class="text-sm font-medium hover:text-black/60 transition-colors">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium hover:text-black/60 transition-colors">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium hover:text-black/60 transition-colors">
                            Login
                        </a>

                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium bg-black text-white hover:bg-black/80 transition-colors">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    {{ $slot }}
</body>
</html>
