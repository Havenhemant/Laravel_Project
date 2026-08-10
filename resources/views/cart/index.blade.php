<x-layout>

<h1 class="text-2xl font-bold mb-6">Your Cart</h1>

@if(count($cart) === 0)
    <p class="text-slate-400">Your cart is empty. <a href="{{ route('products.index') }}" class="text-blue-400">Browse products</a></p>
@else
    <div class="space-y-4">
    @php $total = 0; @endphp

    @foreach($cart as $productId => $item)
        @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp

        <div class="flex items-center justify-between bg-slate-800 p-4 rounded">
            <div class="flex items-center gap-3">
                @if($item['image'])
                    <img src="{{ asset('storage/'.$item['image']) }}" class="w-16 h-16 object-cover rounded">
                @endif
                <div>
                    <p class="font-semibold">{{ $item['name'] }}</p>
                    <p class="text-sm text-slate-400">${{ number_format($item['price'], 2) }} each</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <form method="POST" action="{{ route('cart.update') }}" class="flex items-center gap-2">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $productId }}">
                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                           class="w-16 p-1 bg-gray-700 text-white rounded">
                    <button class="text-xs bg-blue-600 px-2 py-1 rounded text-white">Update</button>
                </form>

                <p class="w-20 text-right">${{ number_format($subtotal, 2) }}</p>

                <form method="POST" action="{{ route('cart.remove', $productId) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-xs bg-red-600 px-2 py-1 rounded text-white">Remove</button>
                </form>
            </div>
        </div>
    @endforeach

    </div>

    <div class="mt-6 flex justify-between items-center bg-slate-800 p-4 rounded">
        <p class="text-xl font-bold">Total: ${{ number_format($total, 2) }}</p>
        <a href="{{ route('checkout.index') }}" class="bg-green-600 px-6 py-2 text-white rounded">
    Proceed to Checkout
</a>
    </div>
@endif

</x-layout>