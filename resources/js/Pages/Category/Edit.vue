<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    category: Object,
    categories: Array
});

const form = useForm({
    name: props.category.name,
    parent_id: props.category.parent_id,
    is_active: Boolean(props.category.is_active)
});

const submit = () => {
    form.put(route('categories.update', props.category.id));
};
</script>

<template>
    <Head title="Edit Category" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Category: {{ category.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                                <input v-model="form.name" type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required autofocus>
                                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                            </div>

                            <div>
                                <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Category</label>
                                <select v-model="form.parent_id" id="parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option :value="null">None (Top Level)</option>
                                    <option v-for="cat in categories" :key="cat.id" :value="cat.id" :disabled="cat.id === category.id">{{ cat.name }}</option>
                                </select>
                            </div>

                            <div class="flex items-center">
                                <input v-model="form.is_active" type="checkbox" id="is_active" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">Active</label>
                            </div>

                            <div class="flex items-center justify-end">
                                <Link :href="route('categories.index')" class="text-gray-600 hover:text-gray-900 mr-4">Cancel</Link>
                                <button type="submit" :disabled="form.processing" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50">
                                    Update Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
