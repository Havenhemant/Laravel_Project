<x-layout>

<h1 class="text-2xl font-bold mb-6">Checkout</h1>

<div class="grid md:grid-cols-2 gap-6">

    <div class="bg-slate-800 p-4 rounded">
        <h2 class="font-semibold mb-3">Order Summary</h2>

        @foreach($cart as $item)
            <div class="flex justify-between text-sm py-1 border-b border-slate-700">
                <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
            </div>
        @endforeach

        <div class="flex justify-between font-bold mt-3">
            <span>Total</span>
            <span>${{ number_format($total, 2) }}</span>
        </div>
    </div>

    <div class="bg-slate-800 p-4 rounded">
        <h2 class="font-semibold mb-3">Billing Details</h2>

        <form method="POST" action="{{ route('checkout.place') }}" class="space-y-3">
            @csrf

            <textarea name="address" placeholder="Delivery Address" required
                      class="p-2 bg-gray-700 text-white w-full rounded">{{ old('address') }}</textarea>

            <input name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required
                   class="p-2 bg-gray-700 text-white w-full rounded">

            <button class="w-full bg-green-600 px-4 py-2 text-white rounded">Place Order</button>
        </form>
    </div>

</div>

</x-layout>