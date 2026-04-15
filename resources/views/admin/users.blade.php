<x-layout>

<h1 class="text-xl font-bold mb-4">Users</h1>

@foreach($users as $user)
<div class="p-3 bg-slate-800 mb-2 flex justify-between items-center">

    <div>
        <p>{{ $user->username }} | {{ $user->email }} | {{ $user->role }}</p>
    </div>

    <div class="flex gap-2">

        <a href="{{ route('admin.users.edit', $user) }}"
           class="px-3 py-1 bg-blue-600 text-white rounded">
            Edit
        </a>

        <form method="POST" action="{{ route('admin.users.delete', $user) }}">
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