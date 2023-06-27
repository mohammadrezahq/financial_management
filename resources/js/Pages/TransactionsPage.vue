<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import Tranactions from "@/Components/Transactions.vue";
import { getFilteredTransactions } from "@/Methods/transactions";
import HeaderText from "@/Components/HeaderText.vue";
import { errorToast } from "@/toasts";
import moment from "jalali-moment";

const props = defineProps({
    transactions: Object,
    categories: Object,
    title: String,
});

const transactions = ref(props.transactions);

const startOfMonth = () => {
    const options = { year: "numeric", month: "numeric", day: "numeric" };
    const today = new Date()
        .toLocaleDateString("fa-IR", options)
        .replace(/([۰-۹])/g, (token) =>
            String.fromCharCode(token.charCodeAt(0) - 1728)
        );

    const date = today.split("/");
    return moment
        .from(date[0] + "/" + date[1] + "/01", "fa", "YYYY/M/D")
        .format("YYYY/MM/DD");
};

const form = useForm({
    starts_at: startOfMonth(),
    ends_at: "",
    category_id: "",
    type: "",
});

const filter = async () => {
    const data = await getFilteredTransactions(form.data());
    transactions.value = data;
};

const remove = (i) => {
    transactions.value.splice(i, 1);
    errorToast.show("با موفقیت حذف شد.");
};
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="props.title" />

        <template #header>
            <HeaderText>
                {{ props.title }}
            </HeaderText>
        </template>

        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-xl font-bold mb-2">فیلتر</h2>
                        <form @submit.prevent="filter">
                            <div class="flex gap-x-2 items-end mb-4">
                                <div>
                                    <InputLabel for="starts_at"
                                        >تاریخ شروع:</InputLabel
                                    >
                                    <DatePicker
                                        format="YYYY-MM-DD HH:mm:ss"
                                        display-format="dddd jDD jMMMM jYYYY"
                                        v-model="form.starts_at"
                                        id="starts_at"
                                    />
                                </div>
                                <div>
                                    <InputLabel for="ends_at"
                                        >تاریخ پایان:</InputLabel
                                    >
                                    <DatePicker
                                        format="YYYY-MM-DD HH:mm:ss"
                                        display-format="dddd jDD jMMMM jYYYY"
                                        v-model="form.ends_at"
                                        id="ends_at"
                                    />
                                </div>
                                <div>
                                    <InputLabel for="type">نوع:</InputLabel>
                                    <select
                                        name="type"
                                        id="type"
                                        v-model="form.type"
                                        class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    >
                                        <option value="">همه</option>
                                        <option selected value="expense">
                                            خرج
                                        </option>
                                        <option value="income">درآمد</option>
                                    </select>
                                </div>
                                <div v-if="categories">
                                    <InputLabel for="category"
                                        >دسته:</InputLabel
                                    >
                                    <select
                                        name="category"
                                        id="category"
                                        v-model="form.category_id"
                                        class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    >
                                        <option value="">همه</option>
                                        <option
                                            v-for="(category, i) in categories"
                                            :key="i"
                                            :value="category.id"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <PrimaryButton> فیلتر </PrimaryButton>
                                </div>
                            </div>
                        </form>

                        <Tranactions
                            :transactions="transactions"
                            @delete="remove"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
