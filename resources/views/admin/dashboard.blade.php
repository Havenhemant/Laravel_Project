<x-layout>

<h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

<div class="grid grid-cols-2 gap-4 mb-6">

    <div class="p-4 bg-slate-800 rounded">
        <h2>Users</h2>
        <p class="text-2xl">{{ $users }}</p>
    </div>

    <div class="p-4 bg-slate-800 rounded">
        <h2>Posts</h2>
        <p class="text-2xl">{{ $posts }}</p>
    </div>

</div>

<!-- NAVIGATION LINKS -->
<div class="space-x-4">

    <a href="{{ route('admin.users') }}"
       class="bg-blue-600 px-4 py-2 text-white rounded">
        Manage Users
    </a>

    <a href="{{ route('admin.posts') }}"
       class="bg-green-600 px-4 py-2 text-white rounded">
        Manage Posts
    </a>

</div>

</x-layout>