const router = {
    routes: {},

    // ajouter une route au routuer
    add(path, controller) {
        this.routes[path] = controller;
    },

    // Naviguer vers une route
    goTo(path) {
        // Changer le hash dans l'URL
        window.location.hash = path;
    },

    // Charger la route actuelle
    loadRoute() {
        const hash = window.location.hash.slice(1) || '/';

        // Routes exactes
        if (this.routes[hash]) {
            if (this.routes[hash].afficher.length > 0) {
                for (const path in this.routes) {
                    if (path.startsWith('/detailOutil/')) {
                        const id = hash.split('/')[2];
                        this.routes[path].afficher(id);
                    }
                }
            } else {
                this.routes[hash].afficher();
            }
            return;
        }

        // 404
        console.error(`Route non trouvée: ${hash}`);
        document.getElementById('app').innerHTML = `
        <div class="error-container">
            <h1>404</h1>
            <h2>Page non trouvée</h2>
            <a href="#/" class="btn-primary">Retour à l'accueil</a>
        </div>
    `;
    },

    // Initialiser le router
    init() {
        // on ecouteles changements de hash
        window.addEventListener('hashchange', () => {
            this.loadRoute();
        });

        // puis on intercepter les clics sur les liens
        document.addEventListener('click', (e) => {
            const link = e.target.closest('[data-link]');
            if (link) {
                e.preventDefault();
                const href = link.getAttribute('href');
                this.goTo(href);
            }
        });
        this.loadRoute();
    }
};

export default router;