<script setup>
import CreateLayout from '@/Layouts/CreateLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CancelButton from '@/Components/CancelButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Fields from './Fields.vue';

const props = defineProps(['courses', 'status']);
</script>

<template>
    <CreateLayout title="Create Chapter">
        <Fields :courses="courses" :status="status" :url="route('chapter.store')"/>
            
    </CreateLayout>
</template>