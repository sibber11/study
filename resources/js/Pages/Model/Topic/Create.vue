<script setup>
import CreateLayout from '@/Layouts/CreateLayout.vue';
import Fields from './Fields.vue';
import {capitalize} from "vue";

const props = defineProps(['semesters', 'types', 'selectedType', 'status']);
</script>

<template>
    <CreateLayout :title="'Create ' + capitalize(selectedType)">
        <Fields v-bind="$props" :url="route('topics.store')"/>
    </CreateLayout>
</template>
