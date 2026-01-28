<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import TreeItem from './TreeItem.vue';

const props = defineProps({
    categories: Array
});

const editCategory = (category) => {
    router.get(route('categories.edit', category.id));
};

const deleteCategory = (category) => {
    if (confirm(`Are you sure you want to delete "${category.name}"?`)) {
        router.delete(route('categories.destroy', category.id));
    }
};
</script>

<template>
    <AdminLayout>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Category Management</h1>
            <Link :href="route('categories.create')" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                + New Category
            </Link>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="p-6">
                <ul class="space-y-4">
                     <TreeItem 
                        v-for="category in categories" 
                        :key="category.id" 
                        :node="category"
                        @edit="editCategory"
                        @delete="deleteCategory" 
                     />
                </ul>
                
                <div v-if="categories.length === 0" class="text-center py-8 text-gray-500">
                    No categories found. Create one to get started.
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
