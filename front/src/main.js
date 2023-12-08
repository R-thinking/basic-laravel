import Vue from "vue";
import { provide } from "vue";
/* import { createPinia, PiniaVuePlugin } from 'pinia';
import { createPersistedState } from 'pinia-plugin-persistedstate';
import VueI18n from 'vue-i18n'; */
import App from "./App.vue";
// import router from "../routes/router";

/* const env = process.env.NODE_ENV;
if (env === "mock") {
    const { worker } = require("../../mocks/browser");
    worker.start();
} */

/* Vue.use(PiniaVuePlugin);
const pinia = createPinia();
pinia.use(
  createPersistedState({
    storage: localStorage,
  })
); */

/* Vue.use(VueI18n);
const i18n = new VueI18n({
  locale: 'ko',
  fallbackLocale: 'ko',
  messages: { en, ko },
}); */

new Vue({
    el: "#app",
    /* pinia,
  router,
  i18n, */
    render: (h) => h(App),
    setup() {
        /*  provide('router', router);
    provide('i18n', i18n); */
    },
});
