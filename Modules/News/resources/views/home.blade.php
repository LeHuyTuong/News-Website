@extends('news::layouts.master')

@section('description', 'Trang tin tức tổng hợp, cập nhật tin tức kinh tế, xã hội nhanh nhất 24/7.')

@section('title', 'Home')

@section('content')

    <!-- Hero Section (First Featured Post) -->
    @if($featuredPosts->count() > 0)
        @php $heroPost = $featuredPosts->first(); @endphp
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="relative rounded-2xl overflow-hidden shadow-xl group">
                    <a href="{{ route('news.show', $heroPost->slug) }}" class="block relative h-96 md:h-[500px]">
                        @if($heroPost->thumbnail)
                            <img src="{{ asset('storage/' . $heroPost->thumbnail) }}" alt="{{ $heroPost->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @else
                            <img src="https://placehold.co/1200x600?text={{ urlencode($heroPost->title) }}" alt="{{ $heroPost->title }}" class="w-full h-full object-cover">
                        @endif
                        <div class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-black/90 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-8 md:p-12 w-full md:w-2/3">
                            <span class="inline-block px-3 py-1 mb-4 text-xs font-bold uppercase tracking-wider text-white bg-blue-600 rounded-full">
                                {{ $heroPost->category->name ?? 'Highlight' }}
                            </span>
                            <h1 class="text-3xl md:text-5xl font-black text-white leading-tight mb-4 drop-shadow-md">
                                {{ $heroPost->title }}
                            </h1>
                            <p class="text-gray-200 text-lg line-clamp-2 md:line-clamp-3 mb-6 hidden md:block">
                                {{ Str::limit(strip_tags($heroPost->content), 200) }}
                            </p>
                            <span class="text-gray-300 text-sm font-medium">
                                By {{ $heroPost->author->name ?? 'Admin' }} &bull; {{ $heroPost->published_at ? $heroPost->published_at->diffForHumans() : 'Just now' }}
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Secondary Featured (Grid) -->
    @if($featuredPosts->count() > 1)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 border-l-4 border-blue-600 pl-4">Featured Stories</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredPosts->skip(1) as $post)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 group">
                <a href="{{ route('news.show', $post->slug) }}" class="block h-48 overflow-hidden relative">
                     @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                     @else
                        <img src="https://placehold.co/600x400?text={{ urlencode($post->title) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                     @endif
                     <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold px-2 py-1 rounded shadow-sm">
                            {{ $post->category->name ?? 'News' }}
                        </span>
                     </div>
                </a>
                <div class="p-5">
                    <h3 class="text-lg font-bold mb-2 leading-snug">
                        <a href="{{ route('news.show', $post->slug) }}" class="text-gray-900 hover:text-blue-600 transition">{{ $post->title }}</a>
                    </h3>
                    <p class="text-gray-500 text-sm line-clamp-2 mb-4">
                        {{ Str::limit(strip_tags($post->content), 100) }}
                    </p>
                    <div class="flex items-center text-xs text-gray-400 font-medium">
                         {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Just now' }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Latest News Feed -->
    <div class="bg-gray-50 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center justify-between">
                        <span>Latest Updates</span>
                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-800">View All &rarr;</a>
                    </h2>
                    <div class="space-y-6">
                        @foreach($latestPosts as $post)
                        <div class="flex flex-col md:flex-row bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:border-blue-200 transition-colors">
                            <div class="md:w-1/3 h-48 md:h-auto relative">
                                <a href="{{ route('news.show', $post->slug) }}" class="block w-full h-full">
                                    @if($post->thumbnail)
                                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://placehold.co/400x300?text={{ urlencode($post->title) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                                    @endif
                                </a>
                            </div>
                            <div class="p-6 md:w-2/3 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center space-x-2 mb-2">
                                        <span class="text-xs font-bold text-blue-600 uppercase">{{ $post->category->name ?? 'General' }}</span>
                                        <span class="text-gray-300">&bullet;</span>
                                        <span class="text-xs text-gray-500">{{ $post->published_at ? $post->published_at->diffForHumans() : 'Just now' }}</span>
                                    </div>
                                    <h3 class="text-xl font-bold mb-2 text-gray-900">
                                        <a href="{{ route('news.show', $post->slug) }}" class="hover:text-blue-600 hover:underline decoration-2 underline-offset-2 transition-all">{{ $post->title }}</a>
                                    </h3>
                                    <p class="text-gray-600 text-sm line-clamp-2 leading-relaxed">
                                         {{ Str::limit(strip_tags($post->content), 160) }}
                                    </p>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="h-6 w-6 rounded-full bg-gray-200 flex items-center justify-center text-xs text-gray-500 font-bold overflow-hidden">
                                            {{ substr($post->author->name ?? 'A', 0, 1) }}
                                        </div>
                                        <span class="ml-2 text-xs font-medium text-gray-700">{{ $post->author->name ?? 'Admin' }}</span>
                                    </div>
                                    <a href="{{ route('news.show', $post->slug) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 inline-flex items-center bg-blue-50 px-3 py-1 rounded-full transition-colors hover:bg-blue-100">
                                        Read more <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-8">
                     <!-- Trending Widget -->
                     <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                         <h4 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wider border-b pb-2">Trending Topics</h4>
                         <ul class="space-y-3">
                             <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-600 transition group"><span class="w-6 h-6 rounded bg-gray-100 text-xs flex items-center justify-center mr-3 text-gray-500 group-hover:bg-blue-100 group-hover:text-blue-600">1</span> AI Revolution</a></li>
                             <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-600 transition group"><span class="w-6 h-6 rounded bg-gray-100 text-xs flex items-center justify-center mr-3 text-gray-500 group-hover:bg-blue-100 group-hover:text-blue-600">2</span> Crypto Market</a></li>
                             <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-600 transition group"><span class="w-6 h-6 rounded bg-gray-100 text-xs flex items-center justify-center mr-3 text-gray-500 group-hover:bg-blue-100 group-hover:text-blue-600">3</span> Global Economy</a></li>
                             <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-600 transition group"><span class="w-6 h-6 rounded bg-gray-100 text-xs flex items-center justify-center mr-3 text-gray-500 group-hover:bg-blue-100 group-hover:text-blue-600">4</span> Startup News</a></li>
                         </ul>
                     </div>

                     <!-- Newsletter Widget -->
                     <div class="bg-blue-600 p-6 rounded-xl shadow-lg runux-gradient text-white">
                         <h4 class="font-bold text-lg mb-2">Subscribe to News</h4>
                         <p class="text-blue-100 text-xs mb-4">Get the latest updates delivered straight to your inbox.</p>
                         <form class="space-y-2">
                             <input type="email" placeholder="Your email address" class="w-full px-3 py-2 rounded text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                             <button type="submit" class="w-full bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded text-sm transition shadow-md">Subscribe</button>
                         </form>
                     </div>
                </div>
            </div>
        </div>
    </div>

@endsection
