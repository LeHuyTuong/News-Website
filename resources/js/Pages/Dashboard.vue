<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
defineProps({
    message: String
});
</script>

<template>
    <AdminLayout>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-semibold text-gray-800 mb-4">Dashboard</h1>
                <p class="text-gray-600">{{ message }}</p>
            </div>
        </div>
    </AdminLayout>
</template>
