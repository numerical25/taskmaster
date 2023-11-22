
import './bootstrap';
import {createApp} from 'vue';
import App from './App.vue';
import routes from './routes.ts';
import router from "./routes.ts";
import Vuex from 'vuex'
import {Cart} from "./store/Cart.ts";
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import 'primevue/resources/themes/tailwind-light/theme.css';

const app = createApp(App);
app.use(PrimeVue);
app.use(routes);
app.use(Vuex);
app.use(ToastService);
Cart.subscribe((mutation, state) => {
    localStorage.setItem('cart', JSON.stringify(state));
});
router.isReady().then(() => app.mount('#app'))
