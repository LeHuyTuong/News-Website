<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex h-screen bg-gray-100 font-sans">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-blue-600">News CMS</h1>
            </div>
            <nav class="mt-6 px-4">
                <Link href="/admin/dashboard" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                    Dashboard
                </Link>
                <div class="mt-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Content</div>
                <Link :href="route('categories.index')" :active="route().current('categories.*')" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                    Categories
                </Link>
                <Link href="/admin/posts" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                    Posts (News)
                </Link>
                
                <div class="mt-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">System</div>
                 <Link href="/admin/users" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                    Users & Roles
                </Link>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="flex justify-between items-center py-4 px-6 bg-white shadow-sm">
                <!-- ... existing header content ... -->
                <div class="flex items-center">
                    <button class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <div class="flex items-center space-x-4">
                    <Link :href="route('posts.create')" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        New Post
                    </Link>
                    
                    <Link :href="route('categories.create')" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                        New Category
                    </Link>

                    <div class="h-6 w-px bg-gray-300 mx-2"></div>

                   <span class="text-gray-700 text-sm font-medium mr-4">Admin User</span>
                    <button class="bg-gray-100 p-2 rounded-full text-gray-500 hover:text-blue-600 transition">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Flash Messages -->
            <!-- Flash Messages -->
            <div v-if="$page.props.flash?.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-6 mt-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ $page.props.flash.success }}</span>
            </div>
            <div v-if="$page.props.flash?.error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-6 mt-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $page.props.flash.error }}</span>
            </div>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
