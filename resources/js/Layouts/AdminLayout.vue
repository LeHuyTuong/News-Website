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
                <Link href="/admin/categories" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-50 text-gray-700 hover:text-blue-600">
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
                <div class="flex items-center">
                    <button class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <div class="flex items-center">
                   <span class="text-gray-700 text-sm font-medium mr-4">Admin User</span>
                    <button class="bg-gray-100 p-2 rounded-full text-gray-500 hover:text-blue-600 transition">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
