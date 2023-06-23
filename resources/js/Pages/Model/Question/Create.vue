<script setup>
import CreateLayout from '@/Layouts/CreateLayout.vue';
import Fields from './Fields.vue';

const props = defineProps(['semesters', 'status', 'years', 'difficulties', 'stars']);
</script>

<template>
    <CreateLayout title="Create Question">
        <Fields v-bind="$props" :url="route('questions.store')"/>
    </CreateLayout>
</template>
