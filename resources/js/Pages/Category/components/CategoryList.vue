<script setup>
import { ref } from "vue";
import SubcategoryList from "./SubcategoryList.vue";

const props = defineProps({
    categories: Array
})
const collapsedCategories = ref([]);

const toggleCollapse = (categoryId) => {
    const index = collapsedCategories.value.indexOf(categoryId);

    if (index === -1) {
    collapsedCategories.value.push(categoryId);
    } else {
    collapsedCategories.value.splice(index, 1);
    }
}

</script>

<template>
    <div>
        <ul class="space-y-2 text-sm w-full divide-y divide-gray-300">
            <li v-for="category in categories" :key="category.id">

                <div class="flex items-start space-x-3 hover:bg-gray-50 p-2 rounded-lg">
                    <div class="shrink-0">
                        <span @click="toggleCollapse(category.id)" class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" 
                                :class="{ 'rotate-90' : collapsedCategories.includes(category.id) }">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </span>
                    </div>

                    <span class="ml-4 text-gray-500">
                        {{ category.catname }} <span class="text-gray-700 font-semibold">#{{ category.code }}</span>
                    </span>
                </div>

                <template v-if="collapsedCategories.includes(category.id)">
                    <SubcategoryList :subcategories="category.subcategories" />
                </template>

                <!-- <div class="flex items-start">
                    <div class="shrink-0">
                        <span v-if="category.subcategories.length" @click="toggleCollapse(category.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" 
                                :class="{ 'rotate-90' : collapsedCategories.includes(category.id) }">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </span>
                    </div>

                    <div class="flex-1">
                        {{ category.catname }}

                            <SubcategoryList :subcategories="category.subcategories" />
                    </div>
                </div> -->
            </li>
        </ul>
    </div>
</template>