
import './bootstrap';
import {createApp} from 'vue';
import App from './App.vue';
import routes from './routes.ts';
import Vuex from 'vuex'
import {Cart} from "./store/Cart.ts";
import PrimeVue from 'primevue/config';
import Ripple from 'primevue/ripple';
import ToastService from 'primevue/toastservice';
import 'primevue/resources/themes/tailwind-light/theme.css';
import '/node_modules/primeflex/primeflex.css';

const app = createApp(App);
app.directive('ripple', Ripple);
app.use(PrimeVue, {ripple: true});
app.use(routes);
app.use(Vuex);
app.use(ToastService);
Cart.subscribe((mutation, state) => {
    localStorage.setItem('cart', JSON.stringify(state));
});
routes.isReady().then(() => app.mount('#app'))
