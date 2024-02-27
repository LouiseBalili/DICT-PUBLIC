<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
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
                        <img src="https://th.bing.com/th/id/OIP.wE9wa_h6E-x64rPWmz8kgwAAAA?rs=1&pid=ImgDetMain" class="w-40 h-30 mt-20 mx-auto rounded fill-current text-gray-500" />
                    </Link>

                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit" class="px-2 py-4">
                        <div>
                            <h4 class="text-2xl font-bold">Sign in</h4>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password" value="Password" />

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="block mt-4">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ms-2 text-sm text-gray-600">Remember me</span>
                            </label>
                        </div>

                        <div class="block mt-4">
                            <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Login
                            </PrimaryButton>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <Link
                                :href="route('password.request')"
                                class="text-sm text-gray-600 hover:text-gray-900 hover:underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Forgot your password?
                            </Link>
                        </div>
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
