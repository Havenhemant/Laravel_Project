<x-layout>

<h1 class="text-2xl font-bold mb-6">My Orders</h1>

@if($orders->count() === 0)
    <p class="text-slate-400">You haven't placed any orders yet. <a href="{{ route('products.index') }}" class="text-blue-400">Start shopping</a></p>
@else
    <div class="space-y-4">
    @foreach($orders as $order)
        <div class="bg-slate-800 p-4 rounded">
            <div class="flex justify-between items-center mb-2">
                <p class="font-semibold">Order #{{ $order->id }}</p>

                @if($order->status === 'approved')
                    <span class="text-xs bg-green-600 px-2 py-1 rounded">Approved</span>
                @elseif($order->status === 'declined')
                    <span class="text-xs bg-red-600 px-2 py-1 rounded">Declined</span>
                @else
                    <span class="text-xs bg-yellow-600 px-2 py-1 rounded">Pending</span>
                @endif
            </div>

            <p class="text-sm text-slate-400">{{ $order->created_at->format('d M Y, h:i A') }}</p>

            <div class="mt-2 space-y-1">
                @foreach($order->items as $item)
                    <p class="text-sm">{{ $item->product->name ?? 'Product removed' }} × {{ $item->quantity }} — ${{ number_format($item->subtotal(), 2) }}</p>
                @endforeach
            </div>

            <p class="mt-2 font-bold">Total: ${{ number_format($order->total_amount, 2) }}</p>
        </div>
    @endforeach
    </div>

    {{ $orders->links() }}
@endif

</x-layout>