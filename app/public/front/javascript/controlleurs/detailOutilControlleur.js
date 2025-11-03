import auth from "../services/auth.js";
import router from "../routeur.js";

const detailOutilControlleur = {

    async chargerTemplate() {
        const response = await fetch('templates/pages/detailOutil.hbs');
        if (!response.ok) {
            throw new Error('Impossible de charger le template detailOutil');
        }
        const html = await response.text();
        return Handlebars.compile(html);
    },

    async recupererDonnees(id_outil) {
        try {
            const response = await fetch(`http://localhost:6080/outils/${id_outil}`);

            const outil = await response.json();

            return {
                id: outil.id,
                nom: outil.nom,
                description: outil.desc,
                image: `${outil.image}`,
                prix: parseFloat(outil.tarif_journalier),
                stock: parseInt(outil.quantite_stock),
                disponible: parseInt(outil.quantite_stock) > 0
            };

        } catch (error) {
            console.error('Erreur pendant la récupération des données:', error);
        }
    },

    ajouterEvenements() {
        const form = document.getElementById('form-outil');
        form.addEventListener('submit', (e) => {   // ← fonction fléchée
            e.preventDefault();
            const date_debut = document.getElementById('date_debut').value;
            const date_fin = document.getElementById('date_fin').value;
            const quantite = document.getElementById('quantite').value;
            const id_outil = document.getElementById('submit-outil').dataset.outilId;
            this.ajouterAuPanier(id_outil, quantite, date_debut, date_fin);
        });
    },

    async ajouterAuPanier(id_outil, quantite, date_debut, date_fin) {
        try {
            if(!auth.isAuthenticated()) {
                router.goTo("/connexion");
            }
            const id_user = auth.getUserId();
            console.log(id_user);
            //const response = await fetch(`http://docketu.iutnc.univ-lorraine.fr:56197/outils/${id_outil}/reserver`, {
            const response = await fetch(`http://localhost:6080/outils/${id_outil}/reserver`, {
                method: 'POST',
                headers: auth.getAuthHeaders(),
                body: JSON.stringify({
                    id_user: id_user,
                    quantite: quantite,
                    date_debut: date_debut,
                    date_fin: date_fin
                }),
                mode: 'cors',
            });
            if (!response.ok) {
                if (response.status === 401) {
                    auth.clearAuth();
                    router.goTo('/connexion');
                    throw new Error('Session expirée');
                }
                throw new Error('Erreur lors de l\'ajout de l\'article au panier.');
            }

            // Si tout va bien
            console.log("✅ Produit ajouté au panier");
            alert("✅ L’outil a bien été ajouté au panier !");

        } catch (error) {
            console.error("❌ Erreur réseau ou inattendue :", error);
            alert("❌ Échec de l’ajout au panier : " + error.message);
        }
    },

    async afficher(id_outil) {
        const app = document.getElementById('app');

        // Loader avec animation
        app.innerHTML = `
            <div class="loader-container">
                <div class="loader"></div>
                <p>Chargement de l'outil...</p>
            </div>
        `;

        try {
            const template = await this.chargerTemplate();
            const donnees = await this.recupererDonnees(id_outil);

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

export default detailOutilControlleur;