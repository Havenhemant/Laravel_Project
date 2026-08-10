<x-layout>

<div x-data="{ open: false, activeSrc: '', activeCaption: '' }" @keydown.escape.window="open = false">

    
    <div class="text-center mb-10">
        <span class="inline-block text-xs md:text-sm font-semibold tracking-widest uppercase bg-amber-500/10 text-amber-400 px-3 py-1 rounded-full mb-4">
            Gallery
        </span>
        <h1 class="text-3xl md:text-4xl font-extrabold mb-3">A Taste of What We Make</h1>
        <p class="text-slate-400 max-w-xl mx-auto">
            Real shakes, real moments — a look inside our little corner of blended bliss.
        </p>
    </div>

 
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">

        @foreach($shopImages as $img)
            <button type="button"
                    @click="open = true; activeSrc = '{{ asset($img['src']) }}'; activeCaption = '{{ $img['caption'] }}'"
                    class="relative aspect-square w-full rounded-2xl overflow-hidden border border-slate-800 bg-slate-900 group focus:outline-none focus:ring-2 focus:ring-amber-500">
                <img src="{{ asset($img['src']) }}"
                     alt="{{ $img['caption'] }}"
                     class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition"></div>
                <p class="absolute bottom-3 left-3 right-3 text-sm text-white font-medium opacity-0 group-hover:opacity-100 transition truncate">
                    {{ $img['caption'] }}
                </p>
            </button>
        @endforeach

        @forelse($productImages as $product)
            <button type="button"
                    @click="open = true; activeSrc = '{{ asset('storage/'.$product->image) }}'; activeCaption = '{{ $product->name }}'"
                    class="relative aspect-square w-full rounded-2xl overflow-hidden border border-slate-800 bg-slate-900 group focus:outline-none focus:ring-2 focus:ring-amber-500">
                <img src="{{ asset('storage/'.$product->image) }}"
                     alt="{{ $product->name }}"
                     class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition"></div>
                <p class="absolute bottom-3 left-3 right-3 text-sm text-white font-medium opacity-0 group-hover:opacity-100 transition truncate">
                    {{ $product->name }}
                </p>
            </button>
        @empty
        @endforelse

    </div>

    @if($productImages->isEmpty() && empty($shopImages))
        <p class="text-center text-slate-500 mt-10">No photos yet — check back soon!</p>
    @endif


    <div x-show="open"
         x-transition.opacity
         @click.self="open = false"
         class="fixed inset-0 z-[999] bg-slate-950/90 backdrop-blur flex items-center justify-center p-4"
         style="display: none;">
        <div class="relative max-w-3xl w-full">
            <button @click="open = false"
                    class="absolute -top-10 right-0 text-slate-300 hover:text-white text-2xl">✖</button>
            <img :src="activeSrc" class="w-full max-h-[75vh] object-contain rounded-2xl shadow-2xl">
            <p class="text-center text-slate-300 mt-4" x-text="activeCaption"></p>
        </div>
    </div>

</div>

</x-layout>