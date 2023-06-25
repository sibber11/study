<script setup>
import {useForm, usePage} from "@inertiajs/vue3";

defineProps(['courses'])
const form = useForm({
    course_id: usePage().props.course_id ?? '',
})

function submit() {
    form.post(route('change_course'))
}
</script>

<template>
    <form @submit.prevent="submit">
        <select id="topic" v-model="form.course_id"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                name="course_id"
                @change="submit">
            <option v-for="(course, id) in courses" :key="id" :value="id">{{ course }}</option>
            <option value="">Choose a Course...</option>
        </select>
    </form>
</template>
