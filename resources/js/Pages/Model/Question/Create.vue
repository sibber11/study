<script setup>
import CreateLayout from '@/Layouts/CreateLayout.vue';
import Fields from './Fields.vue';

const props = defineProps(['courses', 'status']);
</script>

<template>
    <CreateLayout title="Create Question">
        <Fields :courses="courses" :status="status" :url="route('question.store')"/>  
    </CreateLayout>
</template>