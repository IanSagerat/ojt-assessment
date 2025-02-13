import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});

window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".sticky");
    const serviceInfo = document.getElementById("serviceinfo");
    const serviceInfoOffset = serviceInfo.offsetTop;
    const scrollPosition = window.scrollY;

    if (scrollPosition >= serviceInfoOffset - 100) {
        navbar.style.top = "0";
    } else {
        navbar.style.top = "-70px";
    }
});
document.querySelectorAll(".sticky a").forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        const targetId = this.getAttribute("href").substring(1);
        const targetElement = document.getElementById(targetId);

        targetElement.scrollIntoView({
            behavior: "smooth",
            block: "start",
        });
    });
});
