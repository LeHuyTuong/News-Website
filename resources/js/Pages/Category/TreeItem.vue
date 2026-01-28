<script setup>
import { Link } from '@inertiajs/vue3';
import TreeItem from './TreeItem.vue';

const props = defineProps({
    node: Object
});

const emit = defineEmits(['edit', 'delete']);

defineOptions({
  name: 'TreeItem'
});

</script>

<template>
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
            <TreeItem 
                v-for="child in node.children" 
                :key="child.id" 
                :node="child"
                @edit="$emit('edit', $event)"
                @delete="$emit('delete', $event)"
            ></TreeItem>
        </ul>
    </li>
</template>
