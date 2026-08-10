<x-layout>


<div class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">

       
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-white">Welcome back </h1>
            <p class="text-slate-400 text-sm mt-1">
                Login to continue to your dashboard
            </p>
        </div>

       
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">

           
            @error('failed')
                <div class="mb-4 bg-red-500/10 text-red-400 border border-red-500/20 px-4 py-2 rounded-lg text-sm">
                    {{ $message }}
                </div>
            @enderror

            <form action="{{ route('login') }}" method="post" class="space-y-4">
                @csrf

             
                <div>
                    <label class="text-sm text-slate-400">Email</label>
                    <input type="email" name="email"
                           value="{{ old('email') }}"
                           class="mt-1 w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-blue-500 outline-none">

                    @error('email')
                        <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                
                <div>
                    <label class="text-sm text-slate-400">Password</label>
                    <input type="password" name="password"
                           class="mt-1 w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-blue-500 outline-none">

                    @error('password')
                        <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

               
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember"
                           class="w-4 h-4 accent-blue-600">

                    <label for="remember" class="text-sm text-slate-400">
                        Remember me
                    </label>
                </div>

               
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition">
                    Login
                </button>

            </form>

        </div>

       
        <p class="text-center text-sm text-slate-500 mt-4">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-blue-400 hover:underline">
                Register
            </a>
        </p>

    </div>

</div>

</x-layout>