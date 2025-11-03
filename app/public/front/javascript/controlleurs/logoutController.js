import auth from '../services/auth.js';
import router from '../routeur.js';
const logoutController = {
    ajouterEvenements() {
        const logout = document.querySelector('#deconnexion');
        logout.addEventListener("click", (event) => {
            auth.clearAuth();
            document.getElementById("header-login").style.display = "list-item";
            document.getElementById("header-logout").style.display = "none";
            document.getElementById("statut-connexion").textContent = "Invité";
            document.getElementById("espace-compte").style.display = "none";
            router.goTo("/catalogue");
        });
    },

    async afficher() {
        const app = document.getElementById('app');

        // Loader avec animation
        app.innerHTML = `
            <div class="loader-container">
                <div class="loader"></div>
            </div>
        `;

        try {
            this.ajouterEvenements();
        } catch (error) {
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

export default logoutController;