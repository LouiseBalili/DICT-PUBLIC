<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    logoPath: String,
})

const form = useForm({
    username: '',
    password: ''
});

const submit = () => {
    form.post('/login', {
        onSuccess: () => form.reset()
    });
}

const isShown = ref(false);

const toggleShowPassword = () => {
    isShown.value = !isShown.value;
}
</script>

<template>
    <Head title="Log in" />

    <div class="login-left flex min-h-screen">
        <div class="w-1/2">
            <div class="h-screen flex items-center justify-center flex-col">
                <div class="wrapper">
                    <div class="mpbsff">
                        <ul class="dynamic-txts text-5xl text-white font bold">
                            <li><span>DICT BOHOL</span></li>
                            <li><span>INVENTORY SYSTEM</span></li>
                        </ul>
                    </div>
                </div>

                <img src="/images/login.png" alt="login-art" class="w-[400px] mt-20" />
            </div>
        </div>

        <div class="w-1/2 bg-white flex-col  ">
            <div class="max-w-md mx-auto mt-48">
                <Link href="/">
                    <img :src="logoPath" class="w-40 h-30 mt-20 mx-auto rounded fill-current text-gray-500" />
                </Link>

                <!-- <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div> -->

                <form @submit.prevent="submit" class="px-2 py-4">
                    <div>
                        <h4 class="text-2xl font-bold">Sign in</h4>
                    </div>

                    <div class="mt-4">
                        <!-- <InputLabel for="username" class="font-semibold" value="Username" /> -->

                        <div class="relative">

                            <span class="text-gray-400 absolute left-3 top-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                                </svg>                                  
                            </span>

                            <TextInput
                                id="username"
                                type="text"
                                class="mt-1 block w-full pl-9"
                                v-model="form.username"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Username"
                            />
                        </div>

                        <InputError class="mt-2" :message="form.errors.username" />
                    </div>

                    <div class="mt-4">
                        <!-- <InputLabel for="password" class="font-semibold" value="Password" /> -->

                        <div class="relative">


                            <span class="text-gray-400 absolute left-3 top-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M15.75 1.5a6.75 6.75 0 0 0-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 0 0-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 0 0 .75-.75v-1.5h1.5A.75.75 0 0 0 9 19.5V18h1.5a.75.75 0 0 0 .53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1 0 15.75 1.5Zm0 3a.75.75 0 0 0 0 1.5A2.25 2.25 0 0 1 18 8.25a.75.75 0 0 0 1.5 0 3.75 3.75 0 0 0-3.75-3.75Z" clip-rule="evenodd" />
                                </svg>                                  
                            </span>

                            <TextInput
                                id="password"
                                :type="isShown ? 'text' : 'password'"
                                class="mt-1 block w-full pl-9"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                placeholder="Password"
                            />

                            <!-- <span @click="toggleShowPassword" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-600 hover:text-gray-500">
                                <svg v-if="!isShown" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                </svg>

                                <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                    <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                    <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                                </svg>

                            </span> -->
                        </div>

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox name="show-password" v-model:checked="isShown" />
                            <span class="ms-2 text-sm text-gray-600 select-none">Show password</span>
                        </label>
                    </div>

                    <div class="block mt-4">
                        <button type="submit" class="w-full text-sm font-medium bg-[#087EC1] py-2.5 text-white rounded-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Sign in
                        </button>
                    </div>

                    <!-- <div class="flex items-center justify-end mt-4">
                        <Link
                            :href="route('password.request')"
                            class="text-sm text-gray-600 hover:text-gray-900 hover:underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Forgot your password?
                        </Link>
                    </div> -->
                </form>
            </div>

        </div>
    </div>
</template>

<style scoped>
.login-left {
    background-color: #087EC1;
}

.mpbsff {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    display:flex;
    align-items: center;
    justify-content: center;
}

.wrapper {
display: flex;
}

.wrapper .dynamic-txts {
    line-height: 90px;
    height: 90px;
    overflow: hidden;
}

.dynamic-txts li {
    list-style: none;
    color: #fff;
    position: relative;
    font-weight: 500;
    top: 0;
    position: relative;
    animation: slide 9s steps(2) infinite;
}

.dynamic-txts li {
    position: relative;
}

@keyframes slide {
    100% {
        top: -180px;
    }
}

.dynamic-txts li::after {
    content: "";
    position: absolute;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: #087EC1;
    border-left: 2px solid #fff;
    animation: typing 4.5s steps(15) infinite;
}

@keyframes typing {
    40%,
    60% {
        left: calc(100% + 30px);
    }
    100% {
        left: 0,
    }
}
</style>