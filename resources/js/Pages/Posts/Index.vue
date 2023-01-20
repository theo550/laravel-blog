<script setup>
import NavLink from '@/Components/NavLink.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    posts: String
});


</script>
<template>
    <AuthenticatedLayout>
        <div class="flex flex-col">
            <NavLink :href="route('post.show', post.id)" class="text-white flex" v-for="post in posts">
                <p class="mx-6">{{ post.title }}</p>
                <p class="mx-6">{{ post.published_at }}</p>
                <p class="mx-6">{{ post.user.name }}</p>
            </NavLink>
        </div>
    </AuthenticatedLayout>
</template>
