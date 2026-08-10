<x-layout>

<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-bold">My Queries</h1>
    <a href="{{ route('contact.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">+ New Query</a>
</div>

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
        <p class="text-sm text-slate-400 mt-1">{{ $query->body }}</p>
        <p class="text-xs text-slate-500 mt-1">{{ $query->created_at->format('d M Y, h:i A') }}</p>
    </div>
@empty
    <p class="text-slate-400">You haven't sent any queries yet.</p>
@endforelse

</x-layout>