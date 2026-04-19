import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

console.log('JS KELOAD 🔥');

// ✅ INIT ECHO
window.Echo = new Echo({
    broadcaster: 'reverb',
    key: 'ke1bmilftbdssohf3opw',
    wsHost: '127.0.0.1',
    wsPort: 8080,
    forceTLS: false,
    disableStats: true,
});

// ✅ TEST CONNECT
window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('CONNECTED 🔥');
});

// 🔊 AUDIO (GLOBAL)
let sound = document.getElementById('notif-sound');

// 🔓 UNLOCK AUDIO (HARUS DI LUAR)
document.addEventListener('click', () => {
    if (sound) {
        sound.play().then(() => {
            sound.pause();
            sound.currentTime = 0;
            console.log('Audio unlocked 🔊');
        }).catch(() => {});
    }
}, { once: true });

// ⚡ REALTIME EVENT
window.Echo.channel('notif-channel')
.listen('.notif-event', (e) => {

    console.log('EVENT MASUK 🔥:', e);

    let container = document.getElementById('notif-container');
    let list = document.getElementById('notif-list'); // ✅ FIX

    // 📢 POPUP
    if (container) {
        let notif = document.createElement('div');
        notif.innerHTML = `🔔 ${e.pesan}`;
        notif.style.padding = '10px';
        notif.style.marginBottom = '5px';
        notif.style.borderRadius = '6px'; 
        notif.style.background = '#1e293b';
        notif.style.boxShadow = '0 10px 25px rgba(0,0,0,0.2)';
        notif.style.animation = 'fadeIn 0.3s ease';
        container.prepend(notif);
    }

    // 📜 DROPDOWN LIST
    if (list) {
        let item = document.createElement('div');

        item.innerHTML = `
            <div>🔴 🔔 ${e.pesan}</div>
            <small>baru saja</small>
        `;

        item.style.padding = '10px';
        item.style.borderBottom = '1px solid #eee';

        list.prepend(item);
    }

    // 🔊 SOUND (FIX)
    if (sound) {
        sound.currentTime = 0;
        sound.play()
            .then(() => console.log('SUARA DIPUTAR 🔊'))
            .catch(err => console.log('AUDIO ERROR:', err));
    }

});