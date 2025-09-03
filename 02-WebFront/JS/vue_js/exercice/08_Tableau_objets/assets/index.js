/*
  Fichier : assets/index.js
  Rôle : point d'entrée de l'application Vue (sans build tool), utilise l'API globale Vue
  Ce fichier initialise l'application, charge les utilisateurs via UsersService,
  gère l'authentification simple (login/logout) et affiche des notifications.
*/

// Utiliser l'API Vue globale fournie par le CDN (vue.global.js)
// Ici on récupère le helper principal dont on a besoin : createApp pour monter l'app.
const { createApp } = Vue;

// Import du service qui encapsule la logique métier liée aux utilisateurs
// (chargement, formatage, authentification, etc.). Ce fichier est dans le même
// dossier et expose une classe UsersService.
import { UsersService } from "./users-service.js";

// Création de l'application Vue en mode Options API (pour correspondre à ton usage)
createApp({
    // data contient l'état réactif exposé au template
    data() {
        return {
            // valeurs en français (plus explicites pour toi)
            utilisateurs: [],
            identifiant: "",
            motDePasse: "",
            utilisateurCourant: null,
            messageNotification: "",
            notificationVisible: false,
            // temporisateur pour la notification (non réactif / valeur simple)
            temporisateurNotification: null,
            // instance du service stockée sur l'objet (sera initialisée dans created)
            serviceUtilisateurs: null,
        };
    },

    // created est appelé avant mounted : on peut initialiser des objets non réactifs
    created() {
        // créer l'instance du service ici
        this.serviceUtilisateurs = new UsersService();
    },

    // mounted : charger les utilisateurs depuis le service
    async mounted() {
        const charges = await this.serviceUtilisateurs.loadUsers();
        this.utilisateurs = charges;
    },

    // méthodes accessibles depuis le template
    methods: {
        // Affiche une notification pendant 5s
        afficherNotification(msg) {
            clearTimeout(this.temporisateurNotification);
            this.messageNotification = msg;
            this.notificationVisible = true;
            this.temporisateurNotification = setTimeout(() => {
                this.notificationVisible = false;
            }, 5000);
        },

        // Tentative de connexion (authentification)
        connexion() {
            if (!this.identifiant || !this.motDePasse) {
                this.afficherNotification(
                    "Veuillez renseigner l'identifiant et le mot de passe."
                );
                return;
            }

            const utilisateur = this.serviceUtilisateurs.authenticate(
                this.identifiant,
                this.motDePasse
            );

            if (!utilisateur) {
                this.afficherNotification(
                    "Identifiant ou mot de passe incorrect."
                );
                return;
            }

            this.utilisateurCourant = utilisateur;
            this.identifiant = "";
            this.motDePasse = "";
        },

        // Déconnexion
        deconnexion() {
            this.utilisateurCourant = null;
        },

        // Wrappers / helpers pour le template (noms français)
        formatDateFR(iso) {
            return this.serviceUtilisateurs.formatDate(iso);
        },

        formatSalaire(n) {
            return this.serviceUtilisateurs.formatSalary(n);
        },

        genererEmail(u) {
            return this.serviceUtilisateurs.generateEmail(u);
        },

        // (aliases anglais supprimés — tout est en français maintenant)
    },

    // computed: supprimé — on n'expose plus d'aliases anglais, tout est en français
}).mount("#app");
