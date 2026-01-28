<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Overview</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Navigation Tabs / Quick Access -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                     <!-- News Management Tab -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition cursor-pointer group">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-3 rounded-full mr-4 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Manage News</h3>
                                <p class="text-sm text-gray-500">Create, edit, and publish articles.</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                             <Link :href="route('posts.index')" class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition">View All</Link>
                             <Link :href="route('posts.create')" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">+ New</Link>
                        </div>
                    </div>

                    <!-- Category Management Tab -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition cursor-pointer group">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-3 rounded-full mr-4 text-green-600 group-hover:bg-green-600 group-hover:text-white transition">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Manage Categories</h3>
                                <p class="text-sm text-gray-500">Organize content structure.</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                             <Link :href="route('categories.index')" class="px-4 py-2 text-sm font-medium text-green-600 bg-green-50 rounded-lg hover:bg-green-100 transition">View All</Link>
                             <Link :href="route('categories.create')" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition">+ New</Link>
                        </div>
                    </div>
                </div>

                <!-- Stats Overview (Optional Placeholder) -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4">Quick Stats</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <span class="block text-gray-500 text-xs uppercase font-bold">Total Posts</span>
                                <span class="block text-3xl font-black text-gray-800 mt-1">--</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <span class="block text-gray-500 text-xs uppercase font-bold">Published</span>
                                <span class="block text-3xl font-black text-blue-600 mt-1">--</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <span class="block text-gray-500 text-xs uppercase font-bold">Total Categories</span>
                                <span class="block text-3xl font-black text-green-600 mt-1">--</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AdminLayout>
</template>
