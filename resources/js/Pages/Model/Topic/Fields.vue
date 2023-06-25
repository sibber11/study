<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CancelButton from '@/Components/CancelButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from '@inertiajs/vue3';
import {computed, onMounted} from 'vue';

const props = defineProps(['semesters', 'types', 'selectedType', 'status', 'url', 'model']);

const form = useForm({
    name: '',
    course_id: '',
    chapter_id: '',
    semester_id: '',
    type: props.selectedType ?? '',
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
        form.name = props.model.name;
        form.semester_id = props.model.semester_id;
        form.course_id = props.model.course_id;
        form.chapter_id = props.model.chapter_id;
        form.type = props.model.type;
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

</script>

<template>
    <form @submit.prevent="submit">
        <div class="mt-4">
            <InputLabel for="type" value="Type"/>

            <select id="course_id" v-model="form.type" :disabled="props.selectedType"
                    class="uppercase mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    >
                <option v-for="type in types" :value="type">{{ type }}</option>
            </select>

            <InputError :message="form.errors.type" class="mt-2"/>
        </div>
        <div class="mt-4">
            <InputLabel for="name" value="Name"/>

            <TextInput id="name" v-model="form.name" autofocus class="mt-1 block w-full" required type="text"/>

            <InputError :message="form.errors.name" class="mt-2"/>
        </div>
        <div class="mt-4" v-if="form.type && form.type !== 'semester'">
            <InputLabel for="semester_id" value="Semester"/>

            <select id="semester_id" v-model="form.semester_id" @input="form.course_id=''"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    >
                <option v-for="semester in semesters" :value="semester.id" class="">{{ semester.name }}</option>
            </select>

            <InputError :message="form.errors.semester_id" class="mt-2"/>
        </div>

        <div class="mt-4" v-if="form.type === 'topic' || form.type === 'chapter'">
            <InputLabel for="course_id" value="Course"/>

            <select id="type" v-model="form.course_id" :disabled="!form.semester_id" @input="form.chapter_id=''"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            >
                <option v-for="course in courses" :value="course.id" class="">{{ course.name }}</option>
            </select>


            <InputError :message="form.errors.course_id" class="mt-2"/>
        </div>

        <div class="mt-4" v-if="form.type === 'topic'">
            <InputLabel for="chapter_id" value="Chapter"/>

            <select id="chapter_id" v-model="form.chapter_id" :disabled="!form.course_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    >
                <option v-for="chapter in chapters" :value="chapter.id" class="">{{ chapter.name }}</option>
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

            <CancelButton :url="route('topics.index')"></CancelButton>
        </div>
    </form>
</template>
