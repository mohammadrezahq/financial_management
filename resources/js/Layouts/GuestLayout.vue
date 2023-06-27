<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <div
        dir="rtl"
        class="min-h-screen flex sm:justify-center bg-blue-50 font-shabnam"
    >
        <div
            class="w-full md:w-1/2 px-6 py-4 overflow-hidden md:h-screen items-center flex justify-center"
        >
            <slot />
        </div>
        <div
            class="w-full md:w-1/2 items-center md:h-screen flex justify-center bg-blue-400"
        >
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-white" />
            </Link>
        </div>
    </div>
</template>
