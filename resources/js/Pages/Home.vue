<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import HeaderText from "@/Components/HeaderText.vue";

const props = defineProps({
    transactions: Object,
});

const sumOfExpenses = ref(0);
const sumOfIncomes = ref(0);

const categoryTable = ref({});

props.transactions.map((t) => {
    let category = "بدون دسته";
    let id = 0;

    if (t.category) {
        category = t.category.name;
        id = t.category.id;
    }

    if (!categoryTable.value[category]) {
        categoryTable.value[category] = {
            expenses_count: 0,
            incomes_count: 0,
            expenses_amount: 0,
            incomes_amount: 0,
            id,
        };
    }

    if (t.type == "expense") {
        sumOfExpenses.value += t.amount;

        categoryTable.value[category]["expenses_count"]++;
        categoryTable.value[category]["expenses_amount"] += t.amount;
    }

    if (t.type == "income") {
        sumOfIncomes.value += t.amount;

        categoryTable.value[category]["incomes_count"]++;
        categoryTable.value[category]["incomes_amount"] += t.amount;
    }
});
</script>

<template>
    <Head title="خانه" />

    <AuthenticatedLayout>
        <template #header>
            <HeaderText> خانه </HeaderText>
        </template>

        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex gap-x-4">
                            <div
                                class="bg-gray-100 rounded-lg p-4 flex flex-col justify-center items-center"
                            >
                                <div class="text-lg font-bold">
                                    جمع خرج این ماه
                                </div>
                                <div>
                                    -
                                    {{ numberWithCommas(sumOfExpenses) }}
                                    تومان
                                </div>
                            </div>
                            <div
                                class="bg-gray-100 rounded-lg p-4 flex flex-col justify-center items-center"
                            >
                                <div class="text-lg font-bold">
                                    جمع درآمد این ماه
                                </div>
                                <div>
                                    +
                                    {{ numberWithCommas(sumOfIncomes) }}
                                    تومان
                                </div>
                            </div>
                            <div
                                class="bg-gray-100 rounded-lg p-4 flex flex-col justify-center items-center"
                            >
                                <div class="text-lg font-bold">تراز</div>
                                <div>
                                    {{
                                        numberWithCommas(
                                            sumOfIncomes - sumOfExpenses
                                        )
                                    }}
                                    تومان
                                </div>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h2 class="font-bold text-xl">
                                هزینه ها به تفکیک دسته
                            </h2>
                            <Link
                                v-for="(ct, key) in categoryTable"
                                :key="ct"
                                class="inline-flex gap-y-2 bg-gray-100 rounded-lg p-4 m-2 flex-col justify-center items-center"
                                :href="route('categories.show', ct.id)"
                            >
                                <div class="text-lg font-bold">{{ key }}</div>
                                <div
                                    class="flex gap-x-2 w-full justify-between"
                                >
                                    <span
                                        class="bg-gray-200 text-gray-400 px-4 py-2 rounded-lg"
                                    >
                                        {{ ct.expenses_count }}
                                    </span>
                                    <span
                                        class="p-2 bg-red-100 rounded-lg text-red-400"
                                    >
                                        -
                                        {{
                                            numberWithCommas(ct.expenses_amount)
                                        }}
                                        تومان
                                    </span>
                                </div>
                                <div
                                    class="flex gap-x-2 w-full justify-between"
                                >
                                    <span
                                        class="bg-gray-200 text-gray-400 px-4 py-2 rounded-lg"
                                    >
                                        {{ ct.incomes_count }}
                                    </span>
                                    <span
                                        class="p-2 bg-green-200 rounded-lg text-green-500"
                                    >
                                        +
                                        {{
                                            numberWithCommas(ct.incomes_amount)
                                        }}
                                        تومان
                                    </span>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
