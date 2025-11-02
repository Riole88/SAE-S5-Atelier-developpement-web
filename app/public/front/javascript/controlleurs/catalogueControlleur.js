// controllers/catalogueController.js - Version Hash Routing

import router from '../routeur.js';
import detailOutilControlleur from "./detailOutilControlleur.js";

const catalogueController = {

    // Stock des pour le filtrage
    tousLesProduits: [],

    async chargerTemplate() {
        const response = await fetch('templates/pages/catalogue.hbs');
        if (!response.ok) {
            throw new Error('Impossible de charger le template catalogue');
        }
        const html = await response.text();
        return Handlebars.compile(html);
    },

    async recupererDonnees() {
        try {
            const response = await fetch('http://localhost:6080/outils');
            const outils = await response.json();

            //Mapper les données de l'api
            const produitsMappes = outils.map(outil => ({
                id: outil.id,
                nom: outil.nom,
                description: outil.desc,
                image: `assets/images/produits/${outil.image}`,
                prix: parseFloat(outil.tarif_journalier),
                stock: parseInt(outil.quantite_stock),
                disponible: parseInt(outil.quantite_stock) > 0
            }));

            // 💾 Stocker tous les produits pour le filtrage
            this.tousLesProduits = produitsMappes;

            return {
                titre: 'Notre Catalogue d\'Outils',
                produits: produitsMappes,
                nombreProduits: produitsMappes.length
            };

        } catch (error) {
            console.error('Erreur pendant la récupération des données:', error);
            throw error;
        }
    },

    // Filtrer les produits selon la recherche
    filtrerProduits(recherche) {
        if (!recherche || recherche.trim() === '') {
            return this.tousLesProduits;
        }

        const termeLowerCase = recherche.toLowerCase().trim();

        return this.tousLesProduits.filter(outil =>
            outil.nom.toLowerCase().includes(termeLowerCase)
        );
    },

    // mettre à jour l'affichage avec les outils filtres
    mettreAJourAffichage(produitsFiltres) {
        const grid = document.querySelector('.produits-grid');
        const infoElement = document.querySelector('.catalogue-info');

        // Mettre à jour le compteur
        if (infoElement) {
            infoElement.textContent = `${produitsFiltres.length} outil(s) disponible(s)`;
        }

        // Si aucun résultat
        if (produitsFiltres.length === 0) {
            grid.innerHTML = `
                <div class="no-results">
                    <p>Aucun outil ne correspond à votre recherche.</p>
                </div>
            `;
            return;
        }

        // Générer le HTML des produits filtrés
        grid.innerHTML = produitsFiltres.map(produit => `
            <article class="produit-card" data-product-id="${produit.id}">
                <div class="produit-image-container">
                    <img
                        src="assets/images/produits/${produit.image}"
                        alt="${produit.nom}"
                        class="produit-image">
                </div>

                <div class="produit-content">
                    <h3 class="produit-titre">${produit.nom}</h3>
                    <p class="produit-description">${produit.description}</p>

                    <div class="produit-footer">
                        <div class="produit-prix">
                            <span class="prix-label">Tarif journalier</span>
                            <div class="prix-stock-info">
                                <span class="prix-montant">${produit.prix} €/jour</span>
                                <span class="stock">reste ${produit.stock}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        `).join('');

        // Réattacher les événements sur les nouvelles cartes
        this.attacherEvenementsCartes();
    },

    // événements de clic sur les cartes produits
    attacherEvenementsCartes() {
        const liensDetail = document.querySelectorAll('.produit-card');
        liensDetail.forEach(lien => {
            lien.addEventListener('click', (e) => {
                e.preventDefault();
                const productId = lien.dataset.productId;
                if (!productId) {
                    console.error('Aucun ID produit trouvé sur cette carte.');
                    return;
                }
                router.add(`/detailOutil/${productId}`, detailOutilControlleur);
                router.goTo(`/detailOutil/${productId}`);
            });
        });
    },

    ajouterEvenements() {
        // event de recherche dynamique
        const searchBox = document.getElementById('search-box');
        if (searchBox) {
            searchBox.addEventListener('input', (e) => {
                const recherche = e.target.value;
                const produitsFiltres = this.filtrerProduits(recherche);
                this.mettreAJourAffichage(produitsFiltres);
            });
        }

        // Attacher les événements sur les cartes produits
        this.attacherEvenementsCartes();
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
            console.error('Erreur lors de l\'affichage:', error);
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