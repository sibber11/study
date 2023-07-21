<script setup>
import CreateLayout from '@/Layouts/CreateLayout.vue';
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import {useForm} from "@inertiajs/vue3";
import CancelButton from "@/Components/CancelButton.vue";
import {computed} from "vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    semesters: {
        type: Array,
    },
    years: {
        type: Array,
    },
});

const courses = computed(() => {
    if (form.semester_id === '')
        return [];
    return props.semesters.find(semester => semester.id === form.semester_id).children;
});

const chapters = computed(() => {
    if (form.course_id === '')
        return [];
    return courses.value.find(course => course.id === form.course_id).children;
});

const form = useForm({
    questions: '',
    chapter_id: '',
    course_id: '',
    semester_id: '',
    confirmed: false,
})
const final_form = useForm({
    questions_array: '',
    chapter_id: '',
    confirmed: true
})
const submit = () => {
    axios.post(route('multiple-question.store'), form)
        .then(r => {
            final_form.questions_array = r.data;
            final_form.chapter_id = form.chapter_id;
        });
};

const re_submit = () => {
    final_form.chapter_id = form.chapter_id;
    final_form.post(route('multiple-question.store'), {
        preserveScroll: true,
    });
}

function remove_item(id) {
    final_form.questions_array.filter(item => item.id !== id);
}

</script>

<template>
    <CreateLayout title="Create Question">
        <form v-show="!final_form.questions_array" @submit.prevent="submit">

            <div class="mt-4">
                <InputLabel for="semester_id" value="Semester"/>

                <select id="semester_id" v-model="form.semester_id"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
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
                <InputLabel for="questions" value="Questions"/>

                <TextAreaInput id="questions" v-model="form.questions" autofocus class="mt-1 block w-full" required
                               type="text"/>

                <InputError :message="form.errors.questions" class="mt-2"/>
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

        <form v-show="final_form.questions_array" @submit.prevent="re_submit">

            <div v-for="item in final_form.questions_array" class="my-2">

                <div class="flex gap-4 w-full">
                    <TextInput v-model="item.question" class="mt-1 block w-full" required type="text"/>
                    <!--                    <button @click="remove_item(item.id)" type="button"-->
                    <!--                            class="inline-flex items-center mt-1 px-2 py-1 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Delete</button>-->
                </div>
                <ul class="flex flex-wrap gap-4 mt-1">
                    <li v-for="year in years" class="inline-flex gap-3">
                        <input :id="item.id.toString() + year.id.toString()" v-model="item.years"
                               :checked="item.years.includes(year.no)" :value="year.no" class="hidden peer"
                               type="checkbox">

                        <label :for="item.id.toString() + year.id.toString()"
                               class="inline-flex items-center justify-between px-2 py-1 text-gray-500 bg-white rounded-lg cursor-pointer dark:hover:text-gray-300 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-600 dark:hover:bg-gray-700 peer-checked:bg-blue-600">
                            {{ year.no }}
                        </label>
                    </li>
                </ul>

            </div>

            <div class="flex items-center justify-end mt-4">
                <Transition class="transition ease-in-out" enter-from-class="opacity-0" leave-to-class="opacity-0">
                    <p v-if="final_form.recentlySuccessful && status" class="text-sm text-gray-600">{{ status }}</p>
                </Transition>

                <PrimaryButton :class="{ 'opacity-25': final_form.processing }" :disabled="final_form.processing"
                               class="ml-4">
                    Save
                </PrimaryButton>

                <CancelButton :url="route('questions.index')"></CancelButton>
            </div>
        </form>
    </CreateLayout>
</template>
