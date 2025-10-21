// controllers/catalogueController.js - Version avec API

const catalogueController = {

    async chargerTemplate() {
        const response = await fetch('templates/pages/catalogue.hbs');
        const html = await response.text();
        return Handlebars.compile(html);
    },

    async recupererDonnees() {
        try {
            const response = await fetch('http://localhost:6080/outils');

            // Vérifier si la réponse est OK
            if (!response.ok) {
                throw new Error(`Erreur HTTP: ${response.status}`);
            }

            const outils = await response.json();

            console.log('✅ Données reçues de l\'API:', outils);

            // 🎯 Mapper les données de l'API vers le format attendu par le template
            const produitsMappes = outils.map(outil => ({
                id: outil.id,
                nom: outil.nom,
                description: outil.desc,  // desc → description
                image: `/assets/images/products/${outil.image}`,
                prix: parseFloat(outil.tarif_journalier),
                stock: parseInt(outil.quantite_stock),
                disponible: parseInt(outil.quantite_stock) > 0
            }));

            return {
                titre: 'Notre Catalogue d\'Outils',
                produits: produitsMappes,
                nombreProduits: produitsMappes.length
            };

        } catch (error) {
            console.error('❌ Erreur lors de la récupération des données:', error);
            return {
                titre: 'Catalogue',
                produits: [],
                erreur: 'Impossible de charger les produits. Vérifiez que l\'API est démarrée.'
            };
        }
    },

    ajouterEvenements() {
        // Boutons "Ajouter au panier"
        const boutonsAjout = document.querySelectorAll('[data-add-cart]');
        boutonsAjout.forEach(bouton => {
            bouton.addEventListener('click', (e) => {
                const idProduit = e.target.dataset.productId;
                this.ajouterAuPanier(idProduit);
            });
        });

        // Liens vers les détails des produits
        const liensDetail = document.querySelectorAll('[data-product-detail]');
        liensDetail.forEach(lien => {
            lien.addEventListener('click', (e) => {
                e.preventDefault();
                const idProduit = e.target.dataset.productId;
                router.goTo(`/produit/${idProduit}`);
            });
        });
    },

    async ajouterAuPanier(idProduit) {
        try {
            const response = await fetch('http://localhost:6080/panier/ajouter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    outil_id: idProduit,
                    quantite: 1
                })
            });

            if (!response.ok) {
                throw new Error('Erreur lors de l\'ajout au panier');
            }

            const data = await response.json();
            console.log('✅ Produit ajouté au panier:', data);

            this.afficherNotification('Produit ajouté au panier !', 'success');

        } catch (error) {
            console.error('❌ Erreur ajout au panier:', error);
            this.afficherNotification('Erreur lors de l\'ajout au panier', 'error');
        }
    },

    afficherNotification(message, type) {
        // Créer une notification simple
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.textContent = message;
        document.body.appendChild(notification);

        // Retirer après 2 secondes
        setTimeout(() => {
            notification.remove();
        }, 2000);
    },

    async afficher() {
        const app = document.getElementById('app');

        // Loader avec animation
        app.innerHTML = `
            <div class="loader-container">
                <div class="loader"></div>
                <p>Chargement du catalogue...</p>
            </div>
        `;

        try {
            const template = await this.chargerTemplate();
            const donnees = await this.recupererDonnees();

            const html = template(donnees);
            app.innerHTML = html;

            this.ajouterEvenements();

        } catch (error) {
            app.innerHTML = `
                <div class="error-container">
                    <h2>Une erreur est survenue</h2>
                    <p>${error.message}</p>
                    <button onclick="location.reload()" class="btn-primary">
                        Recharger la page
                    </button>
                </div>
            `;
        }
    }
};

export default catalogueController;