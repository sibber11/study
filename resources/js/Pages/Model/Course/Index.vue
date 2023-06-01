<script setup>
    import ModelIndex from '@/Layouts/ModelIndex.vue';
    defineProps(['chapters']);
</script>

<template>
    <ModelIndex :models="chapters" title="Chapters"/>
</template>