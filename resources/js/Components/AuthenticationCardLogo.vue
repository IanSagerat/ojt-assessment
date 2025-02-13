<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<style scoped>
.logo{
    font-size: 30px;
    font-family: Audiowide;
}
li{
    color:white;
    list-style: none;
}
</style>
<template>
    <Link :href="'/'">
        <li class="logo">
                <a href="#navigation"><span class="inno">Inno</span>Tek</a>
            </li> </Link>
</template>
<link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
