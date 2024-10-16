import { createApp } from 'vue';
import { Quasar, Notify, Dialog} from 'quasar';
import '@quasar/extras/material-icons/material-icons.css';
import 'quasar/dist/quasar.css';
import { createPinia } from 'pinia';

import App from './App.vue';

const app = createApp(App);

app.use(Quasar, {
    plugins: {
        Notify,
        Dialog
    }
});

const pinia = createPinia();
app.use(pinia);

app.mount('#app');
