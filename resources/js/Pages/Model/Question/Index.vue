<script setup>
import ModelIndex from '@/Layouts/ModelIndex.vue';
import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder';
import EditButton from "@/Components/EditButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import ReadButton from "@/Components/ReadButton.vue";
import Filter from "@/Components/Filter.vue";

defineProps(['questions', 'status', 'courses', 'semesters'])

function getStar(number) {
    if (number === -1)
        return '';
    return '⭐'.repeat(number)
}

function getClass(difficulty) {
    if (difficulty === 'Medium') {
        return 'text-yellow-500'
    } else if (difficulty === 'Hard') {
        return 'text-red-500'
    }
}
</script>

<template>
    <ModelIndex :url="route('questions.create')" title="Question">
        <template #filter>
            <div class="flex justify-between">
                <Filter :model_id="$page.props.course_id" :models="courses" label="Course" route_name="change_course"/>
                <Filter v-if="!$page.props.auth.user" :model_id="$page.props.semester_id" :models="semesters"
                        label="Semester" route_name="change_semester"/>
                <!--            info button that can be viwed by clicking on it-->
                <!--                <Dropdown>-->
                <!--                    <template #trigger>-->
                <!--                        <PrimaryButton>i</PrimaryButton>-->
                <!--                    </template>-->
                <!--                    <template #content>-->
                <!--                        <div class="p-4">-->
                <!--                            <p class="text-sm text-gray-700 dark:text-white">-->
                <!--                                <strong>Easy</strong> questions are those that can be solved in less than 10 minutes.-->
                <!--                            </p>-->
                <!--                        </div>-->
                <!--                    </template>-->
                <!--                </Dropdown>-->
            </div>
        </template>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <Table :input-debounce-ms="500" :prevent-overlapping-requests="true" :resource="questions">
            <template #cell(title)="{item: question}">
                <div class="whitespace-normal">
                    <div :class="getClass(question.difficulty)" class="text-base">
                        {{ question.title }} {{ getStar(question.star) }}
                    </div>
                    <small>{{ question.years }}</small>
                </div>
            </template>
            <!--            <template #cell(topic)="{item: question}">-->
            <!--                <div :title="question.topic.name">-->
            <!--                    {{question.topic.short_name}}-->
            <!--                </div>-->
            <!--            </template>-->
            <template #cell(chapter)="{item: question}">
                <div :title="question.chapter.name" class="whitespace-normal">
                    {{ question.chapter.name }}
                </div>
            </template>
            <template #cell(course)="{item: question}" class="whitespace-normal">
                <div :title="question.course.name">
                    {{ question.course.name }}
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
