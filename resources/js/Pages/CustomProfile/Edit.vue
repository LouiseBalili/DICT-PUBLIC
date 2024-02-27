<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import FallbackUserPhoto from '@/Components/FallbackUserPhoto.vue';
import WarningAlert from '@/Components/WarningAlert.vue';
import SuccessAlert from '@/Components/SuccessAlert.vue';
import { Head, useForm, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    userInfo: Object,
    credentials: Object
});

const form = useForm({
    _method: 'PATCH',
    fname: props.userInfo.fname,
    mname: props.userInfo.mname,
    lname: props.userInfo.lname,
    address: props.userInfo.address,
    photo: null,
});

const photoInput = ref(null);
const photoPreview = ref(null);
const photoValidationErrorMessage = ref('');

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {

    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
}

const deletePhoto = () => {
    router.delete('/user/profile/delete-photo', {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post('/user/profile', {
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

// HANDLING ALERT MESSAGE
const page = usePage();

const clearErrorMessage = () => {
    page.props.flash.error = null;
}

const clearSuccessMessage = () => {
    page.props.flash.success = null;
}
</script>

<template>
    <Head title="My Profile" />
    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <h1 class="text-2xl text-gray-700 font-bold">My Profile</h1>
                <p class="text-sm text-gray-500 mb-4">Update your photo and personal details here.</p>

                <!-- Warning Alert -->
                <WarningAlert v-if="page.props.flash.error" @close="clearErrorMessage" class="mb-4">
                    {{ page.props.flash.error }}
                </WarningAlert>

                <SuccessAlert v-if="page.props.flash.success" @close="clearSuccessMessage" class="mb-4">
                    {{ page.props.flash.success }}
                </SuccessAlert>

                <div class="flex-col divide-y divide-gray-300 mt-4 mb-4">
                    <div class="flex items-start space-x-4 p-4">
                        <div class="w-[300px]">
                            <h4 class="text-md font-semibold text-gray-700">Your Photo</h4>
                        </div>

                        <div class="w-[576px]">
                            <div class="flex items-center flex-col space-y-2 w-[200px]">
                                <div class="relative rounded-full w-[200px] h-[200px] overflow-hidden group">
                                    <img v-show="userInfo.profile_photo_path_url && !photoPreview" :src="userInfo.profile_photo_path_url" alt="user-photo" class="object-cover h-full w-full">

                                    <div v-show="!userInfo.profile_photo_path_url && !photoPreview" class="object-cover h-full w-full flex items-center justify-center bg-gray-200">
                                        <span class="text-5xl font-semibold text-gray-600">{{ `${ props.userInfo.fname[0] }${ $props.userInfo.lname[0] }` }}</span>
                                    </div>
                                    
                                    <img v-show="photoPreview" :src="photoPreview" alt="user-photo" class="object-cover h-full w-full">

                                    <input
                                    id="userphoto"
                                    ref="photoInput"
                                    type="file"
                                    class="hidden"
                                    @change="updatePhotoPreview"
                                    >
                                    <button type="button" @click="selectNewPhoto" class="absolute bottom-0 bg-gray-900 hover:bg-gray-700 text-white opacity-75 w-full h-0 group-hover:h-9 transition-[height]">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mx-auto">
                                            <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                                            <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>

                                <button v-show="userInfo.profile_photo_path_url" @click="deletePhoto" type="button" class="px-4 py-2 rounded-md bg-white text-gray-600 border text-xs font-medium uppercase tracking-wide inline-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                    Remove photo
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4">
                        <div class="w-[300px]">
                            <h4 class="text-md font-semibold text-gray-700">Employee Information</h4>
                        </div>
                        <div class="w-[576px]">

                            <div class="mb-4 w-full">
                                <InputLabel
                                for="id_no"
                                value="ID no"
                                class="font-medium text-md"
                                />

                                <TextInput
                                id="id_no"
                                type="text"
                                v-model="props.userInfo.id_no"
                                class="w-full"
                                disabled
                                />
                            </div>

                            <div class="mb-4 w-full">
                                <InputLabel
                                for="emp_type"
                                value="Employee Type"
                                class="font-medium text-md"
                                />

                                <TextInput
                                id="emp_type"
                                type="text"
                                v-model="props.userInfo.emp_type"
                                class="w-full"
                                disabled
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4 p-4">
                        <div class="w-[300px]">
                            <h4 class="text-md font-semibold text-gray-700">Personal Details</h4>
                        </div>
                        <div class="w-[576px]">

                            <div class="mb-4 w-full">
                                <InputLabel
                                for="fname"
                                value="First name"
                                class="font-medium text-md"
                                />

                                <TextInput
                                id="fname"
                                v-model="form.fname"
                                class="w-full"
                                />
                            </div>

                            <div class="mb-4 w-full">
                                <InputLabel
                                for="mname"
                                value="Middle name"
                                class="font-medium text-md"
                                />

                                <TextInput
                                id="mname"
                                v-model="form.mname"
                                class="w-full"
                                />
                            </div>

                            <div class="mb-4 w-full">
                                <InputLabel
                                for="lname"
                                value="Last name"
                                class="font-medium text-md"
                                />

                                <TextInput
                                id="lname"
                                v-model="form.lname"
                                class="w-full"
                                />
                            </div>

                            <div class="mb-4 w-full">
                                <InputLabel
                                for="address"
                                value="Address"
                                class="font-medium text-md"
                                />

                                <TextInput
                                id="address"
                                v-model="form.address"
                                class="w-full"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" @click.prevent="updateProfileInformation" class="px-4 py-2 rounded-md text-sm text-white font-medium bg-blue-600 hover:bg-blue-500">Save changes</button>
            </div>
        </div>
    </AppLayout>
</template>
