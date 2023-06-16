<script setup>
    import ModelIndex from '@/Layouts/ModelIndex.vue';
    import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder'
    defineProps(['semesters']);
</script>

<template>
    <ModelIndex title="Semesters" :url="route('topics.create', {selectedType: 'semester'})">
        <Table :resource="semesters" :prevent-overlapping-requests="true" :input-debounce-ms="500"></Table>
    </ModelIndex>
</template>
