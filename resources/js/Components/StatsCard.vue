<script setup>
const props = defineProps({ stats: Object });

const statsClasses =
    "sm:rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-3 dark:bg-gray-800 text-center";

function flexClasses(...args) {
    return ["flex", "flex-col", ...args, "dark:border-gray-900", "dark:hover:bg-gray-700 transition transition-color"].join(" ");
}
</script>

<template>
    <div class="mx-auto mb-8">
        <dl :class="statsClasses">
            <!-- Total Sites -->
            <div
                :class="
                    flexClasses(
                        'text-center',
                        'p-6',
                        'border-b',
                        'sm:border-r',
                        'sm:border-b'
                    )
                "
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

            <!-- Total Endpoints -->
            <div
                :class="
                    flexClasses(
                        'text-center',
                        'p-6',
                        'border-b',
                        'sm:border-r',
                        'sm:border-l'
                    )
                "
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

            <!-- Total Checks -->
            <div
                :class="
                    flexClasses(
                        'text-center',
                        'p-6',
                        'sm:border-l',
                        'sm:border-b'
                    )
                "
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

            <!-- Successful Checks -->
            <div
                :class="
                    flexClasses(
                        'text-center',
                        'p-6',
                        'border-t',
                        'sm:border-t',
                        'sm:border-r'
                    )
                "
            >
                <dt
                    class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 dark:text-gray-400"
                >
                    Successful Checks
                </dt>
                <dd
                    class="order-1 text-4xl font-extrabold text-green-600 dark:text-green-400"
                >
                    {{ stats.successfulChecks }}
                </dd>
            </div>

            <!-- Unsuccessful Checks -->
            <div
                :class="
                    flexClasses(
                        'text-center',
                        'p-6',
                        'border-t',
                        'sm:border-t',
                        'sm:border-r',
                        'sm:border-l'
                    )
                "
            >
                <dt
                    class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 dark:text-gray-400"
                >
                    Unsuccessful Checks
                </dt>
                <dd
                    class="order-1 text-4xl font-extrabold text-orange-600 dark:text-orange-400"
                >
                    {{ stats.unsuccessfulChecks }}
                </dd>
            </div>

            <!-- Average Uptime -->
            <div
                :class="
                    flexClasses(
                        'text-center',
                        'p-6',
                        'border-t',
                        'sm:border-t',
                        'sm:border-l'
                    )
                "
            >
                <dt
                    class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 dark:text-gray-400"
                >
                    Average Uptime
                </dt>
                <dd
                    class="order-1 text-4xl font-extrabold text-sky-600 dark:text-sky-400"
                >
                    {{ stats.averageUptimePercentage }}%
                </dd>
            </div>
        </dl>
    </div>
</template>
