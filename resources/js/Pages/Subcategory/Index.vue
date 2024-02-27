<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage, router } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const props = defineProps({
    subcategories: Object,
})

const form = useForm({
    subcatname: ''
})

// const submit = () => {
//     form.post(`/categories/${props.category.id}/subcategories/new-subcategory`, {
//         onSuccess: () => form.reset()
//     })
// }

// // HANDLE FLASH MESSAGE
// const page = usePage();

// const clearErrorMessage = () => {
//     page.props.flash.error = null;
// }

// const clearSuccessMessage = () => {
//     page.props.flash.success = null;
// }

// // HANDLE DELETE
// const showModal = ref(false);
// const subcategoryToDelete = ref({})

// const deleteSubcategory = (subcategory) => {
//     showModal.value = true;
//     subcategoryToDelete.value = subcategory;
// }

// const closeModal = () => {
//     showModal.value = false;
// }

// const confirmDelete = () => {
//     router.delete(`/subcategories/${subcategoryToDelete.value.id}/delete`, {
//         onSuccess: () => closeModal()
//     })
// }
</script>

<template>
    <Head title="Subcategories" />

    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <h1 class="text-2xl text-gray-700 font-bold">Subcategories</h1>
                
            </div>
        </div>
    </AppLayout>

    <!-- Delete Modal -->
    <Modal :show="showModal" maxWidth="xl" @close="closeModal">
        <div class="p-4">
            <div class="flex space-x-3 mb-3">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-600">
                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h1 class="text-lg font-semibold text-red-600">Delete Confirmation</h1>
                    <p class="font-medium">Do you want to delete "{{ subcategoryToDelete.subcatname }}"?</p>
                </div>
                <div class="shrink-0">
                    <button type="button" @click="closeModal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" @click="closeModal" class="px-4 py-2 bg-gray-500 hover:bg-gray-400 rounded-lg text-white font-medium">Cancel</button>
                <button type="button" @click="confirmDelete" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-white font-medium">Confirm</button>
            </div>
        </div>
    </Modal>
</template>
