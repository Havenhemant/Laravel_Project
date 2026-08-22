<x-layout>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-950 dark:to-slate-900 px-4">

    <div class="w-full max-w-md animate-fade-in">

       
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-slate-800 dark:text-white">Create account</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Start building something amazing
            </p>
        </div>

      
        <div class="card dark:bg-slate-900 dark:border-slate-800">

            <form action="{{ route('register') }}" method="post" class="space-y-5">
                @csrf

                
                <div class="relative">
                    <span class="input-icon">👤</span>

                    <input type="text" name="username"
                        value="{{ old('username') }}"
                        placeholder="Username"
                        class="input peer pl-10 @error('username') ring-2 ring-red-500 @enderror">

                    <label class="floating-label"></label>

                    @error('username')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

              
                <div class="relative">
                    <span class="input-icon">📧</span>

                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        placeholder="Email "
                        class="input peer pl-10 @error('email') ring-2 ring-red-500 @enderror">

                    <label class="floating-label"></label>

                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

              
                <div class="relative">
                    <span class="input-icon">🔒</span>

                    <input id="password" type="password" name="password"
                        placeholder=" Password"
                        class="input peer pl-10 pr-10 @error('password') ring-2 ring-red-500 @enderror">

                    <label class="floating-label"></label>

                   
                    <button type="button" onclick="togglePassword('password', this)"
                        class="absolute right-3 top-3 text-slate-500 hover:text-slate-700 dark:hover:text-white">
                        👁
                    </button>

                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

             
                <div class="relative">
                    <span class="input-icon">🔒</span>

                    <input id="password_confirmation" type="password" name="password_confirmation"
                        placeholder="Confirm Password"
                        class="input peer pl-10 pr-10">

                    <label class="floating-label"></label>

                    <button type="button" onclick="togglePassword('password_confirmation', this)"
                        class="absolute right-3 top-3 text-slate-500 hover:text-slate-700 dark:hover:text-white">
                        👁
                    </button>
                </div>

               
                <button class="btn w-full">
                    Create account
                </button>

            </form>

        </div>

     
        <p class="text-center text-sm text-slate-500 dark:text-slate-400 mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                Login
            </a>
        </p>

    </div>
</div>


<script>
function togglePassword(id, btn) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        btn.textContent = "🙈";
    } else {
        input.type = "password";
        btn.textContent = "👁";
    }
}
</script>

</x-layout>
