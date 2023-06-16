<script setup>
    import ModelIndex from '@/Layouts/ModelIndex.vue';
    import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder'
    import ShowButton from "@/Components/ShowButton.vue";
    import EditButton from "@/Components/EditButton.vue";
    import DeleteButton from "@/Components/DeleteButton.vue";
    defineProps(['courses']);
</script>

<template>
    <ModelIndex title="Courses" :url="route('topics.create', {selectedType: 'course'})">
        <Table :resource="courses" :prevent-overlapping-requests="true" :input-debounce-ms="500">
            <template #cell(actions)="{ item: chapter}">
                <ShowButton :url="route('topics.show', chapter)"/>
                <EditButton :url="route('topics.edit', chapter)"/>
                <DeleteButton :url="route('topics.destroy', chapter)"/>
            </template>
        </Table>
        </ModelIndex>
</template>
