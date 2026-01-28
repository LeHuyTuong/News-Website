<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    post: Object,
    categories: Array
});

// Helper to determine mode (edit vs create - though this file is specifically Create, re-using logic is good practice but kept simple here)
const form = useForm({
    title: '',
    category_id: '',
    summary: '',
    content: '',
    thumbnail: null,
    status: 'draft', // default
    is_featured: false
});

const submit = () => {
    form.post(route('posts.store'));
};
</script>

<template>
    <Head title="Create New Post" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Post</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                <input v-model="form.title" type="text" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</div>
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                                <select v-model="form.category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="" disabled>Select a category</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                                </select>
                                <div v-if="form.errors.category_id" class="text-red-500 text-sm mt-1">{{ form.errors.category_id }}</div>
                            </div>

                            <!-- Summary -->
                            <div>
                                <label for="summary" class="block text-sm font-medium text-gray-700">Summary</label>
                                <textarea v-model="form.summary" id="summary" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                                <div v-if="form.errors.summary" class="text-red-500 text-sm mt-1">{{ form.errors.summary }}</div>
                            </div>

                             <!-- Content (Simple Textarea for now, Rich Text Editor recommended later) -->
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                                <textarea v-model="form.content" id="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required></textarea>
                                <div v-if="form.errors.content" class="text-red-500 text-sm mt-1">{{ form.errors.content }}</div>
                            </div>

                            <!-- Thumbnail -->
                            <div>
                                <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail Image</label>
                                <input @input="form.thumbnail = $event.target.files[0]" type="file" id="thumbnail" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <div v-if="form.errors.thumbnail" class="text-red-500 text-sm mt-1">{{ form.errors.thumbnail }}</div>
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="mt-2 text-blue-500 w-full mb-2">
                                    {{ form.progress.percentage }}%
                                </progress>
                            </div>

                             <div class="grid grid-cols-2 gap-4">
                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select v-model="form.status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                        <option value="archived">Archived</option>
                                    </select>
                                </div>

                                <!-- Is Featured -->
                                <div class="flex items-center mt-6">
                                    <input v-model="form.is_featured" type="checkbox" id="is_featured" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="is_featured" class="ml-2 block text-sm text-gray-900">Featured Post</label>
                                </div>
                            </div>

                            <div class="flex items-center justify-end">
                                <Link :href="route('posts.index')" class="text-gray-600 hover:text-gray-900 mr-4">Cancel</Link>
                                <button type="submit" :disabled="form.processing" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50">
                                    Create Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
