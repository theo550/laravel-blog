<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    post: String,
});

const form = useForm({})

const handleDelete = (id) => {
    form.delete(route('post.destroy', id))
}

</script>

<template>

    <h1>Title: {{ post.title }}</h1>
    <p>Content: {{ post.description }}</p>
    <p>Author: {{ post.user.name }}</p>
    <p>{{ post.published_at > Date.now() ? 'Will be published at ' : 'Published at ' }} : {{ post.published_at }}</p>
    <p v-if="post.tag.length > 0">tag: {{ post.tag[0].name }}</p>

    <form class="text-with" @submit.prevent="handleDelete(post.id)" action="delete">
        <input class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" type="submit" value="delete"/>
    </form>

</template>
