import router from './routeur.js';
import catalogueController from './controlleurs/catalogueControlleur.js';

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
        console.log("Composants chargés ✅");

        // Définir les routes
        router.add('/', () => catalogueController.afficher());
        router.add('/catalogue', () => catalogueController.afficher());
        console.log("Routes définies ✅");

        // Démarrer le router
        router.init();

    } catch (error) {
        console.error(error);
        document.getElementById('app').innerHTML =
            '<div class="error">Erreur de chargement. Rechargez la page.</div>';
    }
}

document.addEventListener('DOMContentLoaded', demarrer);
