<script setup>
import { Link, router } from "@inertiajs/vue3";

const props = defineProps({ endpoint: Object });

const deleteEndpoint = () => {
    router.delete(`/endpoints/${props.endpoint.id}`, {
        preserveScroll: true,
        onBefore: () => {
            return confirm("are you fucking sure, mate?");
        },
    });
};
</script>

<template>
    <tr>
        <td
            class="whitespace-nowrap pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900 w-64"
        >
            <Link href="/" class="text-indigo-500 hover:text-indigo-600">
                {{ endpoint.location }}
            </Link>
        </td>
        <td
            class="whitespace-nowrap px-3 text-sm text-gray-500 dark:text-gray-300 w-64"
        >
            {{ endpoint.frequency_label }}
        </td>
        <td
            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-300"
        >
            Last check
        </td>
        <td
            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-300"
        >
            Status
        </td>
        <td
            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-300"
        >
            x%
        </td>
        <td
            class="whitespace-nowrap pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-32"
        >
            <button class="text-indigo-500 hover:text-indigo-600">Edit</button>
        </td>
        <td
            class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-16"
        >
            <button
                @click="deleteEndpoint"
                class="text-red-500 hover:text-red-600"
            >
                Delete
            </button>
        </td>
    </tr>
</template>
