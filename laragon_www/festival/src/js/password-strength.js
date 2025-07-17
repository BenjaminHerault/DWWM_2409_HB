const { createApp } = Vue;

// Fonctions utilitaires pour éviter la répétition
function getStrength(val) {
    let strength = 0;
    if (val.length >= 8) strength++;
    if (/[A-Z]/.test(val)) strength++;
    if (/[0-9]/.test(val)) strength++;
    if (/[^A-Za-z0-9]/.test(val)) strength++;
    return strength;
}
function getBarWidth(strength, val) {
    if (!val) return "0%";
    if (strength <= 1) return "33%";
    if (strength <= 3) return "66%";
    return "100%";
}
function getBarClass(strength, val) {
    if (!val) return "";
    if (strength <= 1) return "password-weak";
    if (strength <= 3) return "password-medium";
    return "password-strong";
}
function getStrengthText(strength, val) {
    if (!val) return "";
    if (strength <= 1) return "Mot de passe faible";
    if (strength <= 3) return "Mot de passe moyen";
    return "Mot de passe fort";
}
function getTextClass(strength, val) {
    if (!val) return "";
    if (strength <= 1) return "password-text-weak";
    if (strength <= 3) return "password-text-medium";
    return "password-text-strong";
}

createApp({
    data() {
        return {
            password: "",
            password_confirm: "",
            showPassword: false,
            showPasswordConfirm: false,
            showMessage: true,
        };
    },
    mounted() {
        const alert = document.getElementById("message-alert");
        if (alert) {
            setTimeout(() => {
                alert.style.display = "none";
            }, 5000);
        }
    },
    computed: {
        strength() {
            return getStrength(this.password);
        },
        barWidth() {
            return getBarWidth(this.strength, this.password);
        },
        barClass() {
            return getBarClass(this.strength, this.password);
        },
        strengthText() {
            return getStrengthText(this.strength, this.password);
        },
        textClass() {
            return getTextClass(this.strength, this.password);
        },
        confirmStrength() {
            return getStrength(this.password_confirm);
        },
        confirmBarWidth() {
            return getBarWidth(this.confirmStrength, this.password_confirm);
        },
        confirmBarClass() {
            return getBarClass(this.confirmStrength, this.password_confirm);
        },
        confirmStrengthText() {
            return getStrengthText(this.confirmStrength, this.password_confirm);
        },
        confirmTextClass() {
            return getTextClass(this.confirmStrength, this.password_confirm);
        },
    },
}).mount("#app");
