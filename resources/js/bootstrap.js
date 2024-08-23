/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Inisialisasi Pusher dan Echo
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

window.Echo.channel('paramedis').listen('ScreeningOfflineCreated', event => {
    console.log("Berhasil");
    console.log(event);
});
