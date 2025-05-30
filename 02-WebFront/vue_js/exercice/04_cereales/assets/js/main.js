import { Cereales } from "./Cereales.js";

const monApp = {
    data() {
        return {
            listCereales: [],
            listCerealesSaved: [],
            recherche_cerale: "",
            selectedNutriscores: [],
            selectedCategory: "tout",
        };
    },
    async created() {
        const sauvegarde = localStorage.getItem("tableauCereales");
        if (sauvegarde) {
            const confirmation = confirm(
                "Une sauvegarde a été trouvée. Voulez-vous la charger ?"
            );
            if (confirmation) {
                this.listCerealesSaved = JSON.parse(sauvegarde);
                alert("Tableau chargé depuis le navigateur !");
                return; /* Arrête l'exécution si les données sont chargées depuis la sauvegarde */
            }
        }

        // Si aucune sauvegarde ou si l'utilisateur refuse, téléchargez les données depuis l'API
        try {
            const url =
                "https://arfp.github.io/tp/web/javascript2/10-cereals/cereals.json";
            let response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Erreur HTTP : ${response.status}`);
            }
            let json = await response.json();
            json.data.forEach((cereales) => {
                this.ajouterCereales(cereales);
            });
            // alert("Données téléchargées depuis l'API !");
        } catch (error) {
            console.error("Erreur lors du chargement des données :", error);
            alert("Impossible de télécharger les données depuis l'API.");
        }
    },

    // creaction d'un nouveau élement dans le tableaux
    methods: {
        ajouterCereales(_cereales) {
            // Vérifie si une des propriétes contient la valeur -1
            const valeur = Object.values(_cereales);
            if (valeur.includes(-1)) {
                console.log("Ligne ignorée :", _cereales);
                return; // Ne pas ajouter si une valeur est -1
            }

            let monCereales = new Cereales(
                _cereales.id,
                _cereales.name,
                _cereales.calories,
                _cereales.protein,
                _cereales.sodium,
                _cereales.fiber,
                _cereales.carbo,
                _cereales.sugars,
                _cereales.potass,
                _cereales.vitamins,
                _cereales.rating
            );

            let monCerealesSaved = new Cereales(
                _cereales.id,
                _cereales.name,
                _cereales.calories,
                _cereales.protein,
                _cereales.sodium,
                _cereales.fiber,
                _cereales.carbo,
                _cereales.sugars,
                _cereales.potass,
                _cereales.vitamins,
                _cereales.rating
            );

            this.listCerealesSaved.push(monCerealesSaved);
            this.listCereales.push(monCereales);
        },
        supprimerCereales(id) {
            this.listCereales = this.listCereales.filter(
                (cereales) => cereales.id !== id
            );
        },
        trierCereales(key) {
            if (this.sortKey === key) {
                // Inverse l'ordre si on trie déjà par cette clé
                this.sortOrder = this.sortOrder === "asc" ? "desc" : "asc";
            } else {
                // Définit une nouvelle clé de tri
                this.sortKey = key;
                this.sortOrder = "asc"; // Par défaut, tri croissant
            }

            // Trie la liste des céréales
            this.listCereales.sort((a, b) => {
                let result = 0;

                // Compare les valeurs en fonction de la clé
                if (a[key] > b[key]) {
                    result = 1;
                } else if (a[key] < b[key]) {
                    result = -1;
                }

                // Inverse le résultat si l'ordre est décroissant
                return this.sortOrder === "asc" ? result : -result;
            });
        },
        afficherFlecheTri(key) {
            if (this.sortKey === key) {
                return this.sortOrder === "asc" ? "↑" : "↓";
            }
            return ""; // Pas de flèche si ce n'est pas la clé de tri active
        },
        calculerNutriScore(evaluation) {
            if (evaluation > 80) {
                return "A";
            } else if (evaluation > 70) {
                return "B";
            } else if (evaluation > 55) {
                return "C";
            } else if (evaluation > 35) {
                return "D";
            } else {
                return "E";
            }
        },
        sauvegarderTableau() {
            const donneesFiltrees = JSON.stringify(this.filtreRecherche); // Récupère les données filtrées
            console.log(donneesFiltrees);
            if (localStorage.getItem("tableauCereales")) {
                const confirmation = confirm(
                    "Une sauvegarde existe déjà. Voulez-vous la remplacer ?"
                );
                if (!confirmation) {
                    return;
                }
            }

            localStorage.setItem("tableauCereales", donneesFiltrees);
            console.log("Données sauvegardées :", this.filtreRecherche); // Vérifie les données sauvegardées
            alert("Tableau sauvegardé dans le navigateur !");
        },
        telechargerJSON() {
            // Convertit les données en JSON
            const dataStr = JSON.stringify(this.listCereales, null, 2);

            // Crée un objet Blob pour le téléchargement
            const blob = new Blob([dataStr], { type: "application/json" });
            const url = URL.createObjectURL(blob);

            // Crée un lien pour télécharger le fichier
            const a = document.createElement("a");
            a.href = url;
            a.download = "tableau_cereales.json";
            a.click();

            // Libère l'URL
            URL.revokeObjectURL(url);
        },
        chargerTableau() {
            const sauvegarde = localStorage.getItem("tableauCereales");

            console.table(sauvegarde);

            if (sauvegarde) {
                const confirmation = confirm(
                    "Une sauvegarde a été trouvée. Voulez-vous la charger ?"
                );
                if (confirmation) {
                    this.listCereales = JSON.parse(sauvegarde);
                    console.log("Données récupérées :", this.listCereales);
                    alert("Tableau chargé depuis le navigateur !");
                }
            }
        },
        reinitialiserDonnees() {
            const confirmation = confirm(
                "Voulez-vous réinitialiser les données ? Cela supprimera la sauvegarde existante."
            );
            if (confirmation) {
                localStorage.removeItem("tableauCereales");
                this.listCereales = [];
                this.created(); // Recharge les données depuis l'API
                alert("Données réinitialisées !");
            }
        },
    },

    computed: {
        totalCereales() {
            return this.listCereales.length;
        },
        moyenneCalories() {
            if (this.listCereales.length === 0) return 0;
            const total = this.listCereales.reduce(
                (sum, cereales) => sum + cereales.calories,
                0
            );
            return (total / this.listCereales.length).toFixed(2);
        },
        filtreRecherche() {
            return this.listCereales.filter((cereale) => {
                // Filtrer par recherche (nom du céréale)
                const correspondRecherche = cereale.name
                    .toLowerCase()
                    .includes(this.recherche_cerale.toLowerCase());

                // Filtrer par Nutri-score
                const correspondNutriscore =
                    this.selectedNutriscores.length === 0 ||
                    this.selectedNutriscores.includes(
                        this.calculerNutriScore(cereale.rating)
                    );

                // Filtrer par catégorie
                let correspondCategorie = true;
                if (this.selectedCategory === "Sans-sucre") {
                    correspondCategorie = cereale.sugars < 1;
                } else if (this.selectedCategory === "pauvre-en-sel") {
                    correspondCategorie = cereale.sodium < 50;
                } else if (this.selectedCategory === "boost") {
                    correspondCategorie =
                        cereale.vitamins >= 25 && cereale.fiber >= 10;
                }

                // Retourner true si tous les critères sont remplis

                return (
                    correspondRecherche &&
                    correspondNutriscore &&
                    correspondCategorie
                );
            });
        },
    },
};

const vm = Vue.createApp(monApp);
vm.mount("#app");
