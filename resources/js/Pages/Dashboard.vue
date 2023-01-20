<script setup>
import NavLink from '@/Components/NavLink.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">Welcome {{ $page.props.auth.user.name }}!</div>
                </div>
            </div>
        </div>

        <NavLink :href="route('post.create')" :active="route().current('post.create')">
            <p>create post</p>
        </NavLink>
        <NavLink v-if="$page.props.auth.user.is_admin" :href="route('tag.create')" :active="route().current('tag.create')">
            <p>create tag</p>
        </NavLink>

    </AuthenticatedLayout>
</template>
