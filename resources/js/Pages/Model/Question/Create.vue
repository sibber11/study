<script setup>
import CreateLayout from '@/Layouts/CreateLayout.vue';
import Fields from './Fields.vue';

const props = defineProps(['semesters', 'status', 'years']);
</script>

<template>
    <CreateLayout title="Create Question">
        <Fields :semesters="semesters" :years="years" :status="status" :url="route('questions.store')"/>
    </CreateLayout>
</template>
