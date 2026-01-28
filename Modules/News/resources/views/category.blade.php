@extends('news::layouts.master')

@section('description', $category->meta_description ?? $category->description ?? 'Tin tức mới nhất về ' . $category->name)

@section('title', $category->name)

@section('content')

    <!-- Category Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
             <div class="flex items-center text-sm text-gray-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
                <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                <span class="text-gray-900 font-medium">{{ $category->name }}</span>
            </div>
            <div class="flex items-end justify-between">
                <div>
                     <h1 class="text-3xl md:text-4xl font-black text-gray-900 mb-2">{{ $category->name }}</h1>
                     @if($category->description)
                        <p class="text-lg text-gray-600 max-w-2xl">{{ $category->description }}</p>
                     @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="md:col-span-3">
                @if($posts->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        @foreach($posts as $post)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 group flex flex-col h-full">
                            <a href="{{ route('news.show', $post->slug) }}" class="block h-52 overflow-hidden relative">
                                @if($post->thumbnail)
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <img src="https://placehold.co/600x400?text={{ urlencode($post->title) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @endif
                                <div class="absolute top-4 left-4">
                                   <span class="bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold px-2 py-1 rounded shadow-sm">
                                       {{ $post->category->name ?? $category->name }}
                                   </span>
                                </div>
                            </a>
                            <div class="p-5 flex flex-col flex-grow">
                                <h3 class="text-lg font-bold mb-2 leading-snug">
                                    <a href="{{ route('news.show', $post->slug) }}" class="text-gray-900 hover:text-blue-600 transition">{{ $post->title }}</a>
                                </h3>
                                <p class="text-gray-500 text-sm line-clamp-3 mb-4 flex-grow">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>
                                <div class="flex items-center justify-between border-t border-gray-50 pt-4 mt-auto">
                                     <div class="flex items-center text-xs text-gray-400 font-medium">
                                          <div class="h-6 w-6 rounded-full bg-gray-100 flex items-center justify-center mr-2 text-gray-500 font-bold">
                                              {{ substr($post->author->name ?? 'A', 0, 1) }}
                                          </div>
                                          {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Just now' }}
                                     </div>
                                     <a href="{{ route('news.show', $post->slug) }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 uppercase tracking-wide">Read</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-12">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="py-16 text-center bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                        <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h3 class="text-lg font-bold text-gray-900">No articles found</h3>
                        <p class="text-gray-500 mt-2 max-w-sm mx-auto">We couldn't find any articles in this category. Please check back later.</p>
                        <a href="{{ route('home') }}" class="inline-flex items-center mt-6 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Return Home
                        </a>
                    </div>
                @endif
            </div>

            <!-- Sidebar (Consistent with Home) -->
            <div class="md:col-span-1 hidden md:block space-y-8">
                 <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                     <h4 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wider border-b pb-2">Top in {{ $category->name }}</h4>
                     
                     <!-- Subcategories -->
                     @if($category->children && $category->children->count() > 0)
                     <div class="mb-6">
                        <ul class="space-y-2">
                             @foreach($category->children as $child)
                                 <li>
                                     <a href="{{ route('category.show', $child->slug) }}" class="flex items-center justify-between group">
                                         <span class="text-sm text-gray-600 group-hover:text-blue-600 transition">{{ $child->name }}</span>
                                         <span class="h-1.5 w-1.5 rounded-full bg-gray-200 group-hover:bg-blue-400 transition"></span>
                                     </a>
                                 </li>
                             @endforeach
                        </ul>
                     </div>
                     @endif

                     <!-- Promo/Ad Placeholder -->
                     <div class="bg-gray-50 rounded-lg p-4 text-center border border-gray-100">
                         <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1">Advertisement</span>
                         <div class="h-40 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-sm">
                             Ad Space
                         </div>
                     </div>
                 </div>
            </div>
        </div>
    </div>

@endsection
