<x-layout>

<h1 class="text-2xl font-bold mb-6">Manage Orders</h1>

@if($orders->count() === 0)
    <p class="text-slate-400">No orders yet.</p>
@else
    <div class="space-y-4">
    @foreach($orders as $order)
        <div class="bg-slate-800 p-4 rounded">

            <div class="flex justify-between items-start">
                <div>
                    <p class="font-semibold">Order #{{ $order->id }}</p>
                    <p class="text-sm text-slate-400">
                        Customer: {{ $order->customer->username ?? 'N/A' }} ({{ $order->customer->email ?? '' }})
                    </p>
                    <p class="text-sm text-slate-400">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                </div>

                @if($order->status === 'approved')
                    <span class="text-xs bg-green-600 px-3 py-1 rounded h-fit">Approved</span>
                @elseif($order->status === 'declined')
                    <span class="text-xs bg-red-600 px-3 py-1 rounded h-fit">Declined</span>
                @else
                    <span class="text-xs bg-yellow-600 px-3 py-1 rounded h-fit">Pending</span>
                @endif
            </div>

            <div class="mt-3 border-t border-slate-700 pt-3 space-y-1">
                @foreach($order->items as $item)
                    <p class="text-sm">
                        {{ $item->product->name ?? 'Product removed' }}
                        × {{ $item->quantity }}
                        — ${{ number_format($item->unit_price * $item->quantity, 2) }}
                    </p>
                @endforeach
            </div>

            <p class="mt-2 font-bold">Total: ${{ number_format($order->total_amount, 2) }}</p>
            <p class="text-sm text-slate-400">Delivery: {{ $order->address }} | {{ $order->phone }}</p>

            @if($order->status === 'pending')
                <div class="flex gap-2 mt-3">
                    <form method="POST" action="{{ route('admin.orders.approve', $order) }}">
                        @csrf
                        @method('PUT')
                        <button class="px-3 py-1 bg-green-600 text-white rounded">Approve</button>
                    </form>

                    <form method="POST" action="{{ route('admin.orders.decline', $order) }}">
                        @csrf
                        @method('PUT')
                        <button class="px-3 py-1 bg-red-600 text-white rounded">Decline</button>
                    </form>
                </div>
            @endif

        </div>
    @endforeach
    </div>
@endif

</x-layout>