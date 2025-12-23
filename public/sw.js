const CACHE_NAME = "E-Layak-v1"; // Gunakan versi agar mudah update nantinya
const urlsToCache = ["/", "/manifest.json"]; // Sederhanakan agar tidak 404

self.addEventListener("install", (event) => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            // Gunakan catch agar jika satu file gagal, yang lain tetap tersimpan
            return cache.addAll(urlsToCache).catch(err => console.log("Gagal simpan cache:", err));
        })
    );
});

self.addEventListener("activate", (event) => {
    event.waitUntil(
        caches.keys().then((names) =>
            Promise.all(
                names.map((name) => {
                    if (name !== CACHE_NAME) {
                        return caches.delete(name);
                    }
                })
            )
        )
    );
    return self.clients.claim();
});

self.addEventListener("fetch", (event) => {
    // Hanya tangani request GET dan pastikan dari domain yang sama
    if (event.request.method !== "GET" || !event.request.url.startsWith(self.location.origin)) {
        return;
    }

    event.respondWith(
        fetch(event.request)
            .then((networkResponse) => {
                return networkResponse;
            })
            .catch(() => {
                return caches.match(event.request);
            })
    );
});
