/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? "mt1",
    wsHost: import.meta.env.VITE_PUSHER_HOST
        ? import.meta.env.VITE_PUSHER_HOST
        : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"],
});

let reconnectAttempts = 0;
const maxReconnectAttempts = 10;

function closeWebSocketConnection() {
    console.warn('Closing WebSocket connection due to error.');
    window.Echo.connector.pusher.connection.disconnect();
    // Optionally, notify the user that the connection has been closed
}

window.Echo.connector.pusher.connection.bind('error', function(err) {
    console.error('WebSocket Error:', err);
    closeWebSocketConnection();
    // Optionally, show a user notification
});

window.Echo.connector.pusher.connection.bind('state_change', function(states) {
    console.log('Connection state change:', states.current);
    if (states.current === 'disconnected') {
        console.warn('WebSocket Disconnected. Attempting to reconnect...');
    }
});

window.Echo.connector.pusher.connection.bind('disconnected', function() {
    console.warn('WebSocket connection closed.');

    if (reconnectAttempts < maxReconnectAttempts) {
        setTimeout(() => {
            console.log('Attempting to reconnect...');
            window.Echo.connect();
            reconnectAttempts++;
        }, 2000); // Reconnect after 2 seconds
    } else {
        console.error('Max reconnection attempts reached.');
        // Notify the user about the failure to reconnect
    }
});

window.Echo.connector.pusher.connection.bind('connected', function() {
    console.log('WebSocket connection established.');
    reconnectAttempts = 0; // Reset attempts on successful connection
});