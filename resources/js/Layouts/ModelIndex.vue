<script setup>
import {Head as CustomHead, Link} from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import UnAuthenticatedLayout from "@/Layouts/UnAuthenticatedLayout.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps(['title', 'url']);
</script>

<template>
    <CustomHead :title="title"/>

    <UnAuthenticatedLayout v-if="!$page.props.auth.user">
        <template #header>
            <div class="flex justify-between">
                <h2 class="dark:text-gray-400">{{ title }}</h2>
            </div>
        </template>

        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="py-6">
                    <slot name="filter"></slot>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-2xl text-center">Datatables</h3>
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </UnAuthenticatedLayout>
    <AuthenticatedLayout v-else>
        <template #header>
            <div class="flex justify-between">
                <h2 class="dark:text-gray-400">{{ title }}</h2>
                <Link v-if="url" :href="url">
                    <PrimaryButton>
                        Create
                    </PrimaryButton>
                </Link>
            </div>
        </template>

        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="py-6">
                    <slot name="filter"></slot>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-2xl text-center">Datatables</h3>
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
