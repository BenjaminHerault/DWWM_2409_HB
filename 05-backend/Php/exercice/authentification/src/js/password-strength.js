const { createApp } = Vue;

createApp({
    data() {
        return {
            password: "",
            showMessage: true,
        };
    },
    mounted() {
        const alert = document.getElementById("message-alert");
        if (alert && alert.classList.contains("alert-success")) {
            setTimeout(() => {
                this.showMessage = false;
            }, 5000);
        }
    },
    computed: {
        strength() {
            // Calcule la force du mot de passe selon plusieurs critères
            let val = this.password;
            let strength = 0;
            if (val.length >= 8) strength++;
            if (/[A-Z]/.test(val)) strength++;
            if (/[0-9]/.test(val)) strength++;
            if (/[^A-Za-z0-9]/.test(val)) strength++;
            return strength;
        },
        barWidth() {
            //Largeur de la barre de progression (0%, 33%, 66%, 100%) selon la force.
            if (!this.password) return "0%";
            if (this.strength <= 1) return "33%";
            if (this.strength <= 3) return "66%";
            return "100%";
        },
        barClass() {
            // Couleur de la barre (rouge, orange, vert) selon la force.
            if (!this.password) return "";
            if (this.strength <= 1) return "password-weak";
            if (this.strength <= 3) return "password-medium";
            return "password-strong";
        },
        strengthText() {
            // Texte affiché sous la barre ("faible", "moyen", "fort").
            if (!this.password) return "";
            if (this.strength <= 1) return "Mot de passe faible";
            if (this.strength <= 3) return "Mot de passe moyen";
            return "Mot de passe fort";
        },
        textClass() {
            // Couleur du texte selon la force.
            if (!this.password) return "";
            if (this.strength <= 1) return "password-text-weak";
            if (this.strength <= 3) return "password-text-medium";
            return "password-text-strong";
        },
    },
}).mount("#app");
