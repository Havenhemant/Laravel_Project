<x-layout>

<div class="max-w-2xl mx-auto mt-10 bg-slate-900 p-6 rounded-xl">

    <h1 class="text-2xl font-bold text-white">{{ $post->title }}</h1>

    <p class="text-sm text-slate-400 mt-2">
        By {{ $post->user->username }}
    </p>

    <p class="text-slate-300 mt-4">
        {{ $post->body }}
    </p>

</div>

</x-layout>