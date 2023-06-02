<script setup>

import {Link} from "@inertiajs/vue3";

defineProps({
    url: String
})

</script>

<template>
    <Link :href="url" as="button" method="delete" class="px-1 py-0.5 border rounded bg-red-600 text-white">
        <!-- <i class="fa fa-trash-alt"></i> -->
        <span>Delete</span>
    </Link>
</template>
