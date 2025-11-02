// controllers/catalogueController.js - Version avec Pagination

import router from '../routeur.js';
import detailOutilControlleur from "./detailOutilControlleur.js";

const catalogueController = {

    // Stock des produits pour le filtrage
    tousLesProduits: [],

    // Configuration pagination
    pagination: {
        produitsParPage: 9,
        pageActuelle: 1,
        totalPages: 1
    },

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

            // Mapper les données de l'api
            const produitsMappes = outils.map(outil => ({
                id: outil.id,
                nom: outil.nom,
                description: outil.desc,
                image: `${outil.image}`,
                prix: parseFloat(outil.tarif_journalier),
                stock: parseInt(outil.quantite_stock),
                disponible: parseInt(outil.quantite_stock) > 0
            }));

            // 💾 Stocker tous les produits pour le filtrage
            this.tousLesProduits = produitsMappes;

            // Calculer le nombre total de pages
            this.pagination.totalPages = Math.ceil(produitsMappes.length / this.pagination.produitsParPage);

            // Récupérer les produits de la page actuelle
            const produitsPagines = this.getProduitsPagines(produitsMappes);

            return {
                titre: 'Notre Catalogue d\'Outils',
                produits: produitsPagines,
                nombreProduits: produitsMappes.length,
                pagination: {
                    pageActuelle: this.pagination.pageActuelle,
                    totalPages: this.pagination.totalPages,
                    afficherPagination: this.pagination.totalPages > 1
                }
            };

        } catch (error) {
            console.error('Erreur pendant la récupération des données:', error);
            throw error;
        }
    },

    // Obtenir les produits pour la page actuelle
    getProduitsPagines(produits) {
        const debut = (this.pagination.pageActuelle - 1) * this.pagination.produitsParPage;
        const fin = debut + this.pagination.produitsParPage;
        return produits.slice(debut, fin);
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

    // Mettre à jour l'affichage avec les outils filtrés et paginés
    mettreAJourAffichage(produitsFiltres, resetPage = false) {
        const grid = document.querySelector('.produits-grid');
        const infoElement = document.querySelector('.catalogue-info');

        // Réinitialiser à la page 1 si demandé (lors d'une recherche)
        if (resetPage) {
            this.pagination.pageActuelle = 1;
        }

        // Calculer la pagination pour les produits filtrés
        this.pagination.totalPages = Math.ceil(produitsFiltres.length / this.pagination.produitsParPage);

        // S'assurer que la page actuelle est valide
        if (this.pagination.pageActuelle > this.pagination.totalPages && this.pagination.totalPages > 0) {
            this.pagination.pageActuelle = this.pagination.totalPages;
        }

        // Obtenir les produits de la page actuelle
        const produitsAfficher = this.getProduitsPagines(produitsFiltres);

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
            this.mettreAJourPagination(0);
            return;
        }

        // Générer le HTML des produits filtrés et paginés
        grid.innerHTML = produitsAfficher.map(produit => `
            <article class="produit-card" data-product-id="${produit.id}">
                <div class="produit-image-container">
                    <img
                        src="${produit.image}"
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

        // Mettre à jour l'affichage de la pagination
        this.mettreAJourPagination(produitsFiltres.length);

        // Réattacher les événements sur les nouvelles cartes
        this.attacherEvenementsCartes();

        window.scrollTo({ top: 0, behavior: 'smooth' });
    },

    // Mettre à jour l'affichage de la pagination
    mettreAJourPagination(totalProduits) {
        const paginationContainer = document.querySelector('.pagination-container');

        if (!paginationContainer) return;

        const totalPages = Math.ceil(totalProduits / this.pagination.produitsParPage);

        paginationContainer.style.display = 'flex';

        const btnPrecedent = paginationContainer.querySelector('.btn-precedent');
        const btnSuivant = paginationContainer.querySelector('.btn-suivant');
        const pageInfo = paginationContainer.querySelector('.page-info');

        // Mettre à jour le texte
        pageInfo.textContent = `Page ${this.pagination.pageActuelle} sur ${totalPages}`;},

    // Changer de page
    changerPage(direction) {
        const searchBox = document.getElementById('search-box');
        const recherche = searchBox ? searchBox.value : '';
        const produitsFiltres = this.filtrerProduits(recherche);

        if (direction === 'suivant' && this.pagination.pageActuelle < this.pagination.totalPages) {
            this.pagination.pageActuelle++;
        } else if (direction === 'precedent' && this.pagination.pageActuelle > 1) {
            this.pagination.pageActuelle--;
        }

        this.mettreAJourAffichage(produitsFiltres, false);
    },

    // Événements de clic sur les cartes produits
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
        // Event de recherche dynamique
        const searchBox = document.getElementById('search-box');
        if (searchBox) {
            searchBox.addEventListener('input', (e) => {
                const recherche = e.target.value;
                const produitsFiltres = this.filtrerProduits(recherche);
                this.mettreAJourAffichage(produitsFiltres, true); // Reset à la page 1
            });
        }

        // Événements de pagination
        const btnPrecedent = document.querySelector('.btn-precedent');
        const btnSuivant = document.querySelector('.btn-suivant');

        if (btnPrecedent) {
            btnPrecedent.addEventListener('click', () => {
                this.changerPage('precedent');
            });
        }

        if (btnSuivant) {
            btnSuivant.addEventListener('click', () => {
                this.changerPage('suivant');
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
            // Réinitialiser la pagination
            this.pagination.pageActuelle = 1;

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