<script setup>
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    tags: Array,
});

const form = useForm({
    title: '',
    description: '',
    tags: [],
    author_id: 1,
    published_at: '',
})

const submit = () => {
    form.post(route('post.store'))
}

</script>

<template>
    <AuthenticatedLayout class="text-white">

        <form @submit.prevent="submit">

            <div>
                <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <TextInput v-model="form.title" required type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
            </div>

            <div class="mb-6">
                <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
                <TextInput v-model="form.description" required type="textarea" id="large-input" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
            </div>

            <div class="mb-6">
                <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">tags</label>
                <select name="tags" v-model="form.tags" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option v-for="tag in tags" :value="tag.id">{{ tag.name }}</option>
                </select>
            </div>

            <input class="text-black" type="date" v-model="form.published_at">

            <input type="submit" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">

        </form>

    </AuthenticatedLayout>
</template>
