<x-layout>

<!-- Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-white">
        Hello, {{ auth()->user()->username }} 
    </h1>
    <p class="text-slate-400 text-sm mt-1">
        Manage your posts and create new content easily.
    </p>
</div>

<!-- Flash Message -->
@if (session('success'))
    <div class="mb-6 bg-green-500/10 text-green-400 border border-green-500/20 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<!-- CREATE POST -->
<div class="bg-slate-900 border border-slate-800 rounded-xl p-6 mb-10">

    <h2 class="text-lg font-semibold mb-4"> Create New Post</h2>

    <form action="{{ route('posts.store') }}" method="post" class="space-y-4">
        @csrf

        <!-- Title -->
        <div>
            <label class="text-sm text-slate-400">Post Title</label>
            <input type="text" name="title"
                   value="{{ old('title') }}"
                   class="mt-1 w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-blue-500 outline-none">

            @error('title')
                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Body -->
        <div>
            <label class="text-sm text-slate-400">Post Content</label>
            <textarea name="body" rows="5"
                      class="mt-1 w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-blue-500 outline-none">{{ old('body') }}</textarea>

            @error('body')
                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Button -->
        <button class="bg-blue-600 hover:bg-blue-700 px-5 py-2 rounded-lg text-white transition">
            Create Post
        </button>

    </form>
</div>

<!-- POSTS HEADER -->
<div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-semibold">Your Posts</h2>
</div>

<!-- POSTS GRID -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

   @foreach ($posts as $post)
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-5 hover:shadow-lg hover:scale-[1.02] transition">

        <!-- Title -->
        <h2 class="text-lg font-bold text-white">
            {{ $post->title }}
        </h2>

        <!-- Meta -->
        <div class="text-xs text-slate-400 mt-2">
            Posted {{ $post->created_at->diffForHumans() }} by
            <span class="text-blue-400 font-medium">
                {{ $post->user->username ?? auth()->user()->username }}
            </span>
        </div>

        <!-- Body -->
        <p class="text-sm text-slate-300 mt-3 leading-relaxed">
            {{ Str::words($post->body, 18) }}
        </p>

        <!-- ACTIONS -->
        <div class="mt-4 flex items-center gap-3">

            <!-- VIEW -->
          <a href="{{ route('posts.show', $post) }}">View</a>

<a href="{{ route('posts.edit', $post) }}">Edit</a>

<form action="{{ route('posts.destroy', $post) }}" method="POST">
    @csrf
    @method('DELETE')
    <button>Delete</button>
</form>

        </div>

    </div>
@endforeach
</div>

<!-- PAGINATION -->
<div class="mt-8">
    <div class="text-slate-400">
        {{ $posts->links() }}
    </div>
</div>

</x-layout>