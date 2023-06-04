<script setup>
    import ModelIndex from '@/Layouts/ModelIndex.vue';
    import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder'
    defineProps(['topics', 'status']);
</script>

<template>
    <ModelIndex title="Topics" :url="route('topic.create')">
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <Table :resource="topics">
            <template #cell(chapter)="{item:topic}">
                {{ topic.chapter.name }}
            </template>
            <template #cell(course)="{item:topic}">
                {{ topic.chapter.course.name }}
            </template>
            <template #cell(semester)="{item:topic}">
                {{ topic.chapter.course.semester.name }}
            </template>
            <template #cell(actions)="{ item: chapter}">
                <EditButton :url="route('chapter.edit', chapter)"/>
                <DeleteButton :url="route('chapter.destroy', chapter)"/>
            </template>
        </Table>
    </ModelIndex>
</template>