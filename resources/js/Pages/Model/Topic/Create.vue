<script setup>
import CreateLayout from '@/Layouts/CreateLayout.vue';
import Fields from './Fields.vue';
import {capitalize} from "vue";

const props = defineProps(['courses', 'types', 'selectedType', 'status']);
</script>

<template>
    <CreateLayout :title="'Create ' + capitalize(selectedType)">
        <Fields :semesters="courses" :status="status" :types="types" :selectedType="selectedType" :url="route('topics.store')"/>
    </CreateLayout>
</template>
