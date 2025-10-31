import router from './routeur.js';
import catalogueController from './controlleurs/catalogueControlleur.js';
import panierController from "./controlleurs/panierControlleur.js";
import compteController from "./controlleurs/compteControlleur.js";
import loginController from "./controlleurs/loginControlleur.js";
import registerControlleur from "./controlleurs/registerControlleur.js";
import reservationController from "./controlleurs/ReservationControlleur.js";

async function chargerComposants() {
    const composants = ['header', 'footer'];

    //Charger chaque composants
    for (const nom of composants) {
        const response = await fetch(`templates/composants/${nom}.hbs`);
        if (!response.ok) {
            throw new Error(`Impossible de charger le composant ${nom}`);
        }
        const html = await response.text();
        Handlebars.registerPartial(nom, html);
    }
}

async function demarrer() {
    try {
        await chargerComposants();

        // Définir les routes
        router.add('/', catalogueController);
        router.add('/catalogue', catalogueController);
        router.add('/panier', panierController);
        router.add('/compte', compteController);
        router.add('/connexion',loginController);
        router.add('/register', registerControlleur);
        router.add('/reservations',reservationController);

        // Démarrer le router
        router.init();

    } catch (error) {
        console.error(error);
        document.getElementById('app').innerHTML =
            '<div class="error">Erreur : La page n\' a pas pu se charger.</div>';
    }
}

document.addEventListener('DOMContentLoaded', demarrer);
