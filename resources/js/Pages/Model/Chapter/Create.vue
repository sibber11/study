<script setup>
import CreateLayout from '@/Layouts/CreateLayout.vue';
import Fields from './Fields.vue';

const props = defineProps(['courses', 'status']);
</script>

<template>
    <CreateLayout title="Create Chapter">
        <Fields :courses="courses" :status="status" :url="route('chapter.store')"/>
            
    </CreateLayout>
</template>