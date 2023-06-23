<script setup >
import ModelIndex from '@/Layouts/ModelIndex.vue';
import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder';
import EditButton from "@/Components/EditButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import ReadButton from "@/Components/ReadButton.vue";
defineProps(['questions', 'status'])
</script>

<template>
    <ModelIndex title="Question" :url="route('questions.create')">
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <Table :resource="questions" :prevent-overlapping-requests="true" :input-debounce-ms="500">
            <template #cell(years)="{item: question}">
                <div class="whitespace-normal">
                    {{question.years}}
                </div>
            </template>
            <template #cell(topic)="{item: question}">
                <div :title="question.topic.name">
                    {{question.topic.short_name}}
                </div>
            </template>
            <template #cell(chapter)="{item: question}">
                <div :title="question.chapter.name">
                    {{question.chapter.short_name}}
                </div>
            </template>
            <template #cell(course)="{item: question}">
                <div :title="question.course.name">
                    {{question.course.name}}
                </div>
            </template>
            <template #cell(actions)="{ item: question}">
                <ReadButton :url="route('questions.read', question)"/>
                <EditButton :url="route('questions.edit', question)"/>
                <DeleteButton :url="route('questions.destroy', question)"/>
            </template>
         </Table>
    </ModelIndex>
</template>
