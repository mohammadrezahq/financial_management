<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { nextTick, ref } from "vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: "",
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route("profile.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">حذف حساب کاربری</h2>
            <p class="mt-1 text-sm text-gray-600">
                هنگام حذف حساب کاربری, تمام اطلاعات شما حذف خواهد شد. قبل از هر
                اقدامی بک آپ تهیه کنید.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">حذف حساب</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    آیا از حذف حساب کاربری خود مطمین می باشید؟
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    هنگام حذف حساب کاربری, تمام اطلاعات شما حذف خواهد شد. قبل از
                    هر اقدامی بک آپ تهیه کنید.
                </p>

                <div class="mt-6">
                    <InputLabel
                        for="password"
                        value="رمز عبور"
                        class="sr-only"
                    />
                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                    />
                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end gap-x-2">
                    <SecondaryButton @click="closeModal"> لغو </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        حذف
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
