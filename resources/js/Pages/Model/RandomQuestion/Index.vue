<script setup>
import ModelIndex from '@/Layouts/ModelIndex.vue';
import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder';
import {router} from "@inertiajs/vue3";
import ReadButton from "@/Components/ReadButton.vue";
import Filter from "@/Components/Filter.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

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

function reload() {
    router.reload({ only: [`questions`] })
}
</script>

<template>
    <ModelIndex title="Question">
        <template #filter>
            <div class="flex justify-between">
                <Filter :model_id="$page.props.course_id" :models="courses" label="Course" route_name="change_course"/>
                <Filter :model_id="$page.props.semester_id" :models="semesters"
                        label="Semester" route_name="change_semester"/>
            </div>
        </template>
        <template #links>
            <PrimaryButton @click="reload">Randomize</PrimaryButton>
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
            </template>
            <template v-slot:pagination="slotProps">
                <div class="m-4">
                    <div class="flex flex-row space-x-4 items-center flex-grow">
                        <select @change="router.visit(route(route().current()), { data: {
                            perPage: $event.target.value
                        } })"
                        class="block focus:ring-indigo-500 focus:border-indigo-500 min-w-max shadow-sm text-sm border-gray-300 rounded-md"
                        name="per_page">
                        <option v-for="per_page in slotProps.perPageOptions" :value="per_page" :selected="slotProps.meta.per_page === per_page">{{ per_page }} per page
                        </option>
                    </select>
                    </div>
                </div>
            </template>
        </Table>
    </ModelIndex>
</template>
