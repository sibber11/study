<script setup >
import ModelIndex from '@/Layouts/ModelIndex.vue';
import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder';
import EditButton from "@/Components/EditButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import ShowButton from '@/Components/ShowButton.vue';
defineProps(['chapters', 'status'])
</script>

<template>
    <ModelIndex title="Chapters" :url="route('topics.create', {selectedType: 'chapter'})">
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <Table :resource="chapters" :prevent-overlapping-requests="true" :input-debounce-ms="500">
            <template #cell(actions)="{ item: chapter}">
                <ShowButton :url="route('topics.show', chapter)"/>
                <EditButton :url="route('topics.edit', chapter)"/>
                <DeleteButton :url="route('topics.destroy', chapter)"/>
            </template>
         </Table>

    </ModelIndex>
</template>
