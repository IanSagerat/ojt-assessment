<script setup>
import { usePage } from "@inertiajs/vue3";

defineProps({
    post: Object,
});

defineEmits(["delete", "edit"]);

const user = usePage().props.auth.user;
</script>

<template>
    <div
        @click="$emit('edit', post)"
        class="bg-white w-86 h-72 rounded-xl p-6 shadow-sm flex flex-col justify-between cursor-pointer hover:bg-gray-100 transition"
    >
        <div>
            <h3 class="text-lg font-bold">{{ post.title }}</h3>
            <p class="text-sm text-gray-500">{{ post.type.toUpperCase() }}</p>
            <p
                class="mt-2 text-gray-700 break-words whitespace-normal overflow-hidden text-ellipsis line-clamp-5"
            >
                {{ post.message }}
            </p>
        </div>
        <div class="flex justify-between mt-4">
            <p class="text-xs text-gray-400">
                Author: {{ post.author?.name }}
                {{ post.author?.lastname }}
            </p>
            <div v-if="user.id === post.author?.id" class="flex space-x-2">
                <button
                    @click.stop="$emit('edit', post)"
                    class="text-blue-500 hover:underline text-sm"
                >
                    Edit
                </button>
                <button
                    @click.stop="$emit('delete')"
                    class="text-red-500 hover:underline text-sm"
                >
                    Delete
                </button>
            </div>
        </div>
    </div>
</template>
