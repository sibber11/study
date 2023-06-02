<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CancelButton from '@/Components/CancelButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';
const props = defineProps(['courses', 'status', 'url']);

const form = useForm({
    name: '',
    course_id: '',
});

const submit = () => {
    form.post(props.url, {
        // onFinish: () => form.reset(),
    });
};

onMounted(() => {
    if (!props.courses) {
        form.name = props.chapter.name;
        form.course_id = props.chapter.course_id;
    }
});


</script>

<template>
    <form @submit.prevent="submit">
        <div>
            <InputLabel for="name" value="Name" />

            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />

            <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <div class="mt-4">
            <InputLabel for="course_id" value="Course" />

            <select v-model="form.course_id" id="course_id"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                placeholder="Select a Chapter">
                <option v-for="course in courses" :value="course.id" class="">{{ course.name }}</option>
            </select>

            <InputError class="mt-2" :message="form.errors.course_id" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <Transition class="transition ease-in-out" enter-from-class="opacity-0" leave-to-class="opacity-0">
                <p v-if="form.recentlySuccessful && status" class="text-sm text-gray-600">{{ status }}</p>
            </Transition>
            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>

            <CancelButton :url="route('chapter.index')"></CancelButton>
        </div>
    </form>
</template>