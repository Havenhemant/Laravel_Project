<x-layout>

<h1 class="text-xl font-bold mb-4">Edit User</h1>

<form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf
    @method('PUT')

    <input name="username" value="{{ $user->username }}" class="p-2 bg-gray-800 text-white w-full mb-2">

    <input name="email" value="{{ $user->email }}" class="p-2 bg-gray-800 text-white w-full mb-2">

    <input name="role" value="{{ $user->role }}" class="p-2 bg-gray-800 text-white w-full mb-2">

    <button class="bg-green-600 px-4 py-2 text-white">
        Update User
    </button>
</form>

</x-layout>