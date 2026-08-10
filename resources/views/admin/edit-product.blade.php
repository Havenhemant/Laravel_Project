<x-layout>

<h1 class="text-xl font-bold mb-4">Edit Product</h1>

<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-3 max-w-md">
    @csrf
    @method('PUT')

    <input name="name" value="{{ $product->name }}" class="p-2 bg-gray-800 text-white w-full rounded">

    <input name="category" value="{{ $product->category }}" class="p-2 bg-gray-800 text-white w-full rounded">

    <textarea name="description" class="p-2 bg-gray-800 text-white w-full rounded">{{ $product->description }}</textarea>

    <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="p-2 bg-gray-800 text-white w-full rounded">

    <input type="number" name="stock" value="{{ $product->stock }}" class="p-2 bg-gray-800 text-white w-full rounded">
    
<label class="text-sm text-slate-400">Reorder Level</label>
<input type="number" name="reorder_level" value="{{ $product->reorder_level }}" class="p-2 bg-gray-800 text-white w-full rounded">
    @if($product->image)
        <img src="{{ asset('storage/'.$product->image) }}" class="w-32 rounded">
    @endif

    <input type="file" name="image" class="text-white">

    <button class="bg-green-600 px-4 py-2 text-white rounded">Update Product</button>
</form>

</x-layout>