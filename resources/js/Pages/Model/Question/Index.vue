<script setup >
import ModelIndex from '@/Layouts/ModelIndex.vue';
import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder';
import EditButton from "@/Components/EditButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import ReadButton from "@/Components/ReadButton.vue";
import Filter from "@/Components/Filter.vue";
import Dropdown from "@/Components/Dropdown.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
defineProps(['questions', 'status', 'courses'])
function getStar(number) {
    return '⭐'.repeat(number)
}
function getClass(difficulty){
    if (difficulty === 'Medium') {
        return 'text-yellow-500'
    } else if (difficulty === 'Hard') {
        return 'text-red-500'
    }
}
</script>

<template>
    <ModelIndex title="Question" :url="route('questions.create')">
        <template #filter>
            <div class="flex justify-between">
                <Filter :courses="courses"/>
                <!--            info button that can be viwed by clicking on it-->
                <Dropdown>
                    <template #trigger>
                        <PrimaryButton>i</PrimaryButton>
                    </template>
                    <template #content>
                        <div class="p-4">
                            <p class="text-sm text-gray-700 dark:text-white">
                                <strong>Easy</strong> questions are those that can be solved in less than 10 minutes.
                            </p>
                        </div>
                    </template>
                </Dropdown>
            </div>
        </template>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <Table :resource="questions" :prevent-overlapping-requests="true" :input-debounce-ms="500">
            <template #cell(title)="{item: question}">
                <div class="whitespace-normal">
                    <div class="text-base" :class="getClass(question.difficulty)">
                        {{question.title}} {{getStar(question.star)}}
                    </div>
                    <small>{{question.years}}</small>
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
<!--            <template #cell(course)="{item: question}">-->
<!--                <div :title="question.course.name">-->
<!--                    {{question.course.name}}-->
<!--                </div>-->
<!--            </template>-->
            <template #cell(actions)="{ item: question}">
                <ReadButton :url="route('questions.read', question)"/>
                <EditButton :url="route('questions.edit', question)"/>
                <DeleteButton :url="route('questions.destroy', question)"/>
            </template>
         </Table>
    </ModelIndex>
</template>
