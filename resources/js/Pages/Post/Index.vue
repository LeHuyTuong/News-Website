<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, router } from '@inertiajs/vue3';

defineProps({
    posts: Object
});

const deletePost = (post) => {
    if (confirm(`Are you sure you want to delete "${post.title}"?`)) {
        console.log('Deleting post ID:', post.id);
        router.delete(route('posts.destroy', post.id), {
            onSuccess: () => console.log('Delete successful'),
            onError: (errors) => console.error('Delete failed', errors)
        });
    }
};
</script>

<template>
    <AdminLayout>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Posts Management</h1>
            <Link :href="route('posts.create')" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                + New Post
            </Link>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published At</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="post in posts.data" :key="post.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 truncate max-w-xs">{{ post.title }}</div>
                                <div class="text-xs text-gray-500">{{ post.slug }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ post.category ? post.category.name : 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ post.author ? post.author.name : 'Unknown' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span v-if="post.status === 'published'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Published
                                </span>
                                <span v-else-if="post.status === 'draft'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Draft
                                </span>
                                <span v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    {{ post.status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ new Date(post.published_at).toLocaleDateString() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <Link :href="route('posts.edit', post.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</Link>
                                <button @click="deletePost(post)" class="text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination (Simple implementation) -->
            <div v-if="posts.links && posts.links.length > 3" class="px-6 py-3 border-t border-gray-200 flex items-center justify-between">
                 <div class="flex-1 flex justify-between sm:hidden">
                    <Link :href="posts.prev_page_url" v-if="posts.prev_page_url" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </Link>
                    <Link :href="posts.next_page_url" v-if="posts.next_page_url" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </Link>
                  </div>
                  <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span class="font-medium">{{ posts.from }}</span> to <span class="font-medium">{{ posts.to }}</span> of <span class="font-medium">{{ posts.total }}</span> results
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
