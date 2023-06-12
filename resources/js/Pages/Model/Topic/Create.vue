<script setup>
import CreateLayout from '@/Layouts/CreateLayout.vue';
import Fields from './Fields.vue';

const props = defineProps(['courses', 'types', 'status']);
</script>

<template>
    <CreateLayout title="Create Topic">
        <Fields :semesters="courses" :status="status" :types="types" :url="route('topics.store')"/>
    </CreateLayout>
</template>
