import auth from '../services/auth.js';
import router from '../routeur.js';
const registerController = {

    async chargerTemplate() {
        const response = await fetch('templates/pages/register.hbs');
        const html = await response.text();
        return Handlebars.compile(html);
    },
    ajouterEvenements() {
        // Boutons submit
        const formSubmit = document.querySelector('#register-form');
        if (formSubmit) {
            formSubmit.addEventListener("submit", (event) => {
                event.preventDefault();
                this.register(formSubmit)
            });
        }
    },

    async register(formSubmit){
        try{
            const data = Object.fromEntries(new FormData(formSubmit).entries());
            const response = await fetch('http://localhost:6080/register', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
                mode: 'cors',
            });

            const res = await response.json();

            if (!res.success) {
                throw new Error("Erreur lors de l'inscription");
            }

            router.goTo('/connexion');
        } catch(e){
            console.error(e);
        }
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
            const template = await this.chargerTemplate();

            const html = template();
            app.innerHTML = html;

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

export default registerController;