<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex gap-x-2 items-center px-4 py-2 bg-red-100 rounded-xl text-sm text-red-500 hover:bg-red-200 focus:bg-red-200 active:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
