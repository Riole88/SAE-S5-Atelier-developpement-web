const catalogueController = {

    async chargerTemplate() {
        const response = await fetch('templates/pages/catalogue.hbs');
        const html = await response.text();
        return Handlebars.compile(html);
    },

    async recupererDonnees() {
        try {
            const response = await fetch('/api/outils');
            const produits = await response.json();
            return {
                titre: 'Notre Catalogue',
                produits: produits
            };
        } catch (error) {
            console.error('Erreur:', error);
            return {
                titre: 'Catalogue',
                produits: [],
                erreur: 'Impossible de charger les produits'
            };
        }
    },

    ajouterEvenements() {
        const boutonsAjout = document.querySelectorAll('[data-add-cart]');
        boutonsAjout.forEach(bouton => {
            bouton.addEventListener('click', (e) => {
                const idProduit = e.target.dataset.productId;
                this.ajouterAuPanier(idProduit);
            });
        });
    },

    async ajouterAuPanier(idProduit) {
        try {
            await fetch('/api/panier/add', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ productId: idProduit })
            });
            alert('Produit ajouté au panier');
        } catch (error) {
            alert('Erreur ajout au panier');
        }
    },

    async afficher() {
        const app = document.getElementById('app');
        app.innerHTML = '<div class="loader">Chargement...</div>';

        try {
            const template = await this.chargerTemplate();
            const donnees = await this.recupererDonnees();
            const html = template(donnees);
            app.innerHTML = html;
            this.ajouterEvenements();

        } catch (error) {
            console.error('Erreur:', error);
            app.innerHTML = '<div class="error">Une erreur est survenue</div>';
        }
    }
};

export default catalogueController;
