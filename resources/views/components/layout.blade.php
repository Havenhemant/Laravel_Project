<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

   
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-slate-950 text-white font-sans">
    <header class="bg-slate-900/80 backdrop-blur border-b border-slate-800 sticky top-0 z-50">
    <nav class="max-w-screen-lg mx-auto flex items-center justify-between p-4 flex-wrap gap-3">

        {{-- Logo --}}
        <a href="{{ route('home') }}"
   class="flex items-center gap-2 text-xl font-bold tracking-wide text-white hover:text-blue-400 transition">
    <img src="https://www.roihunt.in/wp-content/uploads/2025/04/The-Trusted-Partner-for-Your-eCommerce-Website-Maintenance-removebg-preview.png" alt="Logo" class="h-8 w-8 object-contain">
    {{ env('APP_NAME') }}
</a>

        {{-- Horizontal Menu --}}
        <div class="flex items-center gap-2 md:gap-4 flex-wrap">

            @auth
                @if(auth()->user()->role === 'admin')
                    {{-- ADMIN MENU --}}
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">Dashboard</a>
                    <a href="{{ route('admin.products') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">Products</a>
                    <a href="{{ route('admin.orders') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">Orders</a>
                    <a href="{{ route('admin.queries') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">Queries</a>
                    <a href="{{ route('admin.users') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">Users</a>
                @else
                    {{-- CUSTOMER MENU --}}
                    <a href="{{ route('gallery.index') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">Gallery</a>
                    <a href="{{ route('about.index') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">About</a>
                    <a href="{{ route('contact.index') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">Contact</a>
                    <a href="{{ route('products.index') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">Products</a>

                    <a href="{{ route('cart.index') }}" class="relative text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">
                        Cart
                        @php $count = collect(session('cart', []))->sum('quantity'); @endphp
                        @if($count > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-[10px] rounded-full w-4 h-4 flex items-center justify-center">
                                {{ $count }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('orders.index') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">My Orders</a>
                    <a href="{{ route('contact.index') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">Contact</a>
                @endif

                {{-- User + Logout --}}
                <div class="flex items-center gap-2 ml-2 pl-2 border-l border-slate-700">
                    <span class="text-xs text-slate-400 hidden md:inline">
                        👋 {{ auth()->user()->username }}
                        @if(auth()->user()->role === 'admin')
                            <span class="ml-1 text-[10px] bg-purple-600 text-white px-1.5 py-0.5 rounded">ADMIN</span>
                        @endif
                    </span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-sm text-red-400 hover:text-red-300 px-2 py-1 rounded transition">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth

            @guest
                <a href="{{ route('products.index') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">Products</a>
<a href="{{ route('gallery.index') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">Gallery</a>
                    <a href="{{ route('about.index') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">About</a>
                    <a href="{{ route('contact.index') }}" class="text-sm text-slate-300 hover:text-white px-2 py-1 rounded transition">Contact</a>
                <a href="{{ route('login') }}"
                   class="text-slate-300 hover:text-white transition text-sm">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-white transition text-sm">
                    Register
                </a>
            @endguest

        </div>

    </nav>
</header>
 
    <div class="max-w-screen-lg mx-auto mt-4 px-4 space-y-3">

         @if(session('success'))
            <div x-data="{ show: true }"
                 x-show="show"
                 class="bg-green-500/10 text-green-400 border border-green-500/20 px-4 py-3 rounded-lg flex justify-between">
                {{ session('success') }}
                <button @click="show=false">✖</button>
            </div>
        @endif

        @if(session('error'))
            <div x-data="{ show: true }"
                 x-show="show"
                 class="bg-red-500/10 text-red-400 border border-red-500/20 px-4 py-3 rounded-lg flex justify-between">
                {{ session('error') }}
                <button @click="show=false">✖</button>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500/10 text-red-400 border border-red-500/20 px-4 py-3 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

    </div>

    
    <main class="py-10 px-4 mx-auto max-w-screen-lg">
        {{ $slot }}
    </main>

</body>

</html>