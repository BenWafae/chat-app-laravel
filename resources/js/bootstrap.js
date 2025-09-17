/**
 * bootstrap.js
 * Configuration initiale du front-end Laravel avec Vite
 */

import _ from 'lodash';
window._ = _;

/**
 * Axios
 * Permet d'effectuer facilement des requêtes HTTP vers Laravel
 * avec gestion automatique du CSRF token
 */
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Laravel Echo + Pusher
 * Permet d'écouter les événements broadcastés en temps réel via WebSockets
 */
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Rendre Pusher disponible globalement
window.Pusher = Pusher;

// Initialisation de Laravel Echo
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,                   // clé Pusher depuis .env
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',  // cluster Pusher
    wsHost: import.meta.env.VITE_PUSHER_HOST ?? window.location.hostname, // serveur WebSocket
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 6001,           // port WebSocket
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 6001,          // port WebSocket sécurisé
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'http') === 'https', // HTTPS ?
    enabledTransports: ['ws', 'wss'],                          // types de transport
});

