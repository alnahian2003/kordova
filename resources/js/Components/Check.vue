<script setup>
import StatusBadge from "@/Components/StatusBadge.vue";
import { ref } from "vue";
import { VueFinalModal } from "vue-final-modal";

const props = defineProps({ check: Object });

const ShowResponseBodyModal = ref(false);
</script>

<template>
    <tr class="bg-white dark:bg-gray-800">
        <td
            class="whitespace-nowrap py-4 pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900 dark:text-gray-100"
        >
            {{ check.created_at.datetime }}
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <StatusBadge :check="check" />
        </td>
        <td
            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-100 font-semibold"
        >
            <template v-if="check.response_body">
                <button @click="ShowResponseBodyModal = true">View</button>
            </template>

            <template v-else> - </template>
        </td>
    </tr>

    <VueFinalModal
        v-if="check.response_body"
        v-model="ShowResponseBodyModal"
        classes="flex justify-center items-center pt-16 mx-4 backdrop-blur"
        content-class="relative max-h-full rounded bg-white dark:bg-gray-800 dark:text-gray-100 w-full max-w-2xl p-4 md:p-6 space-y-4"
        overlay-class="bg-gradient-to-r from-gray-800 to-gray-500 opacity-50"
        :esc-to-close="true"
    >
        <h2
            class="font-semibold text-lg text-gray-800 dark:text-gray-100 leading-tight"
        >
            Response Body
        </h2>
        <textarea
            class="w-full block rounded border border-gray-300 outline-none dark:bg-gray-600 dark:text-gray-200"
            rows="10"
            :value="check.response_body"
            readonly
        ></textarea>
    </VueFinalModal>
</template>
