<script setup >
import ModelIndex from '@/Layouts/ModelIndex.vue';
import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder';
import EditButton from "@/Components/EditButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import ShowButton from '@/Components/ShowButton.vue';
defineProps(['chapters', 'status'])
</script>

<template>
    <ModelIndex title="Chapters" :url="route('chapter.create')">
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <Table :resource="chapters">
            <template #cell(course)="{item:chapter}">
                {{ chapter.course.name }}
            </template>
            <template #cell(semester)="{item:chapter}">
                {{ chapter.course.semester.name }}
            </template>
            <template #cell(actions)="{ item: chapter}">
                <ShowButton :url="route('chapter.show', chapter)"/>
                <EditButton :url="route('chapter.edit', chapter)"/>
                <DeleteButton :url="route('chapter.destroy', chapter)"/>
            </template>
         </Table>
        
    </ModelIndex>
</template>