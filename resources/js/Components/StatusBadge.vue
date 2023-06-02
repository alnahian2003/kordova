<script setup>
const props = defineProps({ check: Object });
</script>
<template>
    <span
        class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300"
        :class="{
            'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300':
                check.is_successful,
            'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300':
                !check.is_successful,
        }"
        >{{ check.response_code }} {{ check.status_text }}</span
    >
</template>
