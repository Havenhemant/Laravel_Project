<x-layout>
    {{-- Background --}}
    <div class="relative min-h-screen bg-gray-50 overflow-hidden">

        {{-- Floating blurred blobs --}}
        <div class="absolute top-[-100px] left-[-100px] w-[300px] h-[300px] bg-purple-300 rounded-full blur-3xl opacity-30 animate-pulse"></div>
        <div class="absolute bottom-[-120px] right-[-120px] w-[350px] h-[350px] bg-blue-300 rounded-full blur-3xl opacity-30 animate-pulse"></div>

        <div class="relative max-w-6xl mx-auto px-6 py-16">

            {{-- Header --}}
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight">
                    Latest Posts
                </h1>
                <p class="text-gray-500 mt-3">
                    Explore modern Articles 
                </p>
            </div>

            {{-- Posts Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="api-posts-wrapper">

                @foreach ($posts as $post)
                    <div class="group relative">

                        {{-- Glow border effect --}}
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-500 to-blue-500 rounded-2xl blur opacity-20 group-hover:opacity-40 transition"></div>

                        {{-- Card --}}
                        <div class="relative bg-white/70 backdrop-blur-xl border border-white/40 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition duration-300 hover:-translate-y-2">

                            {{-- Title --}}
                            <h2 class="font-bold text-xl text-gray-900 mb-2 group-hover:text-purple-600 transition">
                                {{ $post->title }}
                            </h2>

                            {{-- Meta --}}
                            <div class="text-xs text-gray-500 mb-4 flex justify-between">
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                                <span class="font-semibold text-blue-600">
                                    {{ $post->user->username }}
                                </span>
                            </div>

                            {{-- Body --}}
                            <p class="text-sm text-gray-600 leading-relaxed">
                                {{ Str::words($post->body, 18) }}
                            </p>

                            {{-- Read more button --}}
                          

                        </div>
                    </div>
                @endforeach

            </div>

            {{-- Pagination --}}
            <div class="mt-12 flex justify-center">
                <div class="px-4 py-2 bg-white/70 backdrop-blur rounded-xl shadow">
                    {{ $posts->links() }}
                </div>
            </div>

        </div>
    </div>

    {{-- JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            console.log('Modern SaaS UI Loaded 🚀');

            async function checkApiConnection() {
                try {
                    const response = await fetch('/api/posts', {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();
                    console.log('API:', data);

                } catch (error) {
                    console.error('API failed:', error);
                }
            }

            checkApiConnection();

        });
    </script>
</x-layout>