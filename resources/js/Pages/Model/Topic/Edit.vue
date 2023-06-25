<script setup>
import CreateLayout from '@/Layouts/CreateLayout.vue';
import Fields from './Fields.vue';
import {capitalize} from "vue";

const props = defineProps(['semesters', 'types', 'selectedType', 'status', 'model']);
</script>

<template>
    <CreateLayout :title="'Update ' + capitalize(selectedType)">
        <Fields v-bind="$props" :url="route('topics.update', model)"/>
    </CreateLayout>
</template>
