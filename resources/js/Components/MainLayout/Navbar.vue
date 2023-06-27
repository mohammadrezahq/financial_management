<script setup>
import NavLink from "@/Components/NavLink.vue";
</script>
<template>
    <div class="hidden gap-x-6 sm:-my-px sm:ml-10 sm:flex items-center">
        <NavLink :href="route('home')" :active="route().current('home')">
            خانه
        </NavLink>
        <NavLink
            :href="route('transactions.index')"
            :active="route().current('transactions.index')"
        >
            تراکنش ها
        </NavLink>
        <NavLink
            :href="route('transactions.create')"
            :active="route().current('transactions.create')"
        >
            تراکنش جدید
        </NavLink>
        <NavLink
            :href="route('categories.create')"
            :active="route().current('categories.create')"
        >
            دسته بندی جدید
        </NavLink>
    </div>
</template>
