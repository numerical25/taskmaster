
import './bootstrap';
// Import Tailwind CSS and JavaScript
import {createApp} from 'vue';
import App from './App.vue';
import routes from './routes.js';
import router from "./routes.js";

const app = createApp(App);
app.use(routes);
router.isReady().then(() => app.mount('#app'))
