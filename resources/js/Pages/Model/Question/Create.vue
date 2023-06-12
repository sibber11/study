<script setup>
import CreateLayout from '@/Layouts/CreateLayout.vue';
import Fields from './Fields.vue';

const props = defineProps(['semesters', 'status']);
</script>

<template>
    <CreateLayout title="Create Question">
        <Fields :semesters="semesters" :status="status" :url="route('questions.store')"/>
    </CreateLayout>
</template>
