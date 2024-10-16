import { createApp } from 'vue';
import { Quasar, Notify} from 'quasar';
import '@quasar/extras/material-icons/material-icons.css';
import 'quasar/dist/quasar.css';
import { createPinia } from 'pinia';

import App from './App.vue';

const app = createApp(App);

app.use(Quasar, {
    plugins: {
        Notify
    }
});

const pinia = createPinia();
app.use(pinia);

app.mount('#app');
