<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
</script>
<template>
    <div class="hidden sm:flex sm:items-center sm:ml-6">
        <div class="ml-3 relative">
            <Dropdown align="right" width="48">
                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button
                            type="button"
                            class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium text-slate-700 hover:text-slate-900 focus:outline-none transition ease-in-out duration-150 rounded-xl px-4 bg-black bg-opacity-5"
                        >
                            {{ $page.props.auth.user.name }}

                            <svg
                                class="ml-2 -mr-0.5 h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </span>
                </template>

                <template #content>
                    <DropdownLink :href="route('profile.edit')">
                        پروفایل
                    </DropdownLink>
                    <DropdownLink
                        :href="route('logout')"
                        method="post"
                        as="button"
                    >
                        خروج
                    </DropdownLink>
                </template>
            </Dropdown>
        </div>
    </div>
</template>
