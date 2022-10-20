<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import moment from "moment";

defineProps({
    data: Array,
});
</script>


<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Posts
                <Link class="bg-[#1F2937] text-white py-2 px-5 text-[12px] rounded-lg mt-3 mr-5"
                            href="/posts/create">Create Post +</Link>
            </h2>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <template v-if="data.posts.data.length > 0">
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        <div v-for="(post, index) in data.posts.data" :key="index"
                            class="p-6 mt-3 mr-0 md:mr-5 flex flex-col justify-between bg-white border-1 border-solid border-gray-500">
                            <h2 class="text-3xl font-bold leading-9">
                                {{ post.title }}
                            </h2>
                            <p class="mb-3">{{ post.description }}</p>
                            <span class="bg-gray-100 p-2 text-[12px] rounded-lg mt-3 mr-5"><span
                                    class="font-bold">Published Date:
                                    {{
                                    moment(post.publication_date).format(
                                    "dddd, MMMM Do YYYY"
                                    )
                                    }}</span></span>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            You havn't post yet plese do! | <Link class="bg-[#1F2937] text-white py-2 px-5 text-[12px] rounded-lg mt-3 mr-5"
                            href="/posts/create">Create Post +</Link>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
