<script setup>
import ShowLayout from '@/Layouts/ShowLayout.vue';
import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder';

defineProps(['topic']);
</script>

<template>
    <ShowLayout :title="topic.name">
        <Table :resource="topic.questions">
            
        </Table>
    </ShowLayout>
</template>