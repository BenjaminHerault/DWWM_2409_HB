// main.js : Vue.js pour la recherche de villes par code postal
const { createApp } = Vue;

createApp({
    data() {
        return {
            recherche: "", // Ce que tape l'utilisateur
            villes: [], // Toutes les villes chargées depuis zipcodes.json
            suggestions: [], // Suggestions filtrées
            villeSelectionnee: null, // Ville choisie pour affichage
        };
    },
    computed: {
        // Renvoie un objet avec les infos à afficher dynamiquement
        infosVille() {
            if (!this.villeSelectionnee) return {};
            return {
                "Code commune": this.villeSelectionnee.codeCommune,
                "Libellé acheminement":
                    this.villeSelectionnee.libelleAcheminement,
            };
        },
    },
    methods: {
        // Met à jour la liste des suggestions selon la recherche
        mettreAJourSuggestions() {
            const recherche = this.recherche.trim();
            if (recherche.length < 2) {
                this.suggestions = [];
                return;
            }
            this.suggestions = this.villes.filter((ville) =>
                ville.codePostal.includes(recherche)
            );
        },
        // Quand on valide le formulaire
        validerVille() {
            // On cherche la ville exacte (code postal + nom)
            const valeur = this.recherche;
            // On accepte "codePostal - nomCommune" ou juste codePostal
            let ville = this.villes.find(
                (v) =>
                    valeur === v.codePostal + " - " + v.nomCommune ||
                    valeur === v.codePostal
            );
            if (!ville && this.suggestions.length === 1) {
                ville = this.suggestions[0];
            }
            this.villeSelectionnee = ville || null;
        },
    },
    mounted() {
        // Chargement des villes depuis le fichier zipcodes.json
        fetch("./data/zipcodes.json")
            .then((response) => response.json())
            .then((data) => {
                this.villes = data;
            });
    },
}).mount("#app");

// Explications :
// - On utilise Vue.js pour gérer l'état et les interactions.
// - Les suggestions sont filtrées à chaque saisie (méthode mettreAJourSuggestions).
// - Le bouton Valider affiche les infos de la ville sélectionnée.
// - Les données sont chargées dynamiquement avec fetch.
