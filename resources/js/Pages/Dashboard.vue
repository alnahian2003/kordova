<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Endpoint from "@/Components/Endpoint.vue";
import SiteSelector from "@/Components/SiteSelector.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import StatsCard from "@/Components/StatsCard.vue";

import { Head, usePage, useForm, router } from "@inertiajs/vue3";

const props = defineProps({
    site: Object,
    sites: Object,
    endpoints: Object,
    stats: Object,
});

const page = usePage();

const endpointForm = useForm({
    location: "",
    frequency: page.props.endpointFrequencies.data[0].frequency,
});

const storeEndpoint = () => {
    endpointForm.post(`/sites/${props.site.data.id}/endpoints`, {
        preserveScroll: true,
        onSuccess: () => {
            endpointForm.reset();
        },
    });
};

const deleteSite = () => {
    router.delete(`/sites/${props.site.data.id}`, {
        onBefore: () => {
            return confirm("Oh, really?");
        },
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    {{ site?.data.domain }}
                </h2>
                <div><SiteSelector :sites="props.sites.data" /></div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <template v-if="!site">
                    <h3 class="text-lg font-semibold text-gray-400 text-center">
                        No sites to show yet. Add a new site to monitor!
                    </h3>
                </template>

                <template v-else>
                    <StatsCard :stats="stats" />
                    <h2
                        class="text-lg font-semibold text-gray-700 dark:text-gray-300 leading-tight"
                    >
                        New endpoint
                    </h2>

                    <form
                        @submit.prevent="storeEndpoint"
                        class="flex bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg items-start p-3 mt-4 space-x-2"
                    >
                        <div class="grow">
                            <InputLabel
                                for="location"
                                value="Location"
                                class="sr-only"
                            />
                            <TextInput
                                id="location"
                                class="block w-full border text-sm h-9"
                                type="text"
                                placeholder="e.g. /about, /playground, /contact"
                                v-model="endpointForm.location"
                            />
                            <InputError
                                class="mt-2"
                                :message="endpointForm.errors.location"
                            />
                        </div>
                        <div>
                            <InputLabel
                                for="frequency"
                                value="Frequency"
                                class="sr-only"
                            />
                            <select
                                name="frequency"
                                id="frequency"
                                class="dark:bg-gray-800 dark:text-gray-100 dark:border-gray-700 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-9 leading-none text-sm"
                                v-model="endpointForm.frequency"
                            >
                                <option
                                    :value="frequency.frequency"
                                    v-for="frequency in page.props
                                        .endpointFrequencies.data"
                                >
                                    {{ frequency.label }}
                                </option>
                            </select>
                        </div>

                        <PrimaryButton>Add</PrimaryButton>
                    </form>

                    <!-- List of currently monitoring sites -->
                    <div class="mt-8 flex flex-col">
                        <h2
                            class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight"
                        >
                            Currently monitoring ({{ endpoints.data.length }})
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
                                        class="min-w-full table-fixed divide-y divide-gray-300 dark:divide-gray-600"
                                    >
                                        <thead
                                            class="bg-gray-50 dark:bg-gray-600"
                                        >
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="min-w-[12rem] pl-4 py-3.5 px-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-200 sm:pl-6"
                                                >
                                                    Location
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-300"
                                                >
                                                    Frequency
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-300"
                                                >
                                                    Last check
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-300"
                                                >
                                                    Last status
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-300"
                                                >
                                                    Uptime
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                                >
                                                    <span class="sr-only"
                                                        >Edit</span
                                                    >
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                                >
                                                    <span class="sr-only"
                                                        >Delete</span
                                                    >
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800 dark:text-gray-200"
                                        >
                                            <Endpoint
                                                v-for="endpoint in endpoints.data"
                                                :endpoint="endpoint"
                                            />
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <DangerButton @click="deleteSite"
                            >Delete Site</DangerButton
                        >
                    </div>
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
