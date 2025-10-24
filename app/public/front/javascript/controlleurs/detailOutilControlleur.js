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
            const response = await fetch(`http://docketu.iutnc.univ-lorraine.fr:56197/outils/${id_outil}`);

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

            //this.ajouterEvenements();

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