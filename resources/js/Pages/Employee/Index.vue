<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import Tooltip from '@/Components/Tooltip.vue';
import FallbackUserPhoto from '@/Components/FallbackUserPhoto.vue';
import Pagination from '@/Components/Pagination.vue';
import SuccessAlert from '@/Components/SuccessAlert.vue';
import WarningAlert from '@/Components/WarningAlert.vue';
import { ref } from 'vue';

const props = defineProps({
    employees: Object
})

const page = usePage();

const closeWarningAlert = () => {
    page.props.flash.error = null;
}

const closeSuccessAlert = () => {
    page.props.flash.success = null;
}

const perPage = ref(4);
</script>

<template>
    <Head title="Employees" />
    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl text-gray-700 font-bold">Manage Employees</h1>
                        <p class="text-sm text-gray-500 mb-4">Ensure your account is using a long, random password to stay secure.</p>
                    </div>

                    <Link href="/employees/create" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-sm text-white font-medium rounded-md">Add Employee</Link>
                </div>

                <WarningAlert v-if="page.props.flash.error" @close="closeWarningAlert" class="mb-4">{{ page.props.flash.error }}</WarningAlert>
    
                <SuccessAlert v-if="page.props.flash.success" @close="closeSuccessAlert" class="mb-4">{{ page.props.flash.success }}</SuccessAlert>

                <div class="relative overflow-hidden overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID NO
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="emp in employees.data" :key="emp.id" class="bg-white hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ emp.id_no }}
                                </th>
                                <td class="px-6 py-4 flex items-center">
                                    <div v-show="emp.profile_photo_path" class="rounded-full w-10 h-10 overflow-hidden">
                                        <img :src="emp.profile_photo_path_url" class="object-cover h-full w-full" alt="profile pic">
                                    </div>
                                    <FallbackUserPhoto v-show="!emp.profile_photo_path" :firstname="emp.fname" :lastname="emp.lname" />
                                    <!-- <img v-show="emp.profile_photo_path" :src="emp.profile_photo_path_url" class="rounded-full w-14 h-14" alt="profile pic">
                                    <img v-show="!emp.profile_photo_path" src="https://i.mydramalist.com/QJ082Y_5c.jpg" class="rounded-full w-14 h-14" alt="profile pic"> -->
                                    <!-- <p class="flex items-center justify-center ms-6"></p> -->

                                    <!-- <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image"> -->
                                    <div class="ps-3">
                                        <div class="text-base font-medium text-gray-700">{{ `${emp.fname} ${emp.mname[0]}. ${emp.lname}` }}</div>
                                        <div class="font-normal text-gray-500">{{ emp.emp_type }}</div>
                                    </div> 
                                </td>
                                <td class="px-6 py-4">
                                    {{ emp.address }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ emp.status }}
                                </td>
                                <td class="px-6 py-4">
                                    Administrator
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <Link id="edit-button" :href="`/employees/edit/${emp.id}`" data-tool-tip="Edit" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </Link>
                                        <Link id="delete-button" :href="route('employee.destroy', emp.id)" method="DELETE" as="button" data-tool-tip="Delete" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <Pagination class="mt-4" :data="employees" v-model="perPage" />
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
#edit-button[data-tool-tip] {
    position: relative;
}

#edit-button[data-tool-tip]::before {
    content: attr(data-tool-tip);
    display: block;
    position: absolute;
    background-color: #374151;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: .8em;
    bottom: 100%;
    left: 50%;
    white-space: nowrap;
    transform: scale(0);
    transition: transform ease-out 150ms;
}

#edit-button[data-tool-tip]:hover::before {
    transform: scale(1);
}

#delete-button[data-tool-tip] {
    position: relative;
}

#delete-button[data-tool-tip]::before {
    content: attr(data-tool-tip);
    display: block;
    position: absolute;
    background-color: #374151;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: .8em;
    bottom: 100%;
    left: 50%;
    white-space: nowrap;
    transform: scale(0);
    transition: transform ease-out 150ms;
}

#delete-button[data-tool-tip]:hover::before {
    transform: scale(1);
}
</style>