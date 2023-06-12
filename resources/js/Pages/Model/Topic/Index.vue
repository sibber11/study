<script setup>
    import ModelIndex from '@/Layouts/ModelIndex.vue';
    import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder';
    import EditButton from "@/Components/EditButton.vue";
    import DeleteButton from "@/Components/DeleteButton.vue";
    import ShowButton from '@/Components/ShowButton.vue';
    defineProps(['topics', 'status']);
</script>

<template>
    <ModelIndex title="Topics" :url="route('topics.create')">
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
<!--        {{topics}}-->
        <Table :resource="topics">
<!--            <template #cell(chapter)="{item:topic}">-->
<!--                {{ topic.chapter.name }}-->
<!--            </template>-->
<!--            <template #cell(course)="{item:topic}">-->
<!--                {{ topic.chapter.course.name }}-->
<!--            </template>-->
<!--            <template #cell(semester)="{item:topic}">-->
<!--                {{ topic.chapter.course.semester.name }}-->
<!--            </template>-->
            <template #cell(actions)="{ item: topic}">
                <ShowButton :url="route('topics.show', topic)"/>
                <EditButton :url="route('topics.edit', topic)"/>
                <DeleteButton :url="route('topics.destroy', topic)"/>
            </template>
        </Table>
    </ModelIndex>
</template>
