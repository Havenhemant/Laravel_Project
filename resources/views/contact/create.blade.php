<x-layout>

<h1 class="text-xl font-bold mb-4">Contact Us</h1>
<p class="text-slate-400 mb-4">Please Share Your Query, We will get back to you soon.</p>

<form method="POST" action="{{ route('contact.store') }}" class="space-y-3 max-w-md">
    @csrf

    <input name="title" placeholder="Subject" value="{{ old('title') }}"
           class="p-2 bg-gray-800 text-white w-full rounded">

    <textarea name="body" placeholder="Your message" rows="5"
              class="p-2 bg-gray-800 text-white w-full rounded">{{ old('body') }}</textarea>

    <button class="bg-green-600 px-4 py-2 text-white rounded">Send Query</button>
</form>

</x-layout>