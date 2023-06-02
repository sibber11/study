<script setup>
    import ModelIndex from '@/Layouts/ModelIndex.vue';
    import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder'
    defineProps(['semesters']);
</script>

<template>
    <ModelIndex title="Semesters">
        <Table :resource="semesters"></Table>
    </ModelIndex>
</template>