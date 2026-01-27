@extends('layouts.frontend')

@section('title', $post->seo_title ?? $post->title)

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
            <span class="mx-2">/</span>
            <span class="text-blue-600 font-medium">{{ $post->category->name ?? 'News' }}</span>
        </nav>

        <article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Hero Image -->
            <div class="h-64 sm:h-96 w-full bg-gray-200 relative">
                 <img src="https://placehold.co/800x400?text={{ urlencode($post->title) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                 <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/70 to-transparent p-6 sm:p-10">
                    <span class="inline-block px-3 py-1 bg-blue-600 text-white text-xs font-bold uppercase tracking-wider rounded-sm mb-3">
                        {{ $post->category->name ?? 'General' }}
                    </span>
                    <h1 class="text-3xl sm:text-4xl font-bold text-white leading-tight">
                        {{ $post->title }}
                    </h1>
                 </div>
            </div>

            <!-- Meta Data -->
            <div class="px-6 sm:px-10 py-6 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold text-xl">
                        {{ substr($post->author->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">
                            {{ $post->author->name ?? 'Admin' }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Just now' }}
                        </p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button class="text-gray-400 hover:text-blue-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                    </button>
                    <button class="text-gray-400 hover:text-blue-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 sm:px-10 py-10 prose prose-lg max-w-none text-gray-700">
                {!! nl2br(e($post->content)) !!}
            </div>
            
            <!-- Tags / Footer -->
            <div class="px-6 sm:px-10 py-6 bg-gray-50 border-t border-gray-100">
                 <h4 class="text-sm font-bold text-gray-700 uppercase mb-3">Tags</h4>
                 <div class="flex flex-wrap gap-2">
                     <span class="px-3 py-1 bg-white border border-gray-300 rounded-full text-xs text-gray-600 hover:bg-gray-100 transition cursor-pointer">#News</span>
                     <span class="px-3 py-1 bg-white border border-gray-300 rounded-full text-xs text-gray-600 hover:bg-gray-100 transition cursor-pointer">#{{ $post->category->slug ?? 'General' }}</span>
                 </div>
            </div>

        </article>
    </div>
</div>
@endsection
