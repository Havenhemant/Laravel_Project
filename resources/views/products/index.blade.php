<x-layout>

{{-- Hero Banner --}}
<div class="relative overflow-hidden rounded-3xl mb-10 bg-gradient-to-br from-amber-500 via-yellow-500 to-orange-600 shadow-2xl shadow-amber-900/30">

    {{-- decorative blurred blobs --}}
    <div class="absolute -top-16 -left-16 w-64 h-64 bg-yellow-300/40 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-20 -right-10 w-72 h-72 bg-orange-700/40 rounded-full blur-3xl"></div>
    <div class="absolute top-8 right-10 text-8xl md:text-9xl rotate-12 opacity-20 select-none pointer-events-none">🥤</div>

    <div class="relative flex flex-col md:flex-row items-center gap-6 px-6 py-10 md:px-14 md:py-16">

        <div class="flex-1 text-center md:text-left animate-fade-in">
            <span class="inline-block text-xs md:text-sm font-semibold tracking-widest uppercase bg-slate-950/20 text-white px-3 py-1 rounded-full mb-4">
                 New &middot; 🥤Made Fresh Daily
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-950 leading-tight mb-3">
                Go Bananas <br class="hidden md:block"> Over Our Shakes
            </h1>
            <p class="text-slate-900/80 md:text-lg max-w-md mx-auto md:mx-0 mb-6">
                Thick, creamy, and blended with real banana for a shake that hits different — grab one before it's gone.
            </p>
            <div class="flex items-center justify-center md:justify-start gap-3">
                <a href="{{ route('products.index') }}"
                   class="bg-slate-950 hover:bg-slate-800 text-white font-semibold px-6 py-3 rounded-xl transition shadow-lg">
                    Shop Shakes
                </a>
                <a href="{{ route('gallery.index') }}"
                   class="bg-white/90 hover:bg-white text-slate-900 font-semibold px-6 py-3 rounded-xl transition shadow-lg">
                    View Gallery
                </a>
            </div>
        </div>

        <div class="flex-shrink-0 relative">
            <div class="w-40 h-40 md:w-56 md:h-56 rounded-full bg-white/20 backdrop-blur flex items-center justify-center text-7xl md:text-9xl shadow-inner animate-fade-in">
                  🥤
            </div>
        </div>
    </div>
</div>

<h1 class="text-2xl font-bold mb-6">Our Products</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
@forelse($products as $product)
    <div class="p-4 bg-slate-800 rounded">
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-40 object-cover rounded mb-2">
        @endif
        <h2 class="font-semibold">{{ $product->name }}</h2>
        <p class="text-sm text-slate-400">{{ $product->category }}</p>
        <p class="text-lg">${{ number_format($product->price, 2) }}</p>

        @if($product->stock > 0)
            <p class="text-xs text-green-400">In Stock ({{ $product->stock }})</p>
        @else
            <p class="text-xs text-red-400">Out of Stock</p>
        @endif

        <a href="{{ route('products.show', $product) }}"
           class="block mt-3 text-center px-3 py-1 bg-blue-600 text-white rounded">View</a>
    </div>
@empty
    <p>No products available yet.</p>
@endforelse
</div>

</x-layout>