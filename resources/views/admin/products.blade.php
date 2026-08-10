<x-layout>

<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-bold">Products</h1>
    <a href="{{ route('admin.products.create') }}"
       class="px-4 py-2 bg-green-600 text-white rounded">+ Add Product</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
@foreach($products as $product)
    <div class="p-4 bg-slate-800 rounded">
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-40 object-cover rounded mb-2">
        @endif
        <h2 class="font-semibold">{{ $product->name }}</h2>
        <p class="text-sm text-slate-400">{{ $product->category }}</p>
        <p class="text-lg">${{ number_format($product->price, 2) }}</p>
        <p class="text-xs text-slate-400">Stock: {{ $product->stock }}</p>
@if($product->isLowStock())
    <p class="text-xs bg-red-600 text-white px-2 py-1 rounded inline-block mt-1">⚠ Reorder needed</p>
@endif
        <div class="flex gap-2 mt-3">
            <a href="{{ route('admin.products.edit', $product) }}"
               class="px-3 py-1 bg-blue-600 text-white rounded">Edit</a>

            <form method="POST" action="{{ route('admin.products.delete', $product) }}"
                  onsubmit="return confirm('Delete this product?');">
                @csrf
                @method('DELETE')
                <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
            </form>
        </div>
    </div>
@endforeach
</div>

</x-layout>