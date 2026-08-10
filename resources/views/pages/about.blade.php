<x-layout>


<div class="relative overflow-hidden rounded-3xl mb-14 bg-gradient-to-br from-slate-900 to-slate-800 border border-slate-800">
    <div class="absolute -top-10 -right-10 text-8xl opacity-10 rotate-12 select-none">🍌</div>
    <div class="relative px-6 py-14 md:px-14 text-center">
        <span class="inline-block text-xs md:text-sm font-semibold tracking-widest uppercase bg-amber-500/10 text-amber-400 px-3 py-1 rounded-full mb-4">
            About Us
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold mb-4">Blended With Love, Served With a Smile</h1>
        <p class="text-slate-400 max-w-2xl mx-auto md:text-lg">
            We started with one simple idea: shakes should be thick, fresh, and made with real ingredients —
            no shortcuts, just good vibes in a cup.
        </p>
    </div>
</div>


<div class="grid md:grid-cols-2 gap-10 items-center mb-16">
    <div>
        <h2 class="text-2xl font-bold mb-4">Our Story</h2>
        <p class="text-slate-400 mb-4 leading-relaxed">
            What began as a small counter serving one signature banana shake has grown into a full menu of
            hand-blended creations. Every cup is made to order, layered with toppings, and finished with a smile —
            because a good shake is about the whole experience, not just the drink.
        </p>
        <p class="text-slate-400 leading-relaxed">
            We're picky about our ingredients, proud of our recipes, and always looking for the next flavor
            worth obsessing over.
        </p>
    </div>
    <div class="rounded-2xl overflow-hidden border border-slate-800 shadow-xl">
        <img src="{{ asset('img/p1.jpeg') }}" alt="Our shakes" class="w-full h-72 object-cover">
    </div>
</div>


<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-16">
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 text-center">
        <div class="text-4xl mb-3">⚡</div>
        <h3 class="font-semibold mb-1">Real Ingredients</h3>
        <p class="text-sm text-slate-400">Fresh fruit, quality dairy, zero shortcuts.</p>
    </div>
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 text-center">
        <div class="text-4xl mb-3">⚡</div>
        <h3 class="font-semibold mb-1">Made Fresh Daily</h3>
        <p class="text-sm text-slate-400">Blended to order, every single time.</p>
    </div>
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 text-center">
        <div class="text-4xl mb-3">⚡</div>
        <h3 class="font-semibold mb-1">Made With Care</h3>
        <p class="text-sm text-slate-400">Small team, big passion for great shakes.</p>
    </div>
</div>


<div class="text-center bg-gradient-to-br from-amber-500 to-orange-600 rounded-3xl py-12 px-6">
    <h2 class="text-2xl md:text-3xl font-extrabold text-slate-950 mb-3">Ready to Try One?</h2>
    <p class="text-slate-900/80 mb-6">Browse our menu and find your new favorite shake.</p>
    <a href="{{ route('products.index') }}"
       class="inline-block bg-slate-950 hover:bg-slate-800 text-white font-semibold px-6 py-3 rounded-xl transition">
        Shop Shakes
    </a>
</div>

</x-layout>
