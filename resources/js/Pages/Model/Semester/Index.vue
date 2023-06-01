<script setup>
    import ModelIndex from '@/Layouts/ModelIndex.vue';
    defineProps(['semesters']);
</script>

<template>
    <ModelIndex :models="semesters" title="Semesters"/>
</template>