// controllers/panierController.js
import auth from '../services/auth.js';
import router from "../routeur.js";

const panierController = {

    async chargerTemplate() {
        const response = await fetch('templates/pages/panier.hbs');
        if (!response.ok) {
            throw new Error('Impossible de charger le template panier');
        }
        const html = await response.text();
        return Handlebars.compile(html);
    },

    async recupererDonnees() {
        try {
            if (!auth.isAuthenticated()) {
                router.goTo('/connexion');
            }

            const idUser = auth.getUserId();

            const response = await fetch(`http://localhost:6080/paniers/${idUser}`, {
                method: 'GET',
                headers: auth.getAuthHeaders(),
                mode: 'cors'
            });

            if (!response.ok) {
                if (response.status === 401) {
                    auth.clearAuth();
                    router.goTo('/login');
                    throw new Error('Session expirée');
                }
                throw new Error('Erreur lors de la récupération du panier');
            }

            const panier = await response.json();
            const outils = panier[0].outils;

            if (outils.length === 0){
                return {
                    titre: 'Mon Panier',
                    articles: [],
                    total: 0,
                    nombreArticles: 0,
                    erreur: 'Panier vide'
                };
            }

            const articlesMappes = outils.map(item => ({
                id: item.outil.id,
                nom: item.outil.nom,
                description: item.outil.desc,
                image: `${item.outil.image}`,
                prix: parseFloat(item.outil.tarif_journalier),
                quantite: parseInt(item.quantite),
                prixQuantite: (parseFloat(item.quantite) * parseFloat(item.outil.tarif_journalier))
            }));


            const sommeTotale = articlesMappes.reduce((total, article) => {
                return total + article.prix * article.quantite;
            }, 0);


            return {
                titre: 'Mon Panier',
                articles: articlesMappes,
                total: sommeTotale,
                nombreArticles: panier.articles ? panier.articles.length : 0
            };

        } catch (error) {
            // Retourner un panier vide en cas d'erreur
            return {
                titre: 'Mon Panier',
                articles: [],
                total: 0,
                nombreArticles: 0,
                erreur: 'Impossible de charger le panier'
            };
        }
    },

    /*
    * -------------------------------------------
    * Création de tous les évenements de la page
    * ------------------------------------------
    * */

    ajouterEvenements() {
        // Boutons "Supprimer"
        const boutonsSuppression = document.querySelectorAll('[data-remove-item]');
        boutonsSuppression.forEach(bouton => {
            bouton.addEventListener('click', (e) => {
                const idArticle = e.target.dataset.itemId;
                this.supprimerArticle(idArticle);
            });
        });

        // Bouton "Vider le panier"
        const boutonVider = document.querySelector('[data-clear-cart]');
        if (boutonVider) {
            boutonVider.addEventListener('click', () => {
                this.viderPanier();
            });
        }

        // Bouton "Commander"
        const boutonCommander = document.querySelector('[data-commander]');
        if (boutonCommander) {
            boutonCommander.addEventListener('click', () => {
                this.commander();
            });
        }
    },


    // Methode de suppression d'un article du panier
    async supprimerArticle(idArticle) {
        try {
            const response = await fetch(`http://localhost:6080/panier/.....`, {
                method: 'DELETE'
            });

            if (!response.ok) {
                throw new Error('Erreur lors de la suppression');
            }
            // Recharger le panier
            await this.afficher();

        } catch (error) {
            alert('Erreur lors de la suppression de l\'article');
        }
    },

    // Methode de vidage du panier
    async viderPanier() {
        if (!confirm('Êtes-vous sûr de vouloir vider votre panier ?')) {
            return;
        }

        try {
            const response = await fetch('http://localhost:6080/panier......', {
                method: 'DELETE'
            });

            if (!response.ok) {
                throw new Error('Erreur lors du vidage du panier');
            }
            // Recharger le panier
            await this.afficher();

        } catch (error) {
            alert('Erreur lors du vidage du panier');
        }
    },


    // Methode de redirection vers la page de commande/réservation
    commander() {
        // Rediriger vers la page de commande
        router.goTo('/checkout');
    },

    async afficher() {
        const app = document.getElementById('app');

        // Loader
        app.innerHTML = `
            <div class="loader-container">
                <div class="loader"></div>
                <p>Chargement du panier...</p>
            </div>
        `;

        try {
            const template = await this.chargerTemplate();
            const donnees = await this.recupererDonnees();

            const html = template(donnees);
            app.innerHTML = html;

            this.ajouterEvenements();

        } catch (error) {
            console.error('erreur affichage panier:', error);
            app.innerHTML = `
                <div class="error-container">
                    <h2>Une erreur est survenue</h2>
                    <p>${error.message}</p>
                </div>
            `;
        }
    }
};

export default panierController;