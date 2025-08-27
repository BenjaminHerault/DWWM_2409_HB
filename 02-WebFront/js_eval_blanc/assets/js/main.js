import { Control_saisies } from "./Controler_saisies.js";

const monApp = {
    data() {
        return {
            nom: "Herault",
            prenom: "Benjamin",
            nomUtilisateur: "",
            motDePasse: "",
            motDePasseVerif: "",
            erreur: "",
        };
    },
    methods: {
        verifierFormulaire() {
            // Vérification nom et mot de passe
            try {
                new Control_saisies(
                    this.nomUtilisateur,
                    this.motDePasse,
                    this.motDePasseVerif
                );
            } catch (e) {
                this.erreur = e.message;
                setTimeout(() => {
                    this.erreur = "";
                }, 5000);
                return;
            }
            // Si tout est OK
            this.erreur = "Le formulaire est valide !";
            document.body.style.backgroundColor = "#006400";
            document.querySelector("fieldset.form").style.backgroundColor =
                "#338333";
            document.querySelectorAll("input.couleurs").forEach((input) => {
                input.style.backgroundColor = "#5c9c5c";
            });
            document.querySelectorAll("button.couleurs").forEach((input) => {
                input.style.backgroundColor = "#5c9c5c";
            });
            this.userNew = {
                username: this.nomUtilisateur,
                password: this.motDePasse,
            };
            this.affichageUser = `Nom d'utilisateur : ${this.userNew.username} | Mot de passe : ${this.userNew.password}`;
            setTimeout(() => {
                this.erreur = "";
            }, 5000);
        },
    },
};

const vm = Vue.createApp(monApp);
vm.mount("#app");
