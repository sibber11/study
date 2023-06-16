<script setup>
    import ModelIndex from '@/Layouts/ModelIndex.vue';
    import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder';
    import EditButton from "@/Components/EditButton.vue";
    import DeleteButton from "@/Components/DeleteButton.vue";
    import ShowButton from '@/Components/ShowButton.vue';
    defineProps(['topics', 'status']);
</script>

<template>
    <ModelIndex title="Topics" :url="route('topics.create', {selectedType: 'topic'})">
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <Table :resource="topics" :prevent-overlapping-requests="true" :input-debounce-ms="500">

            <template #cell(actions)="{ item: topic}">
                <ShowButton :url="route('topics.show', topic)"/>
                <EditButton :url="route('topics.edit', topic)"/>
                <DeleteButton :url="route('topics.destroy', topic)"/>
            </template>
        </Table>
    </ModelIndex>
</template>
