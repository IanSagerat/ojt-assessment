<template>
    <div class="container">
        <Navbar />
        <Banner />
        <ServicesInfo />
        <ServicesOffer />
        <Contact />
        <Footer />
    </div>
</template>

<script>
import Navbar from "@/Components/Navbar.vue";
import Banner from "@/Components/BannerLanding.vue";
import ServicesInfo from "@/Components/ServiceInfo.vue";
import ServicesOffer from "@/Components/ServiceOffer.vue";
import Contact from "@/Components/Contact.vue";
import Footer from "@/Components/Footer.vue";

export default {
    components: {
        Navbar,
        Banner,
        ServicesInfo,
        ServicesOffer,
        Contact,
        Footer,
    },
};
</script>
