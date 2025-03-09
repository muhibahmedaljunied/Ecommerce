require("./bootstrap");

window.Vue = require("vue"); //import vue same as(import Vue from 'vue')

import VueRouter from "vue-router"; //import vue router
import VueAxios from "vue-axios";
import axios from "axios";
window.axios.defaults.baseURL = "http://localhost/Ecommerce";
// ---------------------------- sweetalert ---------------------------------------------------------
import swal from "sweetalert2";

// ----------------

window.checkAndAttachMapScript = function (callback) {
    let scriptId = "map-api-script";
    let mapAlreadyAttached = !!document.getElementById(scriptId);

    if (mapAlreadyAttached) {
        if (window.google)
            // Script attached but may not finished loading; so check for 'google' object.
            callback();
    } else {
        window.mapApiInitialized = callback;

        let script = document.createElement("script");
        script.id = scriptId;
        script.src =
            "https://maps.googleapis.com/maps/api/js?key=AIzaSyAgDyMQ54mW-EHsTaFTnWd0XorOOvdDR34&libraries=places,geometry&callback=mapApiInitialized";
        document.body.appendChild(script);
    }

    return mapAlreadyAttached;
};
// ---------------

window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: "top-center",
    showConfirmButton: false,
    timer: 3000,
});
window.toast = toast;
// ------------------------------------------------------------------------------------------------
Vue.use(VueAxios, axios);
Vue.use(VueRouter);
// ---------------------------------------------------------------------------------------
import Vuex from "vuex"; //import vuex
Vue.use(Vuex);

import VueProgressBar from "vue-progressbar";
Vue.use(VueProgressBar, {
    color: "#007bff",
    failedColor: "red",
    thickness: "7px",
    transition: {
        speed: "0.2s",
        opacity: "0.6s",
        termination: 300,
    },
    autoRevert: true,
    location: "top",
    inverse: false,
});

import storeData from "./store/store.js";
const store = new Vuex.Store(storeData);
// -------------------------------------------------------------------------------------------------
Vue.component(
    "footer-section",
    require("./components/admin/layouts/Footer.vue").default
);
Vue.component(
    "main-header",
    require("./components/admin/layouts/MainHeader.vue").default
);
Vue.component(
    "main-sidebar",
    require("./components/admin/layouts/MainSidebar.vue").default
);
Vue.component(
    "page-header",
    require("./components/admin/layouts/PageHeader.vue").default
);
Vue.component(
    "sidebar-section",
    require("./components/admin/layouts/Sidebar.vue").default
);
Vue.component("dashboard", require("./components/Dashboard.vue").default);
// --------------------------------------this for customer-----------------------------------------------------
Vue.component(
    "footer-section-customer",
    require("./components/customer/layouts/Footer.vue").default
);
Vue.component(
    "header-section-customer",
    require("./components/customer/layouts/Header.vue").default
);
Vue.component(
    "home-section-customer",
    require("./components/customer/layouts/Home.vue").default
);

//all vue routes from routes.js file
import routes from "./routes.js";

//router instance and pass the `routes` option
const router = new VueRouter({
    base: "/Ecommerce/",
    routes,
    mode: "history",
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { x: 0, y: 0 };
        }
    },
});

//vue instance
const app = new Vue({
    el: "#app",
    data: {
        logo: "Dashboard",
    },
    router,
    store,
});
// window.Laravel.csrfToken = {{ csrf_token() }};
