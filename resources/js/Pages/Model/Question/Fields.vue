<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CancelButton from '@/Components/CancelButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from '@inertiajs/vue3';
import {computed, onMounted} from 'vue';

const props = defineProps(['semesters', 'status', 'years', 'difficulties', 'stars', 'url', 'model']);

const form = useForm({
    title: '',
    topic_id: '',
    chapter_id: '',
    course_id: '',
    semester_id: props.semesters[0].id,
    years: [],
    star: 0,
    difficulty: props.difficulties[0],
});

const submit = () => {
    if (props.model) {
        form.patch(props.url, {
            // onFinish: () => form.reset(),
            preserveScroll: true,
        });
    } else {
        form.post(props.url, {
            preserveScroll: true,
            // onFinish: () => form.reset(),
        });
    }
};

onMounted(() => {
    if (props.model) {
        form.title = props.model.title;
        form.years = props.model.years_array;
        form.star = props.model.star;
        form.difficulty = props.model.difficulty;
        form.semester_id = props.model.semester_id;
        form.course_id = props.model.course_id;
        form.chapter_id = props.model.chapter_id;
        form.topic_id = props.model.topic_id;
    }
});

const courses = computed(() => {
    if (form.semester_id === '') {
        return [];
    }
    return props.semesters.find(semester => semester.id === form.semester_id).children;
});

const chapters = computed(() => {
    if (form.course_id === '') {
        return [];
    }
    return courses.value.find(course => course.id === form.course_id).children;
});

const topics = computed(() => {
    if (form.chapter_id === '') {
        return [];
    }
    return chapters.value.find(chapter => chapter.id === form.chapter_id).children;
})

</script>

<template>
    <form @submit.prevent="submit">
        <div>
            <InputLabel for="title" title="Questions"/>

            <TextInput id="title" v-model="form.title" autofocus class="mt-1 block w-full" required type="text"/>

            <InputError :message="form.errors.title" class="mt-2"/>
        </div>

        <div class="mt-4">
            <InputLabel for="semester_id" value="Semester"/>

            <select id="semester_id" v-model="form.semester_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    disabled
                    @input="form.chapter_id=''">
                <option v-for="semester in semesters" :value="semester.id" class="">{{ semester.name }}</option>
            </select>

            <InputError :message="form.errors.chapter_id" class="mt-2"/>
        </div>

        <div class="mt-4">
            <InputLabel for="course_id" value="Course"/>

            <select id="course_id" v-model="form.course_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    @input="form.chapter_id=''">
                <option v-for="course in courses" :value="course.id" class="">{{ course.name }}</option>
            </select>

            <InputError :message="form.errors.chapter_id" class="mt-2"/>
        </div>

        <div class="mt-4">
            <InputLabel for="chapter_id" value="Chapter"/>

            <select id="chapter_id" v-model="form.chapter_id" :disabled="!form.course_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    @input="form.topic_id=''">
                <option v-for="chapter in chapters" :value="chapter.id" class="">{{ chapter.name }}</option>
            </select>

            <InputError :message="form.errors.chapter_id" class="mt-2"/>
        </div>

        <div class="mt-4">
            <InputLabel for="topic_id" value="Topic"/>

            <select id="topic_id" v-model="form.topic_id" :disabled="!form.chapter_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option v-for="topic in topics" :value="topic.id" class="">{{ topic.name }}</option>
            </select>

            <InputError :message="form.errors.topic_id" class="mt-2"/>
        </div>

        <div class="mt-4">
            <InputLabel for="years_id" value="Years"/>
            <div class="flex gap-4 flex-wrap justify-start">
                <span v-for="year in years" :key="year.no">
                    <input :id="year.no" v-model="form.years" :name="year.no" :value="year.id" type="checkbox">
                    <label :for="year.no" class="inline-flex items-center">
                        <span class="ml-2 text-sm text-gray-300">{{ year.no }}</span>
                    </label>
                </span>
            </div>

            <InputError :message="form.errors.years_id" class="mt-2"/>
        </div>

        <div class="mt-4">
            <InputLabel for="difficulty_id" value="Difficulty"/>
            <select id="difficulty_id" v-model="form.difficulty"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option v-for="difficulty in difficulties" :value="difficulty" class="">{{ difficulty }}</option>
            </select>

            <InputError :message="form.errors.chapter_id" class="mt-2"/>
        </div>

        <div class="mt-4">
            <InputLabel for="star_id" value="Importance"/>

            <select id="star_id" v-model="form.star"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="0">Select Importance</option>
                <option v-for="star in stars" :value="star" class="">{{ '⭐'.repeat(star) }}</option>
            </select>

            <InputError :message="form.errors.chapter_id" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <Transition class="transition ease-in-out" enter-from-class="opacity-0" leave-to-class="opacity-0">
                <p v-if="form.recentlySuccessful && status" class="text-sm text-gray-600">{{ status }}</p>
            </Transition>
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="ml-4">
                Save
            </PrimaryButton>

            <CancelButton :url="route('questions.index')"></CancelButton>
        </div>
    </form>
</template>
