<script setup>
import { Link, router, usePage, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";

import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({ endpoint: Object });
const editing = ref(false);

const page = usePage();
const editForm = useForm({
    location: props.endpoint.location,
    frequency: props.endpoint.frequency_value,
});

// Native alternative to lodash.debounce
const debounce = (func, wait, immediate) => {
    let timeout;
    return function () {
        let context = this,
            args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        }, wait);
        if (immediate && !timeout) func.apply(context, args);
    };
};

watch(
    () => editForm.isDirty,
    () => {
        editEndpoint();
    }
);

const editEndpoint = debounce(() => {
    editForm.put(`/endpoints/${props.endpoint.id}`, {
        preserveScroll: true,
    });
}, 500);

const deleteEndpoint = () => {
    router.delete(`/endpoints/${props.endpoint.id}`, {
        preserveScroll: true,
        onBefore: () => {
            return confirm("are you sure, mate?");
        },
    });
};
</script>

<template>
    <tr>
        <td
            class="whitespace-nowrap pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900 w-64"
        >
            <template v-if="editing">
                <InputLabel
                    for="location"
                    value="Location"
                    class="sr-only my-2"
                />
                <TextInput
                    id="location"
                    class="block w-full border text-sm h-9"
                    type="text"
                    placeholder="e.g. /contact"
                    v-model="editForm.location"
                />
            </template>
            <template v-else>
                <Link href="/" class="text-indigo-500 hover:text-indigo-600">
                    {{ endpoint.location }}
                </Link>
            </template>
        </td>
        <td
            class="whitespace-nowrap px-3 text-sm text-gray-500 dark:text-gray-300 w-64"
        >
            <template v-if="editing">
                <InputLabel for="frequency" value="Frequency" class="sr-only" />
                <select
                    name="frequency"
                    id="frequency"
                    class="dark:bg-gray-800 dark:text-gray-100 dark:border-gray-700 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-9 leading-none text-sm"
                    v-model="editForm.frequency"
                >
                    <option
                        :value="frequency.frequency"
                        v-for="frequency in page.props.endpointFrequencies.data"
                    >
                        {{ frequency.label }}
                    </option>
                </select>
            </template>
            <template v-else>
                {{ endpoint.frequency_label }}
            </template>
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
            @click="editing = !editing"
            class="whitespace-nowrap pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-32"
        >
            <button class="text-indigo-500 hover:text-indigo-600">
                {{ editing ? "Done" : "Edit" }}
            </button>
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
