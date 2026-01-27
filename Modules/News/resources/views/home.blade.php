@extends('layouts.frontend')

@section('title', 'Home')

@section('content')

    <!-- Featured Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Featured News</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredPosts as $post)
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                    <a href="{{ route('news.show', $post->slug) }}" class="block h-48 bg-gray-200 w-full relative group">
                         <!-- Placeholder for image -->
                         <img src="https://placehold.co/600x400?text={{ urlencode($post->title) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </a>
                    <div class="p-6">
                        <span class="text-xs font-semibold uppercase tracking-wider text-blue-600 mb-2 block">
                            {{ $post->category->name ?? 'News' }}
                        </span>
                        <h3 class="text-xl font-bold mb-2">
                            <a href="{{ route('news.show', $post->slug) }}" class="hover:text-blue-600 transition">{{ $post->title }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                            {{ Str::limit(strip_tags($post->content), 100) }}
                        </p>
                        <div class="flex items-center text-xs text-gray-500">
                             <span>{{ $post->author->name ?? 'Admin' }}</span>
                             <span class="mx-1">•</span>
                             <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Just now' }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Latest News -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Latest Updates</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Sidebar / Ads -->
                <div class="md:col-span-1 hidden md:block">
                     <div class="bg-white p-4 rounded shadow-sm border border-gray-200">
                         <h4 class="font-bold text-gray-700 mb-2">Trending</h4>
                         <ul class="space-y-2 text-sm text-blue-600">
                             <li><a href="#">Market Updates</a></li>
                             <li><a href="#">Technology Trends</a></li>
                             <li><a href="#">Global Politics</a></li>
                         </ul>
                     </div>
                </div>

                <!-- Main Feed -->
                <div class="md:col-span-3 space-y-6">
                    @foreach($latestPosts as $post)
                    <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                        <div class="md:w-1/3">
                            <a href="{{ route('news.show', $post->slug) }}" class="block w-full h-full">
                                <img src="https://placehold.co/400x300?text={{ urlencode($post->title) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                            </a>
                        </div>
                        <div class="p-6 md:w-2/3 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold mb-2">
                                    <a href="{{ route('news.show', $post->slug) }}" class="hover:text-blue-600">{{ $post->title }}</a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                     {{ Str::limit(strip_tags($post->content), 150) }}
                                </p>
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $post->published_at ? $post->published_at->diffForHumans() : 'Just now' }} in 
                                <span class="font-medium text-gray-800">{{ $post->category->name ?? 'General' }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
