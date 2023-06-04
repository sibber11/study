<script setup>
import CreateLayout from '@/Layouts/CreateLayout.vue';
import Fields from './Fields.vue';

const props = defineProps(['courses', 'status']);
</script>

<template>
    <CreateLayout title="Create Topic">
        <Fields :courses="courses" :status="status" :url="route('topic.store')"/>        
    </CreateLayout>
</template>