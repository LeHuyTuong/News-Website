@extends('news::layouts.master')

@section('description', $post->seo_description ?? Str::limit(strip_tags($post->content), 160))
@section('og_image', $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('images/default-share.jpg'))
@section('og_type', 'article')

@section('title', $post->seo_title ?? $post->title)

@section('content')
<div class="bg-white min-h-screen pb-20">
    
    <!-- Hero / Header -->
    <div class="relative w-full bg-gray-900">
         <div class="absolute inset-0 opacity-50">
             @if($post->thumbnail)
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
             @else
                <img src="https://placehold.co/1200x600?text={{ urlencode($post->title) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
             @endif
         </div>
         <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
         
         <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-12 sm:pt-48 sm:pb-20 text-center">
             <a href="{{ route('category.show', $post->category->slug) }}" class="inline-block px-3 py-1 mb-6 text-xs font-bold uppercase tracking-wider text-white bg-blue-600 rounded-full hover:bg-blue-500 transition">
                 {{ $post->category->name ?? 'News' }}
             </a>
             <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-6 drop-shadow-lg">
                 {{ $post->title }}
             </h1>
             <div class="flex items-center justify-center text-gray-300 text-sm md:text-base font-medium">
                 <div class="flex items-center mr-6">
                     <div class="h-8 w-8 rounded-full bg-gray-700 flex items-center justify-center text-white font-bold mr-2 border border-gray-600">
                         {{ substr($post->author->name ?? 'A', 0, 1) }}
                     </div>
                     {{ $post->author->name ?? 'Admin' }}
                 </div>
                 <div class="flex items-center">
                     <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                     {{ $post->published_at ? $post->published_at->format('F d, Y') : 'Draft' }}
                 </div>
             </div>
         </div>
    </div>

    <!-- Content Area -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-10">
        <article class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 md:p-12">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-sm text-gray-500 mb-8 pb-8 border-b border-gray-100">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
                <svg class="w-4 h-4 mx-2 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                <a href="{{ route('category.show', $post->category->slug) }}" class="hover:text-blue-600 transition">{{ $post->category->name }}</a>
                <svg class="w-4 h-4 mx-2 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                <span class="text-gray-900 font-medium truncate max-w-xs">{{ $post->title }}</span>
            </nav>

            <!-- Main Text -->
            <div class="prose prose-lg prose-blue max-w-none text-gray-800 leading-relaxed">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- Footer / Share / Tags -->
            <div class="mt-12 pt-8 border-t border-gray-100">
                 <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                     <div class="flex flex-wrap gap-2">
                         <span class="px-3 py-1 bg-gray-100 rounded-lg text-sm font-medium text-gray-600">#LatestNews</span>
                         <span class="px-3 py-1 bg-gray-100 rounded-lg text-sm font-medium text-gray-600">#{{ $post->category->slug }}</span>
                     </div>
                     
                     <div class="flex items-center space-x-3">
                         <span class="text-sm font-bold text-gray-400 uppercase tracking-wide">Share:</span>
                         <button class="p-2 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 transition">
                             <span class="sr-only">Facebook</span>
                             <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                         </button>
                         <button class="p-2 rounded-full bg-blue-400 text-white hover:bg-blue-500 transition">
                             <span class="sr-only">Twitter</span>
                             <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                         </button>
                     </div>
                 </div>
            </div>
        </article>
    </div>
</div>
@endsection
