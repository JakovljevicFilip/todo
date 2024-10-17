import axios from 'axios';
import { Notify } from 'quasar';

axios.interceptors.response.use(
    (response) => {
        if (response.status === 200) {
            return response;
        }
        Notify.create({
            type: 'positive',
            message: 'Success',
        });
        return response;
    },
    (error) => {
        if (error.response) {
            const status = error.response.status;

            if (status >= 400 && status < 500) {
                Notify.create({
                    type: 'negative',
                    message: 'Bad request. Please check your input.',
                });
            } else if (status >= 500) {
                Notify.create({
                    type: 'negative',
                    message: 'There was an error. Try again later.',
                });
            }
        } else {
            Notify.create({
                type: 'negative',
                message: 'Network error. Please check your connection.',
            });
        }
        return Promise.reject(error);
    }
);
