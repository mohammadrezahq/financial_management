<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { Icon } from "@iconify/vue";
import { errorToast, successToast } from "@/toasts";
import HeaderText from "@/Components/HeaderText.vue";

defineProps({
    categories: Object,
});

const form = useForm({
    name: "",
});

const submit = () => {
    form.post(route("categories.store"), {
        onSuccess: () => {
            form.reset();
            successToast.show("دسته با موفقیت اضافه شد.");
        },
    });
};

const remove = (id) => {
    if (confirm("آیا از حذف این دسته مطمین می باشید؟")) {
        Inertia.delete(route("categories.destroy", id), {
            onSuccess: () => {
                errorToast.show("دسته با موفقیت حذف شد.");
            },
        });
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="اضافه کردن دسته" />

        <template #header>
            <HeaderText> اضافه کردن دسته </HeaderText>
        </template>

        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="دسته" />
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    اضافه کردن
                                </PrimaryButton>
                            </div>
                        </form>
                        <div class="mt-4">
                            <h3 class="text-xl font-semibold p-4">دسته ها</h3>
                            <div
                                v-for="(c, i) in categories"
                                :key="c"
                                class="inline-flex bg-gray-100 rounded-lg p-4 m-2 gap-x-2 justify-center items-center"
                            >
                                <Link
                                    :href="route('categories.show', c.id)"
                                    class="text-lg font-bold"
                                >
                                    {{ c.name }}
                                </Link>
                                <button
                                    class="hover:bg-gray-200 p-2 rounded-full flex items-center"
                                    @click="remove(c.id)"
                                >
                                    <Icon
                                        class="inline-block"
                                        icon="ic:round-close"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
