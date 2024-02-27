<template>
    <div class="relative overflow-hidden overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <slot name="table-head" />
        </thead>
        <tbody class="divide-y divide-y-200">
            <slot name="table-body" />
        </tbody>
    </table>
    </div>
</template>