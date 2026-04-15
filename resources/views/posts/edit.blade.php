<x-layout>

<div class="max-w-2xl mx-auto mt-10 bg-slate-900 p-6 rounded-xl">

    <h1 class="text-2xl font-bold text-white mb-6">Edit Post</h1>

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-4">
            <label class="text-sm text-slate-400">Title</label>
            <input type="text" name="title"
                   value="{{ old('title', $post->title) }}"
                   class="w-full mt-1 p-3 bg-slate-800 border border-slate-700 rounded text-white">

            @error('title')
                <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Body -->
        <div class="mb-4">
            <label class="text-sm text-slate-400">Content</label>
            <textarea name="body" rows="5"
                      class="w-full mt-1 p-3 bg-slate-800 border border-slate-700 rounded text-white">{{ old('body', $post->body) }}</textarea>

            @error('body')
                <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center">

            <a href="{{ route('dashboard') }}"
               class="text-slate-400 hover:text-white text-sm">
                ← Back
            </a>

            <button class="bg-blue-600 hover:bg-blue-700 px-5 py-2 rounded text-white">
                Update Post
            </button>

        </div>
    </form>

</div>

</x-layout>