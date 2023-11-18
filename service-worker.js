const cacheVersion = 'v2';
const cacheName = `stylesheets-cache-${cacheVersion}`;

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(cacheName).then(cache => {
      return cache.addAll([
        '/',
        '/css/styles.css',
        '/js/main.js',
        '/temp/',
        '/sign/',
        '/public/css/',
      ]);
    })
  );
});

self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cache => {
          if (cache !== cacheName) {
            return caches.delete(cache);
          }
        })
      );
    })
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request).then(response => {
      return response || fetch(event.request).then(fetchResponse => {
        // Cache the fetched resource for future use
        caches.open(cacheName).then(cache => {
          cache.put(event.request, fetchResponse.clone());
        });
        return fetchResponse;
      });
    })
  );
});
