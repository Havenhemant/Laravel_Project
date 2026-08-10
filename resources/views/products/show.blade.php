<x-layout>

<div class="max-w-md mx-auto bg-slate-800 p-4 rounded">
    @if($product->image)
        <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-56 object-cover rounded mb-3">
    @endif

    <h1 class="text-xl font-bold">{{ $product->name }}</h1>
    <p class="text-sm text-slate-400">{{ $product->category }}</p>
    <p class="mt-2">{{ $product->description }}</p>
    <p class="text-2xl mt-3">${{ number_format($product->price, 2) }}</p>
    <p class="text-xs text-slate-400">Stock: {{ $product->stock }}</p>

    @auth
        @if(auth()->user()->role !== 'admin')
            @if($product->stock > 0)
                <form method="POST" action="{{ route('cart.add', $product) }}" class="mt-4 flex gap-2">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                           class="w-20 p-2 bg-gray-700 text-white rounded">
                    <button class="flex-1 bg-green-600 px-4 py-2 text-white rounded">Add to Cart</button>
                </form>
            @else
                <p class="mt-4 text-red-400">Out of Stock</p>
            @endif
        @endif
    @else
        <a href="{{ route('login') }}" class="block mt-4 text-center bg-blue-600 px-4 py-2 text-white rounded">
            Login to Add to Cart
        </a>
    @endauth
</div>

</x-layout>