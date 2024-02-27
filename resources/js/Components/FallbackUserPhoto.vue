<script setup>
import { computed } from 'vue';

const props = defineProps({
    firstname: String,
    lastname: String
})

const initials = computed(() => `${props.firstname[0]}${props.lastname[0]}`);
</script>

<template>
    <div class="rounded-full w-10 h-10 overflow-hidden">
        <div class="object-cover h-full w-full flex items-center justify-center bg-gray-200">
            <span class="text-md">{{ initials }}</span>
        </div>
    </div>
</template>

