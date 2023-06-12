<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CancelButton from '@/Components/CancelButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
const props = defineProps(['semesters', 'status', 'url']);

const form = useForm({
    title: '',
    topic_id: '',
    chapter_id: '',
    course_id: '',
    semester_id: ''
});

const submit = () => {
    form.post(props.url, {
        // onFinish: () => form.reset(),
    });
};

// onMounted(() => {
//     if (!props.question) {
//         //
//     }
// });

const courses = computed(()=>{
    if (form.semester_id === '') {
        return [];
    }
    return props.semesters.find(semester => semester.id === form.semester_id).children;
});

const chapters = computed(()=>{
    if (form.course_id === '') {
        return [];
    }
    return courses.value.find(course => course.id === form.course_id).children;
});

const topics = computed(()=>{
    if (form.chapter_id === '') {
        return [];
    }
    return chapters.value.find(chapter => chapter.id === form.chapter_id).children;
})

</script>

<template>
    <form @submit.prevent="submit">
        <div>
            <InputLabel for="title" title="Questions" />

            <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus />

            <InputError class="mt-2" :message="form.errors.title" />
        </div>

        <div class="mt-4">
            <InputLabel for="semester_id" value="Semester" />

            <select v-model="form.semester_id" id="semester_id" @input="form.chapter_id=''"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option v-for="semester in semesters" :value="semester.id" class="">{{ semester.name }}</option>
            </select>

            <InputError class="mt-2" :message="form.errors.chapter_id" />
        </div>

        <div class="mt-4">
            <InputLabel for="course_id" value="Course" />

            <select v-model="form.course_id" id="course_id" @input="form.chapter_id=''"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option v-for="course in courses" :value="course.id" class="">{{ course.name }}</option>
            </select>

            <InputError class="mt-2" :message="form.errors.chapter_id" />
        </div>

        <div class="mt-4">
            <InputLabel for="chapter_id" value="Chapter" />

            <select v-model="form.chapter_id" id="chapter_id" :disabled="!form.course_id" @input="form.topic_id=''"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option v-for="chapter in chapters" :value="chapter.id" class="">{{ chapter.name }}</option>
            </select>

            <InputError class="mt-2" :message="form.errors.chapter_id" />
        </div>

        <div class="mt-4">
            <InputLabel for="topic_id" value="Topic" />

            <select v-model="form.topic_id" id="topic_id" :disabled="!form.chapter_id"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option v-for="topic in topics" :value="topic.id" class="">{{ topic.name }}</option>
            </select>

            <InputError class="mt-2" :message="form.errors.topic_id" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <Transition class="transition ease-in-out" enter-from-class="opacity-0" leave-to-class="opacity-0">
                <p v-if="form.recentlySuccessful && status" class="text-sm text-gray-600">{{ status }}</p>
            </Transition>
            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>

            <CancelButton :url="route('questions.index')"></CancelButton>
        </div>
    </form>
</template>
