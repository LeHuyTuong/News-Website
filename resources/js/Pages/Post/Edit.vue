<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';

const props = defineProps({
    post: Object,
    categories: Array
});

// Initialize form with existing data
// Note: We use POST method spoofing (_method: PUT) for file uploads to work
const form = useForm({
    _method: 'PUT',
    title: props.post.title,
    category_id: props.post.category_id,
    summary: props.post.summary || '',
    content: props.post.content,
    status: props.post.status,
    is_featured: Boolean(props.post.is_featured),
    thumbnail: null, // Only set if changing
});

const submit = () => {
    // We use POST with _method='PUT' because PHP cannot handle multipart/form-data in PUT requests
    form.post(route('posts.update', props.post.id));
};
</script>

<template>
    <Head title="Edit Post" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Post: {{ post.title }}</h2>
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

                             <!-- Content -->
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                                <textarea v-model="form.content" id="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required></textarea>
                                <div v-if="form.errors.content" class="text-red-500 text-sm mt-1">{{ form.errors.content }}</div>
                            </div>

                            <!-- Thumbnail -->
                            <div>
                                <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail Image (Leave empty to keep current)</label>
                                <input @input="form.thumbnail = $event.target.files[0]" type="file" id="thumbnail" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                
                                <div v-if="post.thumbnail" class="mt-2 text-sm text-gray-500">
                                    Current: <a :href="'/storage/' + post.thumbnail" target="_blank" class="text-blue-600 hover:underline">View Image</a>
                                </div>
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
                                    Update Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
