<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    catname: '',
    code: ''
})

const submit = () => {
    form.post(route('category.store'), {
        onSuccess: () => form.reset()
    })
}
</script>

<template>
    <div>
        <div v-show="form.errors.catname" class="rounded-lg p-2 bg-red-50 mb-3">
            <InputError :message="form.errors.catname" />
        </div>
        <form @submit.prevent="submit" class="flex items-center space-x-4 p-4 bg-white shadow-md rounded-lg">
            <div class="flex-1">
                <TextInput
                v-model="form.catname"
                id="new-category"
                type="text"
                class="w-full text-sm rounded-lg py-2"
                :class="{ 'border-red-700' : form.errors.catname }"
                placeholder="Category name"
                />
            </div>
            <div class="flex-1">
                <TextInput
                v-model="form.code"
                id="category-code"
                type="text"
                class="w-full text-sm rounded-lg py-2"
                :class="{ 'border-red-700' : form.errors.catname }"
                placeholder="Code"
                />
            </div>

            <button type="submit" @click="addNewCategory" class=" px-3 py-2 text-sm text-white font-medium rounded-md bg-blue-600 hover:bg-blue-500">
                Add Category   
            </button>
        </form>
    </div>
</template>