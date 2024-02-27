<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    data: Object
});

const filteredLinks = computed(() => props.data.links.filter(link => !link.label.includes('Previous') && !link.label.includes('Next')));

const model = defineModel({
    type: Number,
    required: true,
});
</script>
<template>
    <div class="flex justify-center items-center">
        <div>
            <nav aria-label="Page navigation example">
                <ul class="list-style-none flex space-x-2">
                    <li>
                        <Link
                            class="h-10 w-10 rounded-full text-xs flex items-center justify-center bg-transparent text-neutral-600 transition-all duration-300 hover:bg-blue-500 hover:text-white"
                            :href="props.data.first_page_url"
                            aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </Link>
                    </li>
                    <li>
                        <Link
                            v-if="props.data.prev_page_url"
                            class="h-10 w-10 rounded-full text-xs flex items-center justify-center bg-transparent text-neutral-600 transition-all duration-300 hover:bg-blue-500 hover:text-white"
                            :href="props.data.prev_page_url"
                            aria-label="Previous">
                            <span aria-hidden="true">&lsaquo;</span>
                        </Link>

                        <span
                            v-else
                            class="h-10 w-10 rounded-full text-xs flex items-center justify-center bg-transparent text-neutral-600 transition-all duration-300 hover:bg-blue-500 hover:text-white"
                        >&lsaquo;</span>
                    </li>
                    <li v-for="link in filteredLinks" :key="link.label">
                        <Link
                            v-if="!link.active"
                            class="h-10 w-10 rounded-full text-xs flex items-center justify-center bg-transparent text-neutral-600 transition-all duration-300 hover:bg-blue-500 hover:text-white"
                            :href="link.url"
                            >{{ link.label }}</Link
                        >
                        <span
                        v-else
                        class="h-10 w-10 rounded-full text-xs flex items-center justify-center bg-blue-500 text-white cursor-not-allowed"
                        >{{ link.label }}</span>
                    </li>
                    <li>
                        <Link
                            v-if="props.data.next_page_url"
                            class="h-10 w-10 rounded-full text-xs flex items-center justify-center bg-transparent text-neutral-600 transition-all duration-300 hover:bg-blue-500 hover:text-white"
                            :href="props.data.next_page_url"
                            aria-label="Next"
                            ><span aria-hidden="true">&rsaquo;</span>
                        </Link>
                        <span
                        v-else
                        class="h-10 w-10 rounded-full text-xs flex items-center justify-center bg-transparent text-neutral-600 transition-all duration-300 hover:bg-blue-500 hover:text-white"
                        >&rsaquo;</span>
                    </li>
                    <li>
                        <Link
                            class="h-10 w-10 rounded-full text-xs flex items-center justify-center bg-transparent text-neutral-600 transition-all duration-300 hover:bg-blue-500 hover:text-white"
                            :href="props.data.last_page_url"
                            aria-label="Next"
                            ><span aria-hidden="true">&raquo;</span>
                        </Link>
                    </li>
                </ul>
            </nav>

            <span class="text-sm mt-2.5 text-neutral-600 whitespace-nowrap flex justify-center">
                {{ props.data.from }}-{{ props.data.to }} of {{ props.data.total }} entries
            </span>

        </div>

        <div class="flex items-start gap-x-2 ml-4">
            <input v-model="model" type="number" class="min-h-[38px] py-2 px-2.5 block w-12 border-gray-400 rounded-lg text-sm text-center focus:border-blue-500 focus:ring-blue-500 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" style="-moz-appearance: textfield;">
            <span class="text-sm px-3 py-1.5 text-neutral-600 whitespace-nowrap ">
            of {{ props.data.last_page }} pages
            </span>
        </div>
    </div>
</template>