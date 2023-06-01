<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder'

    defineProps(['models','title']);
</script>

<template>
    <Head :title="title"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="dark:text-gray-400">{{title}}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                         <h3 class="text-2xl text-center">Laravel 9 Inertia JS Datatable</h3>
                         <Table :resource="models" />
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>