<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
    props.active
        ? "inline-flex items-center py-1 text-sm font-medium text-slate-700 focus:outline-none transition duration-150 ease-in-out rounded-xl px-4 inline-block bg-black bg-opacity-20"
        : "inline-flex items-center py-1 text-sm font-medium text-slate-700 hover:text-slate-900 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out rounded-xl px-4 inline-block bg-black bg-opacity-5"
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
