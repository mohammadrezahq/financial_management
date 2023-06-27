<script setup>
import { Link, usePage, useForm } from "@inertiajs/inertia-vue3";
import Modal from "@/Components/Modal.vue";
import { ref } from "@vue/reactivity";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { Icon } from "@iconify/vue";

const transactionModal = ref([]);

defineProps({
    transactions: Object,
});

const emit = defineEmits(["delete"]);

const form = useForm();

const remove = (id, i) => {
    if (confirm("آیا مطمین هستید؟")) {
        form.delete(route("transactions.destroy", id), {
            onSuccess: () => {
                transactionModal.value[i] = !transactionModal.value[i];
                emit("delete", i);
            },
        });
    }
};
</script>

<template>
    <div class="flex font-bold p-4 m-2 text-slate-600 bg-slate-100">
        <div class="w-6/12">تیتر</div>
        <div class="w-2/12">دسته</div>
        <div class="w-2/12">تاریخ</div>
        <div class="w-2/12">تغییر</div>
    </div>
    <div
        v-for="(transaction, i) in transactions"
        :key="i"
        :class="
            transaction.type == 'expense'
                ? 'flex cursor-pointer rounded-full p-4 m-2 text-red-600 bg-red-50'
                : 'flex cursor-pointer rounded-full p-4 m-2 text-green-600 bg-green-50'
        "
        @click="transactionModal[i] = true"
    >
        <Modal
            :show="transactionModal[i]"
            :closeable="true"
            @close="transactionModal[i] = !transactionModal[i]"
        >
            <div class="p-6">
                <div class="flex justify-between">
                    <h3 class="text-xl font-semibold text-gray-600">
                        {{ transaction.title }}
                    </h3>
                    <div
                        :class="
                            transaction.type == 'expense'
                                ? 'flex cursor-pointer rounded-full px-4 py-1 text-red-600 bg-red-50'
                                : 'flex cursor-pointer rounded-full px-4 py-1 text-green-600 bg-green-50'
                        "
                    >
                        {{
                            (transaction.type == "expense" ? " - " : " + ") +
                            numberWithCommas(transaction.amount)
                        }}
                        تومان
                    </div>
                </div>
                <div class="flex justify-end gap-x-2 mt-2 mb-4">
                    <Link
                        class="rounded-xl bg-gray-100 text-gray-400 px-2 py-1"
                        :href="
                            route(
                                'categories.show',
                                transaction.category?.id ?? 0
                            )
                        "
                    >
                        {{
                            transaction.category
                                ? transaction.category.name
                                : "بدون دسته"
                        }}
                    </Link>
                    <div
                        class="rounded-xl bg-green-50 text-green-500 px-2 py-1"
                    >
                        {{
                            new Date(transaction.created_at).toLocaleDateString(
                                "fa-IR"
                            )
                        }}
                    </div>
                </div>
                <hr />
                <h3 class="text-md font-semibold mt-4">توضیحات</h3>
                <p class="text-gray-700">
                    {{ transaction.description }}
                </p>
                <div class="flex justify-end">
                    <SecondaryButton @click="remove(transaction.id, i)">
                        <span> حذف </span>
                        <Icon icon="material-symbols:delete-sweep" />
                    </SecondaryButton>
                </div>
            </div>
        </Modal>
        <div class="w-6/12 overflow-hidden font-bold text-md">
            {{ transaction.title }}
        </div>
        <div class="w-2/12">
            <span>
                {{ transaction.category?.name ?? "بدون دسته" }}
            </span>
        </div>
        <div class="w-2/12">
            {{ new Date(transaction.created_at).toLocaleDateString("fa-IR") }}
        </div>
        <div class="w-2/12">
            <span class="font-bold">
                {{ transaction.type == "expense" ? " - " : " + " }}
            </span>
            {{ numberWithCommas(transaction.amount) }} تومان
        </div>
    </div>
</template>
