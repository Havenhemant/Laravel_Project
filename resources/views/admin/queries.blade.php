<x-layout>

<h1 class="text-xl font-bold mb-4">Customer Queries</h1>

@forelse($queries as $query)
<div class="p-3 bg-slate-800 mb-2 rounded">

    <div class="flex justify-between">
        <h2 class="font-semibold">{{ $query->title }}</h2>
        @if($query->status === 'resolved')
            <span class="text-xs bg-green-600 px-2 py-1 rounded h-fit">Resolved</span>
        @else
            <span class="text-xs bg-yellow-600 px-2 py-1 rounded h-fit">Open</span>
        @endif
    </div>

    <p class="text-sm text-slate-400">By: {{ $query->user->username ?? 'N/A' }} ({{ $query->user->email ?? '' }})</p>
    <p class="mt-2">{{ $query->body }}</p>

    <div class="flex gap-2 mt-3">
        @if($query->status !== 'resolved')
            <form method="POST" action="{{ route('admin.queries.resolve', $query) }}">
                @csrf
                @method('PUT')
                <button class="px-3 py-1 bg-blue-600 text-white rounded">Mark Resolved</button>
            </form>
        @endif

        <form method="POST" action="{{ route('admin.queries.delete', $query) }}"
              onsubmit="return confirm('Delete this query?');">
            @csrf
            @method('DELETE')
            <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
        </form>
    </div>

</div>
@empty
    <p class="text-slate-400">No queries yet.</p>
@endforelse

</x-layout>