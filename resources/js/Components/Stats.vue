<script setup>
const props = defineProps({ stats: Object });
</script>
<template>
    <div class="mx-auto mb-8">
        <dl
            class="sm:rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-3 dark:bg-gray-800 divide-y-2"
        >
            <div
                class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r dark:border-gray-900"
            >
                <dt
                    class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 dark:text-gray-400"
                >
                    Sites
                </dt>
                <dd
                    class="order-1 text-4xl font-extrabold text-indigo-600 dark:text-indigo-400"
                >
                    {{ stats.totalSites }}
                </dd>
            </div>
            <div
                class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r dark:border-gray-900"
            >
                <dt
                    class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 dark:text-gray-400"
                >
                    Endpoints
                </dt>
                <dd
                    class="order-1 text-4xl font-extrabold text-indigo-600 dark:text-indigo-400"
                >
                    {{ stats.totalEndpoints }}
                </dd>
            </div>
            <div
                class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l dark:border-gray-900"
            >
                <dt
                    class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 dark:text-gray-400"
                >
                    Checks
                </dt>
                <dd
                    class="order-1 text-4xl font-extrabold text-indigo-600 dark:text-indigo-400"
                >
                    {{ stats.totalChecks }}
                </dd>
            </div>

            <div
                class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r dark:border-gray-900"
            >
                <dt
                    class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 dark:text-gray-400"
                >
                    Successful Checks
                </dt>
                <dd
                    class="order-1 text-4xl font-extrabold text-indigo-600 dark:text-indigo-400"
                >
                    {{ stats.successfulChecks }}
                </dd>
            </div>
            <div
                class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r dark:border-gray-900"
            >
                <dt
                    class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 dark:text-gray-400"
                >
                    Unsuccessful Checks
                </dt>
                <dd
                    class="order-1 text-4xl font-extrabold text-indigo-600 dark:text-indigo-400"
                >
                    {{ stats.unsuccessfulChecks }}
                </dd>
            </div>
            <div
                class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l dark:border-gray-900"
            >
                <dt
                    class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 dark:text-gray-400"
                >
                    Average Uptime
                </dt>
                <dd
                    class="order-1 text-4xl font-extrabold text-indigo-600 dark:text-indigo-400"
                >
                    {{ stats.averageUptimePercentage }}%
                </dd>
            </div>
        </dl>
    </div>
</template>
