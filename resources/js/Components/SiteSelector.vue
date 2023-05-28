<script setup>
import { Link } from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { ref } from "vue";
import { VueFinalModal } from "vue-final-modal";

defineProps({
    sites: Array,
});

const ShowNewSiteModal = ref(false);
</script>
<template>
    <VDropdown :distance="16">
        <button
            class="flex flex-row items-center space-x-2 text-xs text-gray-500"
        >
            Select a site
            <svg
                class="ml-2 -mr-0.5 h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                ></path>
            </svg>
        </button>

        <template #popper="{ hide }">
            <ul class="divide-y dark:divide-gray-600 dark:bg-gray-700">
                <li v-for="site in sites">
                    <Link
                        class="px-4 py-2 block text-gray-500 dark:hover:bg-gray-800 dark:hover:text-gray-100 dark:text-gray-300 hover:bg-gray-100 hover:text-gray-700 text-sm"
                        :href="`/dashboard/${site.id}`"
                        >{{ site.domain }}</Link
                    >
                </li>
                <slot name="addSite">
                    <li>
                        <SecondaryButton
                            @click="
                                ShowNewSiteModal = true;
                                hide();
                            "
                            class="w-full justify-center px-4 border-t dark:border-t-gray-600 py-2 text-indigo-500 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-600 hover:text-gray-700 dark:hover:text-indigo-300 text-sm font-semibold text-center"
                            >Add a site</SecondaryButton
                        >
                    </li>
                </slot>
            </ul>
        </template>
    </VDropdown>

    <VueFinalModal
        v-model="ShowNewSiteModal"
        classes="flex justify-center items-center pt-16 md:pt-24 mx-4"
        content-class="relative max-h-full rounded bg-white w-full max-w-2xl p-4 md:p-6"
        overlay-class="bg-gradient-to-r from-gray-800 to-gray-500 opacity-50"
        :esc-to-close="true"
        >Hey</VueFinalModal
    >
</template>
