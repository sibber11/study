<script setup>
import CreateLayout from '@/Layouts/CreateLayout.vue';
import Fields from './Fields.vue';

const props = defineProps(['semesters', 'status', 'years', 'difficulties', 'stars', 'model']);
</script>

<template>
    <CreateLayout title="Update Question">
        <Fields v-bind="$props" :url="route('questions.update', model.id)"/>
    </CreateLayout>
</template>
