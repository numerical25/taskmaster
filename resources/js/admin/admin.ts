
import '../bootstrap';
import {createApp} from 'vue';
import Admin from './Admin.vue';
import routes from './routes.ts';
import Vuex from 'vuex'
import {Cart} from "../store/Cart.ts";
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import 'primevue/resources/themes/tailwind-light/theme.css';
import '/node_modules/primeflex/primeflex.css';

const app = createApp(Admin);
app.use(PrimeVue);
app.use(routes);
app.use(Vuex);
app.use(ToastService);
Cart.subscribe((mutation, state) => {
    localStorage.setItem('cart', JSON.stringify(state));
});
routes.isReady().then(() => app.mount('#app'));
