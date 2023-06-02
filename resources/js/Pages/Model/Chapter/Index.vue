<script setup>
import ModelIndex from '@/Layouts/ModelIndex.vue';
import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder'
defineProps(['chapters']);
</script>

<template>
    <ModelIndex title="Chapters">
        <Table :resource="chapters">
            <template #cell(course)="{item:chapter}">
                {{ chapter.course.name }}
            </template>
         </Table>
        
    </ModelIndex>
</template>