<script setup>
import { ref, computed } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Card from "@/Components/PostCards.vue";
import Logo from "@/Components/AuthenticationCardLogo.vue";
import sideOption from "@/Components/DropDownset.vue";

const page = usePage();
const user = computed(
    () => page.props.auth.user || { id: null, name: "Guest" }
);
const posts = computed(() => page.props.posts || []);

const searchQuery = ref("");
const filteredPosts = computed(() => {
    return posts.value.filter((post) =>
        post.title.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const isModalOpen = ref(false);
const isViewing = ref(false);
const isEditing = ref(false);
const post = ref({
    title: "",
    type: "news",
    message: "",
    author: computed(() => user.value.id),
});
const postId = ref(null);

const openCreateModal = () => {
    post.value = {
        title: "",
        type: "news",
        message: "",
        author: user.value.id,
    };
    postId.value = null;
    isEditing.value = false;
    isViewing.value = false;
    isModalOpen.value = true;
};

const openEditModal = (existingPost) => {
    post.value = { ...existingPost };
    postId.value = existingPost.id;
    isEditing.value = true;
    isViewing.value = false;
    isModalOpen.value = true;
};

const openViewModal = (existingPost) => {
    post.value = { ...existingPost };
    postId.value = existingPost.id;
    isViewing.value = true;
    isEditing.value = false;
    isModalOpen.value = true;
};

const submitPost = () => {
    if (isEditing.value) {
        router.put(route("posts.update", postId.value), post.value, {
            onSuccess: () => {
                isModalOpen.value = false;
            },
        });
    } else {
        router.post(router("posts.store"), post.value, {
            onSuccess: () => {
                isModalOpen.value = false;
            },
        });
    }
};

const deletePost = (id) => {
    if (confirm("Are you sure you want to delete this post?")) {
        router.delete(route("posts.destroy", id));
    }
};
</script>

<template>
    <div class="container">
        <AppLayout title="Dashboard">
            <template #header>
                <div class="flex items-center justify-between">
                    <Logo></Logo>
                    <sideOption></sideOption>
                </div>
            </template>
            <div class="py-5">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center">
                        <form
                            @submit.prevent
                            role="search"
                            class="relative flex items-center"
                        >
                            <label for="search" class="sr-only"
                                >Search for posts</label
                            >
                            <input
                                id="search"
                                v-model="searchQuery"
                                type="search"
                                placeholder="Search..."
                                autofocus
                                required
                                class="w-80 h-12 px-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-300"
                            />
                            <button
                                type="submit"
                                class="ml-2 px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-white hover:text-black transition"
                            >
                                Go
                            </button>
                        </form>
                        <div class="w-[100%] flex justify-end items-left py-5">
                            <button
                                @click="openCreateModal"
                                class="border p-2 hover:bg-gray-100 rounded-md"
                            >
                                Create Post
                            </button>
                        </div>
                    </div>

                    <!-- Display filtered posts -->
                    <div class="grid grid-cols-3 gap-3">
                        <Card
                            v-for="post in filteredPosts"
                            :key="post.id"
                            :post="post"
                            @click="openViewModal(post)"
                            @delete="deletePost(post.id)"
                            @edit="openEditModal(post)"
                        />
                    </div>
                </div>
            </div>

            <!-- Modal (Create, Edit, View) -->
            <div
                v-if="isModalOpen"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
            >
                <div
                    class="bg-white p-6 rounded-lg shadow-lg w-[600px] max-w-2xl"
                >
                    <h2 class="text-xl font-semibold mb-4">
                        {{
                            isViewing
                                ? "Post Details"
                                : isEditing
                                ? "Edit Post"
                                : "What's on your mind?"
                        }}
                    </h2>

                    <!-- View Mode -->
                    <div v-if="isViewing">
                        <p class="text-gray-700">
                            <strong>Title:</strong> {{ post.title }}
                        </p>
                        <p class="text-gray-500">
                            <strong>Type:</strong> {{ post.type.toUpperCase() }}
                        </p>
                        <div
                            class="mt-4 text-gray-700 break-words whitespace-pre-wrap max-h-60 overflow-y-auto p-2 border rounded"
                        >
                            <strong>Message:</strong> {{ post.message }}
                        </div>
                        <p class="mt-4 text-xs text-gray-400">
                            Posted by {{ post.author?.name || "Unknown" }}
                        </p>

                        <!-- Back Button -->
                        <div class="mt-4 flex justify-end">
                            <button
                                @click="isModalOpen = false"
                                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
                            >
                                Back
                            </button>
                        </div>
                    </div>

                    <!-- Create/Edit Mode -->
                    <form v-else @submit.prevent="submitPost">
                        <label class="block text-gray-700">Title</label>
                        <input
                            type="text"
                            v-model="post.title"
                            class="w-full p-2 border rounded-md mb-3"
                            placeholder="Title"
                            required
                        />

                        <label class="block text-gray-700">Type</label>
                        <select
                            v-model="post.type"
                            class="w-full p-2 border rounded-md mb-3"
                        >
                            <option value="news">News</option>
                            <option value="update">Update</option>
                            <option value="task">Task</option>
                        </select>

                        <label class="block text-gray-700">Message</label>
                        <textarea
                            v-model="post.message"
                            class="w-full p-2 border rounded-md mb-3 h-32 resize-none"
                            placeholder="Write your message here"
                            required
                        ></textarea>

                        <input type="hidden" v-model="post.author" />

                        <div class="mt-4 flex justify-end gap-2">
                            <button
                                @click="isModalOpen = false"
                                type="button"
                                class="px-4 py-2 bg-gray-500 text-white rounded"
                            >
                                Close
                            </button>
                            <button
                                v-if="!isViewing"
                                type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                            >
                                {{ isEditing ? "Update" : "Submit" }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </AppLayout>
    </div>
</template>
