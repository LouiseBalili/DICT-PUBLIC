<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    properties: Array
})
</script>
<template>
    <Head title="All Properties" />
    <AppLayout>
        <div class="p-12 w-full">
            <h1 class="text-2xl text-gray-700 font-bold">Properties</h1>
            <p class="text-gray-900 mb-4">Add categories, then associate items to them from items page. You can add categories and subcategories as many as you like.</p>
        </div>
    </AppLayout>
</template>