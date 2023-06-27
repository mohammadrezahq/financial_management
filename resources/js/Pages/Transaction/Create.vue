<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import HeaderText from "@/Components/HeaderText.vue";

defineProps({
    categories: Object,
});

const form = useForm({
    title: "",
    category_id: "",
    description: "",
    amount: "",
    type: "expense",
});

const submit = () => {
    form.post(route("transactions.store"), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="اضافه کردن تراکنش" />

        <template #header>
            <HeaderText> اضافه کردن تراکنش </HeaderText>
        </template>

        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div
                            v-if="status"
                            class="mb-4 font-medium text-sm text-green-600"
                        >
                            {{ status }}
                        </div>

                        <form @submit.prevent="submit">
                            <div
                                class="flex gap-x-2 gap-y-2 flex-col md:flex-row"
                            >
                                <div class="w-full md:w-1/2">
                                    <div>
                                        <InputLabel for="title" value="تیتر" />
                                        <TextInput
                                            id="title"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.title"
                                            required
                                            autofocus
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.title"
                                        />
                                    </div>

                                    <div class="mt-4">
                                        <InputLabel
                                            for="amount"
                                            value="مقدار به تومان"
                                        />
                                        <TextInput
                                            id="amount"
                                            type="number"
                                            class="mt-1 block w-full"
                                            v-model="form.amount"
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.amount"
                                        />
                                    </div>
                                    <div class="mt-4">
                                        <InputLabel for="type" value="نوع" />
                                        <select
                                            name="type"
                                            id="type"
                                            required
                                            v-model="form.type"
                                            class="border-slate-200 w-full focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                                        >
                                            <option value="expense">خرج</option>
                                            <option value="income">
                                                درآمد
                                            </option>
                                        </select>
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.type"
                                        />
                                    </div>
                                    <div class="mt-4">
                                        <InputLabel
                                            for="category"
                                            value="دسته"
                                        />
                                        <select
                                            name="category"
                                            id="category"
                                            v-model="form.category_id"
                                            class="border-slate-200 w-full focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                                        >
                                            <option
                                                v-for="(
                                                    category, i
                                                ) in categories"
                                                :key="i"
                                                :value="category.id"
                                            >
                                                {{ category.name }}
                                            </option>
                                        </select>
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.category_id"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="w-full md:w-1/2 flex flex-col justify-between"
                                >
                                    <div class="mb-6 h-full">
                                        <InputLabel
                                            for="description"
                                            value="توضیحات"
                                        />
                                        <textarea
                                            name="description"
                                            id="description"
                                            rows="10"
                                            v-model="form.description"
                                            class="border-slate-200 w-full h-full focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                                        ></textarea>
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.description"
                                        />
                                    </div>

                                    <div
                                        class="flex items-center justify-end mt-4"
                                    >
                                        <PrimaryButton
                                            :class="{
                                                'opacity-25': form.processing,
                                            }"
                                            :disabled="form.processing"
                                        >
                                            اضافه کردن
                                        </PrimaryButton>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
