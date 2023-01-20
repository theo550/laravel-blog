<script setup>
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    id: Number,
});

const form = useForm({
    title: '',
    description: '',
    author_id: 1,
})

const submit = () => {
    form.put(route('post.update', form))
}

</script>

<template>
    <AuthenticatedLayout >

        <h1 class="text-white">Edit post</h1>
        <form @submit.prevent="submit">


            <input type="text" placeholder="title">
            <textarea type="text" placeholder="content"/>

            <input type="submit" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">

        </form>

</AuthenticatedLayout>
</template>
