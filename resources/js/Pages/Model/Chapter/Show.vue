<script setup>
import ShowLayout from '@/Layouts/ShowLayout.vue';
import {Table} from '@protonemedia/inertiajs-tables-laravel-query-builder';
import { Link } from '@inertiajs/vue3';

defineProps(['chapter', 'questions']);
</script>

<template>
    <ShowLayout :title="chapter.name">
        <template #header>
            <h2 class="text-lg">Topics in this Chapter</h2>
            <ul>
                <li v-for="topic in chapter.topics" :key="topic.id">
                    <Link :href="route('topic.show', topic)">{{topic.name}}</Link>
                </li>
            </ul>
        </template>
        <Table :resource="questions">
            <template #cell(topic)="{item:question}">
                {{ question.topic.name }}
            </template>
        </Table>
    </ShowLayout>
</template>