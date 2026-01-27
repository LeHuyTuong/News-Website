<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array
});

// Recursive Component for Tree Items
const TreeItem = {
    name: 'TreeItem',
    props: {
        node: Object
    },
    template: `
        <li class="py-2">
            <div class="flex items-center justify-between p-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                <div class="flex items-center">
                    <span class="mr-2 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                    </span>
                    <span class="font-medium text-gray-800">{{ node.name }}</span>
                    <span v-if="!node.is_active" class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                </div>
                <div class="flex space-x-2 text-sm">
                    <button @click="$emit('edit', node)" class="text-blue-600 hover:text-blue-900 cursor-pointer">Edit</button>
                    <button @click="$emit('delete', node)" class="text-red-600 hover:text-red-900 cursor-pointer">Delete</button>
                </div>
            </div>
            
            <ul v-if="node.children && node.children.length > 0" class="pl-6 mt-2 border-l-2 border-gray-200">
                <tree-item v-for="child in node.children" :key="child.id" :node="child"></tree-item>
            </ul>
        </li>
    `,
    components: {} // Will refer to itself recursively
};

// Fix circular reference for recursive component
TreeItem.components.TreeItem = TreeItem;

</script>

<template>
    <AdminLayout>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Category Management</h1>
            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                + New Category
            </button>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="p-6">
                <ul class="space-y-4">
                     <component :is="TreeItem" v-for="category in categories" :key="category.id" :node="category" />
                </ul>
                
                <div v-if="categories.length === 0" class="text-center py-8 text-gray-500">
                    No categories found. Create one to get started.
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
