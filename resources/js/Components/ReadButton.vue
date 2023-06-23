<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    url: String,
    title: {
        type: String,
        default: 'Read'
    }
})
</script>
<template>
    <Link :preserve-scroll="true" :href="url" as="button" method="post" class="px-1 py-0.5 border rounded bg-blue-600 text-white">
        <!-- <i class="fa fa-sm fa-pencil"></i> -->
        <span>{{title}}</span>
    </Link>
</template>
