<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Burndown
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 bg-white">
                <BurndownChart
                    :labels="chartLabels"
                    :from-date="$page.burndownData.fromDate"
                    :to-date="$page.burndownData.toDate"
                    :data="$page.burndownData.data"
                />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import BurndownChart from "@/Mixins/BurndownChart";

export default {
    components: {
        AppLayout,
        BurndownChart
    },
    computed: {
        chartLabels() {
            return Array.from(Array(60), (e,i)=>i+1);
        }
    }
}
</script>
