<script setup>
import NavLink from '@/Components/NavLink.vue';
</script>

<template>
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        Dashboard
    </NavLink>
    <NavLink :href="route('semesters.index')" :active="route().current('semesters.*')">
        Semester
    </NavLink>
    <NavLink :href="route('courses.index')" :active="route().current('courses.*')">
        Course
    </NavLink>
    <NavLink :href="route('chapters.index')" :active="route().current('chapters.*')">
        Chapter
    </NavLink>
    <NavLink :href="route('topics.index')" :active="route().current('topics.index')">
        Topic
    </NavLink>
    <NavLink :href="route('questions.index')" :active="route().current('questions.*')">
        Question
    </NavLink>
</template>
