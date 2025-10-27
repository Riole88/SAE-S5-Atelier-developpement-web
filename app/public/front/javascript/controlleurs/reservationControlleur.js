

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
            //
            const idUser = localStorage.getItem("id_user");
            // Appel API pour récupérer les réservations
            //const response = await fetch(`http://localhost:6080/reservations/${idUser}`);
            const response = await fetch(`http://localhost:6080/reservations/b12c59b7-9d2d-4e7c-9f84-cb39f9a1322f`);
            if (!response.ok) {
                throw new Error('Erreur lors de la récupération des réservations');
            }

            const reservations = await response.json();
            const reservationsMappes = reservations.map(item=>{
                const reservation = item.reservation;
                const outilsMappes = reservation.outils.map(outilItem => ({
                    id: outilItem.outil.id,
                    nom: outilItem.outil.nom,
                    description: outilItem.outil.desc,
                    image: `${outilItem.outil.image}`,
                    prix: parseFloat(outilItem.outil.tarif_journalier),
                    quantite: parseInt(outilItem.quantite),
                    prixQuantite: (parseFloat(outilItem.quantite) * parseFloat(outilItem.outil.tarif_journalier))
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
            console.log(reservationsMappes);


            console.log('Réservations récupérées:', reservations);


            return {
                titre: 'Mes Reservations',
                reservations: reservationsMappes,
            };

        } catch (error) {
            // Retourner des réservations vide en cas d'erreur
            return {
                titre: 'Mes Reservations',
                reservations: [],
                erreur: 'Impossible de charger l\'historique des réservations'
            };
        }
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

            //this.ajouterEvenements();

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