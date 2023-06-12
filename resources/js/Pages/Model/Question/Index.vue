<script setup >
import ModelIndex from '@/Layouts/ModelIndex.vue';
import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder';
import EditButton from "@/Components/EditButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
defineProps(['questions', 'status'])
</script>

<template>
    <ModelIndex title="Question" :url="route('questions.create')">
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <Table :resource="questions">
<!--            <template #cell(topic)="{item:question}">-->
<!--                {{ question.topic.name }}-->
<!--            </template>-->
<!--            <template #cell(chapter)="{item:question}">-->
<!--                {{ question.topic.chapter.name }}-->
<!--            </template>-->
<!--            <template #cell(course)="{item:question}">-->
<!--                {{ question.topic.chapter.course.code }}-->
<!--            </template>-->
            <template #cell(actions)="{ item: question}">
                <EditButton :url="route('questions.edit', question)"/>
                <DeleteButton :url="route('questions.destroy', question)"/>
            </template>
         </Table>
    </ModelIndex>
</template>
