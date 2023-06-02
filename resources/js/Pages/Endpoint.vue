<script setup>
import { Head, Link } from "@inertiajs/vue3";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SiteSelector from "@/Components/SiteSelector.vue";
import Check from "@/Components/Check.vue";

const props = defineProps({
    endpoint: Object,
    sites: Object,
});
</script>

<template>
    <Head :title="endpoint.data.url" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between gap-2">
                <!-- Go to back -->
                <Link
                    :href="`/dashboard/${endpoint.data.site.id}`"
                    class="text-gray-500 hover:text-gray-700"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 19.5L8.25 12l7.5-7.5"
                        />
                    </svg>
                </Link>
                <h2
                    class="font-semibold text-xl text-gray-8700 leading-tight overflow-hidden"
                >
                    <a
                        class="text-indigo-600 dark:text-indigo-500"
                        :href="endpoint.data.url"
                        target="_blank"
                        >{{ endpoint.data.url }}</a
                    >
                </h2>
                <div><SiteSelector :sites="sites.data" /></div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <template v-if="!endpoint?.data.checks.length">
                        <h3
                            class="text-gray-600 font-semibold text-base text-center"
                        >
                            We haven't done any checks yet, but feel free to
                            come back later.
                        </h3>
                    </template>

                    <template v-else>
                        <h2
                            class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight"
                        >
                            Checks
                        </h2>

                        <div
                            class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 mt-3"
                        >
                            <div
                                class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                            >
                                <div
                                    class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                                >
                                    <table
                                        class="min-w-full table-auto divide-y divide-gray-300"
                                    >
                                        <thead
                                            class="bg-gray-50 dark:bg-gray-600"
                                        >
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="min-w-[12rem] pl-4 py-3.5 px-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-50 sm:pl-6"
                                                >
                                                    Checked at
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-50"
                                                >
                                                    Response code
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-50"
                                                >
                                                    Response body
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-700"
                                        >
                                            <Check
                                                v-for="check in endpoint.data
                                                    .checks"
                                                :check="check"
                                            />
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
