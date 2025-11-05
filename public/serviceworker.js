const CACHE_NAME = 'thermowatch-v1';
const urlsToCache = [
    '/',
    '/index.html',
    '/styles.css',
    '/app.js',
    '/manifest.json',
    '/icons/AppImages/android', // Ejemplo de carpeta de iconos android
    '/icons/AppImages/windows11' // Ejemplo de carpeta de iconos pc
];

// 1. Instalación: Abre una caché y agrega todos los recursos esenciales (App Shell)
self.addEventListener('install', event => {
    console.log('Service Worker: Instalando y precargando recursos...');
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                return cache.addAll(urlsToCache);
            })
    );
});

// 2. Activación: Limpia las cachés viejas para que la app siempre use la versión más reciente
self.addEventListener('activate', event => {
    console.log('Service Worker: Activado. Limpiando cachés antiguas.');
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        // Elimina cachés que no están en la lista blanca
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// 3. Fetch (Solicitudes de red): Estrategia Cache-First (cache, luego red)
self.addEventListener('fetch', event => {
    // Ignora solicitudes que no sean GET o que sean de extensiones
    if (event.request.method !== 'GET' || event.request.url.includes('chrome-extension')) return;

    event.respondWith(
        caches.match(event.request)
            .then(response => {
                // Si el recurso está en la caché, lo devuelve inmediatamente (cache-first)
                if (response) {
                    return response;
                }

                // Si no está en caché, va a la red
                return fetch(event.request).then(
                    response => {
                        // Verifica si hemos recibido una respuesta válida (no error 404/500)
                        if (!response || response.status !== 200 || response.type !== 'basic') {
                            return response;
                        }

                        // Clona la respuesta antes de ponerla en caché (una respuesta solo se puede leer una vez)
                        const responseToCache = response.clone();

                        // Agrega la nueva respuesta a la caché para futuros usos
                        caches.open(CACHE_NAME)
                            .then(cache => {
                                cache.put(event.request, responseToCache);
                            });

                        return response;
                    }
                );
            })
    );
});