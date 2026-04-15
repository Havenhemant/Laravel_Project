<x-layout>

<h1 class="text-xl font-bold mb-4">Posts</h1>

@foreach($posts as $post)
<div class="p-3 bg-slate-800 mb-2">

    <h2>{{ $post->title }}</h2>
    <p>By: {{ $post->user->username }}</p>

    <div class="flex gap-2 mt-2">

        <a href="{{ route('admin.posts.edit', $post) }}"
           class="px-3 py-1 bg-blue-600 text-white rounded">
            Edit
        </a>

        <form method="POST" action="{{ route('admin.posts.delete', $post) }}">
            @csrf
            @method('DELETE')
            <button class="px-3 py-1 bg-red-600 text-white rounded">
                Delete
            </button>
        </form>

    </div>

</div>
@endforeach

</x-layout>