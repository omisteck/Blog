<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import moment from "moment";

defineProps({
    data: Array,
});

const showingNavigationDropdown = ref(false);
</script>

<template>
    <Head title="Welcome" />
    <div class="w-full">
        <!-- Desktop screen view -->

        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <Link :href="route('dashboard')">
                                <ApplicationLogo class="block h-9 w-auto" />
                            </Link>
                        </div>

                        <!-- Navigation Links -->
                        <div
                            class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                        >
                            <NavLink
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                            >
                                Blog App
                            </NavLink>
                        </div>
                    </div>

                    <div
                        class="hidden sm:flex sm:items-center sm:ml-6"
                        v-if="$page.props.auth.user"
                    >
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
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
                                    <DropdownLink
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>

                    <div
                        v-if="data?.canLogin && !$page.props.auth.user"
                        class="hidden fixed top-0 right-0 px-6 py-4 sm:block"
                    >
                        <Link
                            :href="route('login')"
                            class="text-sm text-gray-700 dark:text-gray-500 underline"
                            >Log in</Link
                        >

                        <Link
                            v-if="data?.canRegister"
                            :href="route('register')"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
                            >Register</Link
                        >
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                        >
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }"
                class="sm:hidden"
            >
                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink
                            :href="route('logout')"
                            method="post"
                            as="button"
                            v-if="$page.props.auth.user"
                        >
                            Log Out
                        </ResponsiveNavLink>
                    </div>

                    <div v-if="canLogin && !$page.props.auth.user">
                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('login')">
                                Log in
                            </ResponsiveNavLink>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('register')">
                                Register
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div
        class="relative flex flex-col items-top min-h-screen bg-gray-100 sm:pt-0"
    >
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <template v-if="data.posts.data.length > 0">
                    <div class="mb-5 w-full">
                        <p>
                            <span class="font-bold mr-4">Sort by</span>
                            <a
                                class="bg-white p-2 text-[12px] rounded-lg mt-3 mr-5"
                                href="./?sort_by=publication_date"
                                >Publication Date ↓</a
                            >
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        <div
                            v-for="(post, index) in data.posts.data"
                            :key="index"
                            class="p-6 mt-3 mr-0 md:mr-5 flex flex-col justify-between bg-white border-1 border-solid border-gray-500"
                        >
                            <h2 class="text-3xl font-bold leading-9">
                                {{ post.title }}
                            </h2>
                            <p class="mb-3">{{ post.description }}</p>
                            <span
                                class="bg-gray-100 p-2 text-[12px] rounded-lg mt-3 mr-5"
                                ><span class="font-bold"
                                    >Published Date:
                                    {{
                                        moment(post.publication_date).format(
                                            "dddd, MMMM Do YYYY"
                                        )
                                    }}</span
                                ></span
                            >
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <div
                            class="p-6 bg-white text-lg text-center border-b border-gray-200"
                        >
                            Ops!😩 no posts yet
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>
