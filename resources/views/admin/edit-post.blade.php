<x-layout>

<h1 class="text-xl font-bold mb-4">Edit Post</h1>

<form method="POST" action="{{ route('admin.posts.update', $post) }}">
    @csrf
    @method('PUT')

    <input name="title" value="{{ $post->title }}" class="p-2 bg-gray-800 text-white w-full mb-2">

    <textarea name="body" class="p-2 bg-gray-800 text-white w-full mb-2">
        {{ $post->body }}
    </textarea>

    <button class="bg-green-600 px-4 py-2 text-white">
        Update Post
    </button>
</form>

</x-layout>