<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-blue-100 rounded-xl text-sm text-blue-500 hover:bg-blue-200 focus:bg-blue-200 active:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
