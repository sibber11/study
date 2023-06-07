<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    url: String
})
</script>
<template>
    <Link :href="url" class="px-1 py-0.5 border rounded">
        <!-- <i class="fa fa-sm fa-pencil"></i> -->
        <span>Show</span>
    </Link>
</template>
