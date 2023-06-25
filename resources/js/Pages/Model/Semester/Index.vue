<script setup>
    import ModelIndex from '@/Layouts/ModelIndex.vue';
    import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder'
    import EditButton from "@/Components/EditButton.vue";
    import DeleteButton from "@/Components/DeleteButton.vue";
    defineProps(['semesters']);
</script>

<template>
    <ModelIndex title="Semesters" :url="route('topics.create', {selectedType: 'semester'})">
        <Table :resource="semesters" :prevent-overlapping-requests="true" :input-debounce-ms="500">
            <template #cell(actions)="{ item: semester}">
<!--                <ShowButton :url="route('topics.show', semester)"/>-->
                <EditButton :url="route('topics.edit', semester)"/>
                <DeleteButton :url="route('topics.destroy', semester)"/>
            </template>
        </Table>
    </ModelIndex>
</template>
