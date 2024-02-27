<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import WarningAlert from '@/Components/WarningAlert.vue';
import SuccessAlert from '@/Components/SuccessAlert.vue';
import { useForm, Head, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    current_password: '',
    new_password: '',
    new_password_confirmation: '',
});

const submit = () => {
    form.patch('/user/change-password', {
        onSuccess: () => form.reset(),
        onError: () => form.reset()
    });
}

const showCurrentPassword = ref(false);
const showNewCurrentPassword = ref(false);

const toggleShowCurrentPassword = () => {
    showCurrentPassword.value = !showCurrentPassword.value;
}
const toggleShowNewPassword = () => {
    showNewCurrentPassword.value = !showNewCurrentPassword.value;
}

// HANDLE FLASH MESSAGE
const page = usePage();

const closeSuccessAlert = () => {
    page.props.flash.success = null;
}
</script>

<template>
    <Head title="Change Password" />
    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <h1 class="text-2xl text-gray-700 font-bold">Change Password</h1>
                <p class="text-sm text-gray-500 mb-4">Ensure your account is using a long, random password to stay secure.</p>

                <SuccessAlert v-if="page.props.flash.success" @close="closeSuccessAlert" class="mb-4">{{ page.props.flash.success }}</SuccessAlert>

                <form @submit.prevent="submit">
                    <div class="max-w-2xl w-full">
                        <div class="w-full mb-4">
                            <InputLabel
                            for="current_password"
                            value="Current password"
                            />

                            <div class="relative">
                                <TextInput
                                id="current_password"
                                :type="showCurrentPassword ? 'text' : 'password'"
                                v-model="form.current_password"
                                class="mt-1 block w-full pr-10"
                                :class="{ 'border-red-600' : form.errors.current_password }"
                                autocomplete="current-password"

                                />
                                <span @click="toggleShowCurrentPassword" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-600 hover:text-gray-500">
                                    <svg v-if="!showCurrentPassword" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                    </svg>

                                    <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                        <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                        <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                        <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                                    </svg>

                                </span>
                            </div>

                            <InputError :message="form.errors.current_password" />
                        </div>
                        <div class="w-full mb-4">
                            <InputLabel
                            for="new_password"
                            value="New password"
                            />

                            <div class="relative">
                                <TextInput
                                id="new_password"
                                :type="showNewCurrentPassword ? 'text' : 'password'"
                                v-model="form.new_password"
                                class="mt-1 block w-full pr-10"
                                :class="{ 'border-red-600' : form.errors.new_password }"
                                autocomplete="new-password"

                                />
                                <span @click="toggleShowNewPassword" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-600 hover:text-gray-500">
                                    <svg v-if="!showNewCurrentPassword" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                    </svg>

                                    <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                        <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                        <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                        <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                                    </svg>

                                </span>
                            </div>

                            <InputError :message="form.errors.new_password" />
                        </div>
                        <div class="w-full mb-4">
                            <InputLabel
                            for="new_password_confirmation"
                            value="Confirm new password"
                            />

                            <TextInput
                            id="new_password_confirmation"
                            :type="showNewCurrentPassword ? 'text' : 'password'"
                            v-model="form.new_password_confirmation"
                            class="w-full"
                            />
                        </div>

                        <button type="submit" class="px-4 py-2 rounded-md text-white text-sm font-medium bg-blue-600 hover:bg-blue-500" :disabled="form.processing">
                            <svg v-if="form.processing" aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span v-else>Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>