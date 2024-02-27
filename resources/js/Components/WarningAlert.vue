<script setup>
import { ref } from 'vue';

const isVisible = ref(true);

const emits = defineEmits(['close']);
</script>
<template>
    <div v-if="isVisible" class="flex p-4 space-x-3 rounded-lg bg-red-200">
        <div class="shrink-0">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-700">
                <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                </svg>
            </span>
        </div>
        <div class="flex-1">
            <h1 class="text-lg font-semibold text-red-700">Error</h1>
            <p class="text-red-700">
                <slot />
            </p>
        </div>
        <div class="shrink-0">
            <button type="button" @click="emits('close')" class="hover:bg-red-300 rounded-lg hover:text-red-700 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</template>