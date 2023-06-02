<script setup>
    import ModelIndex from '@/Layouts/ModelIndex.vue';
    import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder'
    defineProps(['courses']);
</script>

<template>
    <ModelIndex title="Courses">
        <Table :resource="courses">
            <template #cell(semester)="{item:course}">
                {{ course.semester.name }}
            </template>
        </Table>
        </ModelIndex>
</template>