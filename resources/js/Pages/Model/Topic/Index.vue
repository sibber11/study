<script setup>
    import ModelIndex from '@/Layouts/ModelIndex.vue';
    import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder'
    defineProps(['topics']);
</script>

<template>
    <ModelIndex title="Topics">
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
        </Table>
    </ModelIndex>
</template>