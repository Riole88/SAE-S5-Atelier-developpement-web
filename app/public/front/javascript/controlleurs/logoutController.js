import auth from '../services/auth.js';
import router from '../routeur.js';

const logoutController = {
    async afficher() {
        // Simply clear auth and redirect - no need for DOM manipulation
        auth.clearAuth();
        router.goTo("/connexion");
    }
};

export default logoutController;