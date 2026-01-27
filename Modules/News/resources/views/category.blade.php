@extends('layouts.frontend')

@section('title', $category->name)

@section('content')

    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <nav class="flex text-sm text-gray-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 font-bold">{{ $category->name }}</span>
            </nav>
            <h1 class="text-3xl font-bold text-gray-900">{{ $category->name }}</h1>
            @if($category->description)
                <p class="mt-2 text-gray-600">{{ $category->description }}</p>
            @endif
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="md:col-span-3">
                @if($posts->count() > 0)
                    <div class="space-y-8">
                        @foreach($posts as $post)
                        <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition">
                            <div class="md:w-1/3">
                                <a href="{{ route('news.show', $post->slug) }}" class="block w-full h-48 md:h-full">
                                    <img src="https://placehold.co/400x300?text={{ urlencode($post->title) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                                </a>
                            </div>
                            <div class="p-6 md:w-2/3 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-xl font-bold mb-2">
                                        <a href="{{ route('news.show', $post->slug) }}" class="hover:text-blue-600">{{ $post->title }}</a>
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                         {{ Str::limit(strip_tags($post->content), 150) }}
                                    </p>
                                </div>
                                <div class="flex items-center text-xs text-gray-500">
                                    <span>{{ $post->author->name ?? 'Admin' }}</span>
                                    <span class="mx-1">•</span>
                                    <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Just now' }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-10">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="py-12 text-center bg-gray-50 rounded-lg border border-gray-200 border-dashed">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No posts found</h3>
                        <p class="mt-1 text-sm text-gray-500">Check back later for updates in this category.</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="md:col-span-1 hidden md:block">
                 <div class="bg-white p-6 rounded shadow-sm border border-gray-200 sticky top-4">
                     <h4 class="font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">About {{ $category->name }}</h4>
                     <p class="text-sm text-gray-600 mb-4">
                         Explore the latest updates and insights in {{ $category->name }}. We bring you coverage on the most important topics.
                     </p>
                     
                     <!-- Subcategories could go here -->
                     @if($category->children && $category->children->count() > 0)
                     <h5 class="font-bold text-gray-700 mt-6 mb-2 text-xs uppercase">Topics</h5>
                     <ul class="space-y-2 text-sm">
                         @foreach($category->children as $child)
                             <li><a href="{{ route('category.show', $child->slug) }}" class="text-blue-600 hover:underline">{{ $child->name }}</a></li>
                         @endforeach
                     </ul>
                     @endif
                 </div>
            </div>
        </div>
    </div>

@endsection
