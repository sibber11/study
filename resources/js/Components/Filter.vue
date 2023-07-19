<script setup>
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
        models: {
            type: Object,
            required: true
        },
        model_id: {
            type: String,
            required: true
        },
        route_name: {
            type: String,
            required: true
        },
        label: {
            type: String,
        }
    }
)
const form = useForm({
    model_id: props.model_id ?? '',
})

function submit() {
    form.post(route(props.route_name))
}
</script>

<template>
    <form @submit.prevent="submit">
        <label for="model" v-if="label" class="mb-2 block text-sm font-medium text-gray-700 dark:text-white">
            Select {{ label }}
        </label>
        <select id="model" v-model="form.model_id"
                class="px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 w-full"
                name="model_id"
                @change="submit">
            <option v-for="(model, id) in models" :key="id" :value="id">{{ model }}</option>
            <option value="">-</option>
        </select>
    </form>
</template>
