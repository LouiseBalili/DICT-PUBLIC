<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    employee: Object
})

const form = useForm({
    _method: 'PUT',
    photo: null,
    fname: props.employee.fname, 
    mname: props.employee.mname, 
    lname: props.employee.lname,
    address: props.employee.address, 
    id_no: props.employee.id_no,
    emp_type: props.employee.emp_type, 
    status: props.employee.status,
    role: ''
})

const photoInput = ref(null)
const photoPreview = ref(null);

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
}

const submit = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }
    
    form.post(`/employees/update/${props.employee.id}`)
}
</script>

<template>
    <Head :title="`${props.employee.lname}, ${props.employee.fname}, ${props.employee.mname[0]}.`" />

    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <h1 class="text-2xl text-gray-700 font-bold mb-8">Edit employee details</h1>

                <form @submit.prevent="submit">
                    <div class="max-w-4xl w-full">
                        <div class="flex items-start space-x-3 mb-4">
                            <InputLabel for="id_no" value="ID no." class="shrink-0 w-[150px]" />

                            <div class="block w-full">
                                <TextInput
                                id="id_no"
                                v-model="form.id_no"
                                type="text"
                                maxlength="6"
                                class="w-full"
                                />
                                <InputError :message="form.errors.id_no" />
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 mb-4">
                            <InputLabel for="fname" value="First name" class="shrink-0 w-[150px]" />

                            <div class="block w-full">
                                <TextInput
                                id="fname"
                                v-model="form.fname"
                                type="text"
                                class="w-full "
                                />
                                <InputError :message="form.errors.fname" />
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 mb-4">
                            <InputLabel for="mname" value="Middle name" class="shrink-0 w-[150px]" />

                            <div class="block w-full">
                                <TextInput
                                id="mname"
                                v-model="form.mname"
                                type="text"
                                class="w-full "
                                />
                                <InputError :message="form.errors.mname" />
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 mb-4">
                            <InputLabel for="lname" value="Last name" class="shrink-0 w-[150px]" />

                            <div class="block w-full">
                                <TextInput
                                id="lname"
                                v-model="form.lname"
                                type="text"
                                class="w-full "
                                />
                                <InputError :message="form.errors.lname" />
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 mb-4">
                            <InputLabel for="address" value="Address" class="shrink-0 w-[150px]" />

                            <div class="block w-full">
                                <TextInput
                                id="address"
                                v-model="form.address"
                                type="text"
                                class="w-full "
                                autocomplete="address"
                                />
                                <InputError :message="form.errors.address" />
                            </div>
                        </div>

                        <div class="flex items-start space-x-3 mb-4">
                            <InputLabel for="emp_type" value="Employee Type" class="shrink-0 w-[150px]" />

                            <div class="block w-full">
                                <select v-model="form.emp_type" id="emp_type" class="w-full rounded-lg border-gray-300">
                                    <option value="">Select type</option>
                                    <option value="Plantilla">Plantilla</option>
                                    <option value="Contract of Service">Contract of Service</option>
                                </select>
                                <InputError :message="form.errors.emp_type" />
                            </div>
                        </div>

                        <div class="flex items-start space-x-3 mb-4">
                            <InputLabel for="status" value="Status" class="shrink-0 w-[150px]" />

                            <div class="block w-full">
                                <select v-model="form.status" id="status" class="w-full rounded-lg border-gray-300">
                                    <option value="">Select status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                                <InputError :message="form.errors.status" />
                            </div>
                        </div>

                        <div class="flex items-start space-x-3 mb-4">
                            <p class="shrink-0 w-[150px] text-sm font-medium text-gray-700">Role</p>

                            <div class="block w-full">
                                <div class="flex items-center space-x-4">
                                    <label for="admin">
                                        <input type="radio" v-model="form.role" name="role" value="Administrator" id="admin">
                                        Administrator
                                    </label>
                                    <label for="user">
                                        <input type="radio" v-model="form.role" name="role" value="User" id="user">
                                        User
                                    </label>
                                </div>
                                <InputError :message="form.errors.role" />
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3 mb-4">
                            <p class="shrink-0 w-[150px] text-sm font-medium text-gray-700">Profile photo</p>                        

                            <div>
                                <div class="flex items-center space-x-2">
                                    <label for="photo" class="inline-flex items-center px-4 py-2 rounded-lg border-gray-300 bg-gray-800 hover:bg-gray-700 text-white text-sm cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                        </svg>
                                        Change photo
                                        <input ref="photoInput" type="file" id="photo" class="hidden" @change="updatePhotoPreview">
                                    </label>

                                    <p class="text-xs text-gray-500">PNG, JPG or JPEG (1:1 aspect ratio recommended)</p>
                                </div>

                                <InputError :message="form.errors.photo" />

                                <div class="flex items-center justify-center bg-gray-200 mt-4 w-[300px] h-[300px] rounded-lg overflow-hidden relative">

                                    <!-- <button v-show="photoPreview" type="button" @click="photoPreview = null" class="absolute top-3 right-3 bg-gray-500 hover:bg-gray-400 p-2 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 stroke-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                    <svg v-show="!photoPreview" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>

                                    <img v-show="photoPreview" :src="photoPreview" alt="user-photo" class="object-cover h-full w-full"> -->
                                    <img v-if="props.employee.profile_photo_path && !photoPreview" :src="props.employee.profile_photo_path_url" alt="employee-photo" class="object-cover h-full w-full">

                                    <img v-else-if="photoPreview" :src="photoPreview" alt="employee-photo" class="object-cover h-full w-full">

                                    <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </div>

                                
                                
                            </div>
                        </div>

                        <button type="submit" class="px-4 py-2 text-white text-sm font-medium bg-blue-600 hover:bg-blue-500 rounded-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>