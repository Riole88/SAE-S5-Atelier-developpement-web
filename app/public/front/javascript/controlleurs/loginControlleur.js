import auth from '../services/auth.js';
import router from '../routeur.js';
const loginController = {

    async chargerTemplate() {
        const response = await fetch('templates/pages/login.hbs');
        const html = await response.text();
        return Handlebars.compile(html);
    },
    ajouterEvenements() {
        // Boutons submit
        const formSubmit = document.querySelector('#connexion-form');
        if (formSubmit) {
            formSubmit.addEventListener("submit", (event) => {
                document.getElementById("after-submit").innerText = "Veuillez patienter";
                event.preventDefault();
                this.login(formSubmit)
            });
        }

        const registerLink = document.querySelector('#lien-register');
        if (registerLink) {
            registerLink.addEventListener('click', (event) => {
                event.preventDefault();
                router.goTo('/register');
            });
        }
    },

    async login(formSubmit){
        try{
            const data = Object.fromEntries(new FormData(formSubmit).entries());
            const response = await fetch('http://localhost:6080/login', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
                mode: 'cors',
            });

            let userData = await response.json();

            auth.setAuth(userData.payload, userData.profile);

            router.goTo('/catalogue');

        } catch(e){
            document.getElementById("after-submit").innerText = "Email ou mot de passe incorrect";
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

export default loginController;