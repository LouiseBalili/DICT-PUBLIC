<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import AcquisitionItem from './components/AcquisitionItem.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    acquisitions: Array,
})

const form = useForm({
    name: ''
})

const submit = () => {
    form.post(route('acquisition.store'), {
        onSuccess: () => form.reset()
    })
}

</script>

<template>

    <Head title="Acquisition Types" />
    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <div>
                    <h1 class="text-2xl text-gray-700 font-bold">Acquisitions</h1>
                    <p class="text-gray-900 mb-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam ipsa ut sunt eveniet, libero nobis enim.</p>
                </div>
                <form @submit.prevent="submit" class="flex items-center space-x-3 max-w-2xl py-2">
                    <label for="new-acquisition" class="relative w-full">

                        <span class="absolute left-3 text-gray-400 top-1/2 -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path d="M5.566 4.657A4.505 4.505 0 0 1 6.75 4.5h10.5c.41 0 .806.055 1.183.157A3 3 0 0 0 15.75 3h-7.5a3 3 0 0 0-2.684 1.657ZM2.25 12a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3v-6ZM5.25 7.5c-.41 0-.806.055-1.184.157A3 3 0 0 1 6.75 6h10.5a3 3 0 0 1 2.683 1.657A4.505 4.505 0 0 0 18.75 7.5H5.25Z" />
                            </svg>
                        </span>

                        <TextInput
                        v-model="form.name"
                        id="new-acquisition"
                        class="w-full text-sm pl-8"
                        placeholder="Add new acquisition type.."

                        />
                    </label>

                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-sm text-white font-medium rounded-md">Create</button>
                </form>



                <div class="mt-1 border max-w-2xl rounded-lg shadow-sm bg-white">

                    <ul class="max-w-2xl divide-y divide-gray-200">
                        <li v-for="acquisition in acquisitions" :key="acquisition.id" class="pb-3 sm:pb-4 hover:bg-slate-100 pt-3 px-3">
                            <AcquisitionItem :acquisition="acquisition" />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
