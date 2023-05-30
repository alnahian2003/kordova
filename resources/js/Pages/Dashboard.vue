<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SiteSelector from "@/Components/SiteSelector.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import { Head, usePage } from "@inertiajs/vue3";

defineProps({
    site: Object,
    sites: Object,
});

const page = usePage();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    {{ site.data.domain }}
                </h2>

                <div><SiteSelector :sites="sites.data" /></div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        You're logged in and here's your site: {{ site.data }}
                    </div>
                </div> -->

                <h2 class="text-lg font-semibold text-gray-800 leading-tight">
                    New endpoint
                </h2>

                <form
                    class="flex gap-2 bg-white overflow-hidden shadow-sm sm:rounded-lg items-start p-3 mt-4 space-x-2"
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
                            placeholder="e.g. /about"
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
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-9 leading-none text-sm"
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
            </div>
        </div>
    </AuthenticatedLayout>
</template>
