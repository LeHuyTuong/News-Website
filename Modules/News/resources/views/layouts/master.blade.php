<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title', config('app.name', 'Laravel News'))</title>

    <meta name="description" content="@yield('description', 'Trang tin tức tổng hợp cập nhật liên tục 24/7')">
    <link rel="canonical" href="@yield('canonical', url()->current())" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:title" content="@yield('title', config('app.name', 'Laravel News'))" />
    <meta property="og:description" content="@yield('description', 'Trang tin tức tổng hợp')" />
    <meta property="og:image" content="@yield('og_image', asset('images/default-share.jpg'))" />
    <meta property="og:url" content="{{ url()->current() }}" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', config('app.name', 'Laravel News'))">
    <meta name="twitter:description" content="@yield('description', 'Trang tin tức tổng hợp')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/default-share.jpg'))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-50 flex flex-col min-h-screen">
    <div id="app" class="flex-grow">
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="text-2xl font-black text-blue-700 tracking-tighter flex items-center">
                                <span class="bg-blue-600 text-white px-2 py-1 rounded mr-1 text-lg">L</span>aravel News
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-blue-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-base font-semibold transition duration-150 ease-in-out">
                                Home
                            </a>
                            
                            @foreach($menuCategories as $category)
                                <a href="{{ route('category.show', $category->slug) }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('category/'.$category->slug) ? 'border-blue-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Search / Action (Optional) -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="relative">
                            <input type="text" placeholder="Search..." class="bg-gray-100 rounded-full px-4 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-48 transition-all">
                             <svg class="h-4 w-4 absolute right-3 top-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div id="mobile-menu" class="hidden sm:hidden border-t border-gray-100 bg-white">
                <div class="pt-2 pb-3 space-y-1 shadow-inner">
                    <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">
                        Home
                    </a>
                    @foreach($menuCategories as $category)
                         <a href="{{ route('category.show', $category->slug) }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->is('category/'.$category->slug) ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

    <footer class="bg-gray-900 border-t border-gray-800 text-white mt-auto">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-2">
                 <h2 class="text-2xl font-bold mb-4 flex items-center">
                    <span class="bg-blue-600 text-white px-2 py-1 rounded mr-2 text-lg">L</span>aravel News
                 </h2>
                 <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                     Trang tin tức công nghệ, tài chính và đời sống hàng đầu. Cập nhật liên tục 24/7 với những thông tin chính xác và nóng hổi nhất.
                 </p>
            </div>
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 mb-4">Danh mục</h3>
                <ul class="space-y-3">
                    @foreach($menuCategories->take(4) as $category)
                        <li><a href="{{ route('category.show', $category->slug) }}" class="text-gray-300 hover:text-white transition">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                 <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 mb-4">Liên hệ</h3>
                 <ul class="space-y-3 text-sm text-gray-300">
                     <li>Email: contact@tuongdev.com</li>
                     <li>Phone: +84 999 999 999</li>
                     <li>Address: Hanoi, Vietnam</li>
                 </ul>
            </div>
        </div>
        <div class="bg-gray-950 py-4">
             <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-xs text-gray-500">
                 &copy; {{ date('Y') }} Laravel News. All rights reserved. Designed with ❤️.
             </div>
        </div>
    </footer>
</body>
