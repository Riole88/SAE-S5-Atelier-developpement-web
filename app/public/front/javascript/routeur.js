// routeur.js
const routes = {};

const router = {
    add: (path, controller) => {
        routes[path] = controller;
    },
    init: () => {
        // Écoute les changements de hash dans l'URL
        window.addEventListener('hashchange', router.loadRoute);

        // Charger la route initiale
        router.loadRoute();
    },
    loadRoute: () => {
        const path = location.hash.slice(1) || '/';
        const controller = routes[path];
        if (controller) {
            controller();
        } else {
            document.getElementById('app').innerHTML =
                '<div class="error">Page non trouvée</div>';
        }
    }
};

export default router;
