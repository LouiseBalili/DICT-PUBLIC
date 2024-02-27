<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    office_name: '',
    location: '',
    classification: '',
})

const submit = () => {
    form.post(route('office.store'), {
        onSuccess: () => form.reset()
    })
}

const crumbs = [
    {
        name: "Dashboard",
        url: route('dashboard'),
    },
    {
        name: "Offices",
        url: route('office.index'),
    },
    {
        name: "Create office",
        url: null,
    },
];
</script>

<template>
    <Head title="New Office" />
    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <Breadcrumb :crumbs="crumbs" class="mb-3" />
                <h1 class="text-2xl text-gray-700 font-bold mb-4">Create new office</h1>
                <!-- <p class="text-sm text-gray-500 mb-4">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p> -->

                <form @submit.prevent="submit" class="w-full max-w-2xl">
                    <div class="mb-4">
                        <InputLabel for="office-name" value="Office name" />
                        <TextInput id="office-name" v-model="form.office_name" class="w-full text-sm" />
                        <InputError :message="form.errors.office_name" />
                    </div>

                    <div class="mb-4">
                        <InputLabel for="location" value="Location" />
                        <TextInput id="location" v-model="form.location" class="w-full text-sm" />
                        <InputError :message="form.errors.location" />
                    </div>

                    <div class="mb-4">
                        <InputLabel for="classification" value="Classification" />
                        <!-- <TextInput id="office-name" v-model="form.classification" class="w-full text-sm" /> -->
                        <select v-model="form.classification" id="classification" class="w-full text-sm rounded-lg border border-gray-300 shadow-sm">
                            <option value="">Select classification</option>
                            <option value="DICT-DTC">DICT-DTC</option>
                            <option value="Tech4ED Center">Tech4ED Center</option>
                        </select>
                        <InputError :message="form.errors.classification" />
                    </div>

                    <button type="submit" class="px-4 py-2 text-white text-sm font-medium bg-blue-600 hover:bg-blue-500 rounded-lg">Submit</button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>