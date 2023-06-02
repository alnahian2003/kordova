<script setup>
import StatusBadge from "@/Components/StatusBadge.vue";

const props = defineProps({ check: Object });
</script>

<template>
    <tr>
        <td
            class="whitespace-nowrap py-4 pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900"
        >
            {{ check.created_at.datetime }}
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <StatusBadge :check="check" />
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <template v-if="check.response_body"> View </template>

            <template v-else> - </template>
        </td>
    </tr>
</template>
