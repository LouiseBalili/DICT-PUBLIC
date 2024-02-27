<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    subcategories: Array
})

const form = useForm({
    subcatname: '',
})

const submit = () => {
    form.post()
}

const showAddSubcategoryForm = ref(false)

const addNewSubcategory = () => {
    showAddSubcategoryForm.value = true;
}
</script>

<template>
    <div class="ml-4">
        <ul class="space-y-2 text-sm">
            <li v-for="item in subcategories" :key="item.id">
                <div class="flex items-start space-x-3 hover:bg-gray-50 p-2 rounded-lg">
                    <span class="ml-6">
                        {{ item.subcatname }}
                    </span>
                </div>
            </li>
        </ul>
    </div>
</template>