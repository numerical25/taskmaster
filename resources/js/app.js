
import './bootstrap';
// Import Tailwind CSS and JavaScript
import {createApp} from 'vue';
import App from './App.vue';
import routes from './routes.js';
import router from "./routes.js";
import Vuex from 'vuex'
import {Cart} from "./store/Cart.js";

const app = createApp(App);
app.use(routes);
app.use(Vuex);
Cart.subscribe((mutation, state) => {
    // Store the state object as a JSON string
    localStorage.setItem('cart', JSON.stringify(state));
});
router.isReady().then(() => app.mount('#app'))
