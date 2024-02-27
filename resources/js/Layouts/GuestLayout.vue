<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-sky-600">
        <div>
            <Link href="/">
                <img src="https://dict.gov.ph/wp-content/uploads/2019/12/DICT-Banner-Logo-for-dark-background300px.png" class="w-75 h-30 mt-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
