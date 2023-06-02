<script setup>
import NavLink from '@/Components/NavLink.vue';
</script>

<template>
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        Dashboard
    </NavLink>
    <NavLink :href="route('semester.index')" :active="route().current('semester.*')">
        Semester
    </NavLink>
    <NavLink :href="route('course.index')" :active="route().current('course.*')">
        Course
    </NavLink>
    <NavLink :href="route('chapter.index')" :active="route().current('chapter.*')">
        Chapter
    </NavLink>
    <NavLink :href="route('topic.index')" :active="route().current('topic.*')">
        Topic
    </NavLink>
</template>