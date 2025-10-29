import auth from '../services/auth.js';
import router from "../routeur.js";
import detailOutilControlleur from "./detailOutilControlleur.js";

const reservationController = {
    async chargerTemplate() {
        const response = await fetch('templates/pages/reservations.hbs');
        if (!response.ok) {
            throw new Error('Impossible de charger le template réservation');
        }
        const html = await response.text();
        return Handlebars.compile(html);
    },
    async recupererDonnees() {
        try {
            if (!auth.isAuthenticated()) {
                router.goTo('/connexion');
                return { 
                    titre: 'Mes Réservations',
                    reservations: [],
                    erreur: 'Veuillez vous connecter pour voir vos réservations.'
                };
            }
            
            const idUser = auth.getUserId();
            // Appel API pour récupérer les réservations
            const response = await fetch(`http://localhost:6080/reservations/${idUser}`,  {
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
                throw new Error('Erreur lors de la récupération des réservations');
            }

            const reservations = await response.json();
            console.log(reservations);
            const reservationsMappes = reservations.map(item=>{
                const reservation = item.reservation;
                const dateDebut = new Date(reservation.date_debut);
                const dateFin = new Date(reservation.date_fin);
                const diffTime = dateFin - dateDebut;
                const nbJours = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                const outilsMappes = reservation.outils.map(outilItem => ({
                    id: outilItem.outil.id,
                    nom: outilItem.outil.nom,
                    description: outilItem.outil.desc,
                    image: `${outilItem.outil.image}`,
                    prix: parseFloat(outilItem.outil.tarif_journalier),
                    quantite: parseInt(outilItem.quantite),
                    prixQuantite: (parseFloat(outilItem.quantite) * parseFloat(outilItem.outil.tarif_journalier)) * nbJours
                }));
                return {
                    id: reservation.id,
                    date_debut: reservation.date_debut,
                    date_fin: reservation.date_fin,
                    statut: reservation.statut,
                    outils: outilsMappes,
                    totalReservation: outilsMappes.reduce((total, o) => total + o.prixQuantite, 0)
                }
            });
            return {
                titre: 'Mes Réservations',
                reservations: reservationsMappes,
            };

        } catch (error) {
            console.log(error);
            // Retourner des réservations vide en cas d'erreur
            return {
                titre: 'Mes Réservations',
                reservations: [],
                erreur: 'Impossible de charger l\'historique des réservations'
            };
        }
    },

    // événements de clic sur les cartes produits
    attacherEvenementsCartes() {
        const liensDetail = document.querySelectorAll('.res-produit-card');
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

    async afficher() {
        const app = document.getElementById('app');

        // Loader
        app.innerHTML = `
            <div class="loader-container">
                <div class="loader"></div>
                <p>Chargement des réservations...</p>
            </div>
        `;

        try {
            const template = await this.chargerTemplate();
            const donnees = await this.recupererDonnees();
            const html = template(donnees);
            app.innerHTML = html;
            this.attacherEvenementsCartes();

        } catch (error) {
            console.error('erreur affichage réservations:', error);
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
}
export default reservationController;