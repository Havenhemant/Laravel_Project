<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-100 text-slate-900">
    <header class="bg-slate-800 shadow-lg">
        <nav>
            <a href="{{ route('home') }}" class="nav-link">Home</a>

            @auth
                 <div class="relative grid place-items-center" 
                 x-data="{open:false}">
                    {{-- Dropdown menu button --}}
                    <button @click="open=!open"
                    class="round-btn">
                        <img src="{{asset('img/img_avatar2.png')}}" alt="profile">
                    </button>

                    {{-- Dropdown menu --}}
                    <div x-show="open" @click.outside="open=false"
                    class="bg-white shadow-lg absolute top-10 
                    right-0 rounded-lg overflow-hidden flont-light">
                    <p class="username">{{auth()->user()->username}}</p>

                    <a href="{{route('dashboard')}}" class="block text-center">Dashboard</a>
                    <form action="{{route('logout')}}" method="Post">
                        @csrf
                        <button class="block w-full text-left hover:bg-slate-100 
                        pl-4 pr-8 py-2">Logout</button>
                    </form>

                    </div>
                 </div>
            @endauth

            @guest
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                </div>
            @endguest


        </nav>
    </header>

</body>

<main class="py-8 px-4 mx-auto max-w-screen-lg">
    {{ $slot }}
</main>

</html>
