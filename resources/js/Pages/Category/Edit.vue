<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';

const props = defineProps({
    category: Object,
})

const form = useForm({
    catname: props.category.catname,
    code: props.category.code,
})

const submit = () => {
    form.patch(route('category.update', props.category.id))
}

const crumbs = [
    {
        name: "Dashboard",
        url: route('dashboard'),
    },
    {
        name: "Categories",
        url: route('category.index'),
    },
    {
        name: "Edit Category",
        url: null,
    },
]
</script>
<template>
    <Head :title="`Edit ${props.category.catname}`" />

    <AppLayout>
        <div class="w-full p-12">
            <Breadcrumb :crumbs="crumbs" class="mb-3" />
            <h1 class="text-2xl text-gray-700 font-bold mb-4">Edit Category</h1>

            <form @submit.prevent="submit" class="max-w-xl">
                <div class="mb-4">
                    <InputLabel for="catname" value="Category name" />
                    <TextInput v-model="form.catname" id="catname" class="w-full text-sm" />
                    <InputError :message="form.errors.catname" />
                </div>
                <div class="mb-4">
                    <InputLabel for="code" value="Code" />
                    <TextInput v-model="form.code" id="code" class="w-full text-sm" />
                    <InputError :message="form.errors.code" />
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-700 hover:bg-blue-600 text-sm text-white rounded-lg inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-1">
                    <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
                    </svg>
                    Save
                </button>
            </form>
        </div>
    </AppLayout>
</template>