import router from './routeur.js';
import catalogueController from './controlleurs/catalogueControlleur.js';
import panierController from "./controlleurs/panierControlleur.js";
import compteController from "./controlleurs/compteControlleur.js";
import detailOutilController from "./controlleurs/detailOutilControlleur.js";
import loginController from "./controlleurs/loginControlleur.js";

async function chargerComposants() {
    const composants = ['header', 'footer'];

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
        router.add('/', () => catalogueController.afficher());
        router.add('#/catalogue', () => catalogueController.afficher());
        router.add('#/detailOutil', () => detailOutilController.afficher());
        router.add('#/panier', () => panierController.afficher());
        router.add('#/compte', () => compteController.afficher());
        router.add('#/login', () => loginController.afficher());

        // Démarrer le router
        router.init();

    } catch (error) {
        console.error(error);
        document.getElementById('app').innerHTML =
            '<div class="error">Erreur de chargement. Rechargez la page.</div>';
    }
}

document.addEventListener('DOMContentLoaded', demarrer);
