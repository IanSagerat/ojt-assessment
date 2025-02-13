<script setup>
import { computed } from "vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import optionSide from "@/Components/DropDownset.vue";
defineProps({
    title: String,
});
const user = computed(() => usePage().props.auth.user);
</script>
<template>
    <nav class="navbar" id="navigation">
        <ul>
            <li class="logo">
                <a href="#navigation"><span class="inno">Inno</span>Tek</a>
            </li>
            <li class="active"><a href="#navigation">Home</a></li>
            <li><a href="#serviceinfo">Services</a></li>
            <li><a href="#contact">Contact Us</a></li>

            <li v-if="user">
                <div class="flex items-center justify-between mt-1 mr-10">
                    <optionSide></optionSide>
                </div>
            </li>

            <li v-else>
                <Link :href="route('login')" class="login">Login</Link>
            </li>
        </ul>
    </nav>
    <nav id="navigation" class="sticky">
        <ul>
            <li class="logo">
                <a href="#navigation"><span class="inno">Inno</span>Tek</a>
            </li>
            <li class="active"><a href="#navigation">Home</a></li>
            <li><a href="#serviceinfo">Services</a></li>
            <li><a href="#contact">Contact Us</a></li>

            <li v-if="user">
                <div class="flex items-center justify-between mt-1 mr-10">
                    <optionSide></optionSide>
                </div>
            </li>

            <li v-else>
                <Link :href="route('login')" class="login">Login</Link>
            </li>
        </ul>
    </nav>
</template>
