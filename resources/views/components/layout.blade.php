<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-slate-950 text-white font-sans">

    <!-- NAVBAR -->
    <header class="bg-slate-900/80 backdrop-blur border-b border-slate-800 sticky top-0 z-50">
        <nav class="max-w-screen-lg mx-auto flex items-center justify-between p-4">

            <!-- Logo -->
            <a href="{{ route('posts.index') }}"
               class="text-xl font-bold tracking-wide text-white hover:text-blue-400 transition">
                📝 {{ env('APP_NAME') }}
            </a>

            <!-- AUTH -->
            @auth
                <div class="relative" x-data="{ open: false }">

                    <!-- Profile Button -->
                    <button @click="open = !open"
                        class="w-10 h-10 rounded-full overflow-hidden border border-slate-700 hover:scale-105 transition">
                        <img src="{{ asset('img/img_avatar2.png') }}" class="w-full h-full object-cover">
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open"
                         x-transition
                         @click.outside="open=false"
                         class="absolute right-0 mt-3 w-52 bg-slate-900 border border-slate-800 rounded-xl shadow-xl overflow-hidden">

                        <p class="px-4 py-2 text-xs text-slate-400 border-b border-slate-800">
                            👋 {{ auth()->user()->username }}
                        </p>

                        <a href="{{ route('dashboard') }}"
                           class="block px-4 py-2 text-sm hover:bg-slate-800 transition">
                            📊 Dashboard
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="w-full text-left px-4 py-2 text-sm hover:bg-slate-800 text-red-400 transition">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}"
                       class="text-slate-300 hover:text-white transition">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-white transition">
                        Register
                    </a>
                </div>
            @endguest

        </nav>
    </header>

    <!-- ALERTS -->
    <div class="max-w-screen-lg mx-auto mt-4 px-4 space-y-3">

        @if(session('success'))
            <div x-data="{ show: true }"
                 x-show="show"
                 class="bg-green-500/10 text-green-400 border border-green-500/20 px-4 py-3 rounded-lg flex justify-between">
                {{ session('success') }}
                <button @click="show=false">✖</button>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500/10 text-red-400 border border-red-500/20 px-4 py-3 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

    </div>

    <!-- MAIN CONTENT -->
    <main class="py-10 px-4 mx-auto max-w-screen-lg">
        {{ $slot }}
    </main>

</body>

</html>