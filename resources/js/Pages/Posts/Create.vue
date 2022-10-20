<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';


defineProps({
    status: String,
});


const form = useForm({
    title: '',
    description: '',
    publication_date: ''
});

const submit = () => {
    form.post(route('store.post'), {
        onFinish: () => {
            form.title = ''
            form.description = ''
            form.publication_date = ''
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="title" value="Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus/>
                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div class="mt-4">
                <InputLabel for="description" value="Description" />
                <textarea class="mt-1 block w-full" rows="7" v-model="form.description" required></textarea>
                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div class="block mt-4">
                <InputLabel for="publication_date" value="Publication Date" />
                <input type="date" class="mt-1 block w-full" v-model="form.publication_date" required />
                <InputError class="mt-2" :message="form.errors.publication_date" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('dashboard')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Cancel
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Publish
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
