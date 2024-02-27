<script setup>
import { ref } from "vue";

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
        <ul>
            <li v-for="category in categories" :key="category.id">
                <span @click="toggleCollapse(category.id)">
                {{ category.catname }}
                <i v-if="category.subcategories.length">
                    {{ collapsedCategories.includes(category.id) ? '+' : '-' }}
                </i>
                </span>
                <template v-if="!collapsedCategories.includes(category.id)">
                    <TreeView :categories="category.subcategories" />
                </template>
            </li>
        </ul>
    </div>
</template>