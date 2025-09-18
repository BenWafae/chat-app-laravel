/**
 * bootstrap.js - Configuration corrigée
 */

import _ from 'lodash';
window._ = _;

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Récupérer le token CSRF
const token = document.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.getAttribute('content');
}

/**
 * Laravel Echo + Pusher - Configuration corrigée
 */
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    wsHost: import.meta.env.VITE_PUSHER_HOST,
    wsPort: import.meta.env.VITE_PUSHER_PORT,
    wssPort: import.meta.env.VITE_PUSHER_PORT,
    forceTLS: false, // Important : false pour http local
    enabledTransports: ['ws', 'wss'],
    // Ajoutez ces options pour le debugging
    auth: {
        headers: {
            'Authorization': 'Bearer ' + (document.querySelector('meta[name="api-token"]')?.getAttribute('content') || ''),
        },
    },
    authEndpoint: '/broadcasting/auth',
});
