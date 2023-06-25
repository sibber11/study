<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head as CustomHead} from '@inertiajs/vue3';
import Card from "@/Components/Card.vue";
import Filter from "@/Components/Filter.vue";

let props = defineProps(['questions_count', 'semesters'])

</script>

<template>
    <CustomHead title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>


        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="pb-6">
                    <Filter route_name="change_semester" :model_id="$page.props.semester_id" :models="semesters"/>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div
                        class="p-6 text-gray-900 dark:text-gray-100 grid gap-4 lg:grid-cols-4 md:grid-cols-2 grid-cols-1">
                        <template v-for="item in questions_count">
                            <Card :body="item.count" :heading="item.name"/>
                        </template>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
