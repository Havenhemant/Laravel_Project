<x-layout>

<h1 class="text-xl font-bold mb-4">Add Product</h1>

<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-3 max-w-md">
    @csrf

    <input name="name" placeholder="Product Name" value="{{ old('name') }}"
           class="p-2 bg-gray-800 text-white w-full rounded">

    <input name="category" placeholder="Category" value="{{ old('category') }}"
           class="p-2 bg-gray-800 text-white w-full rounded">

    <textarea name="description" placeholder="Description"
              class="p-2 bg-gray-800 text-white w-full rounded">{{ old('description') }}</textarea>

    <input type="number" step="0.01" name="price" placeholder="Price" value="{{ old('price') }}"
           class="p-2 bg-gray-800 text-white w-full rounded">

    <input type="number" name="stock" placeholder="Stock" value="{{ old('stock') }}"
           class="p-2 bg-gray-800 text-white w-full rounded">
    <label class="text-sm text-slate-400">Reorder Level (when product stock is low)</label>
<input type="number" name="reorder_level" placeholder="Reorder Level" value="{{ old('reorder_level', 5) }}"
       class="p-2 bg-gray-800 text-white w-full rounded">
    <input type="file" name="image" class="text-white">

    <button class="bg-green-600 px-4 py-2 text-white rounded">Add Product</button>
</form>

</x-layout>