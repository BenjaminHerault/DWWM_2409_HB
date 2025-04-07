import { Cereales } from "./Cereales.js";

const monApp = {
    data() {
        return {
            listCereales: [],
        };
    },
    async created() {
        try {
            const url =
                "https://arfp.github.io/tp/web/javascript2/10-cereals/cereals.json";
            let response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Erreur HTTP : ${response.status}`);
            }
            // Convertir les données JSON en object JavaScript
            let json = await response.json();

            json.data.forEach((cereales) => {
                this.ajouterCereales(cereales);
            });
        } catch (error) {
            console.error("Erreur lors du chargement des données :", error);
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
            this.listCereales.push(monCereales);
        },
        supprimerCereales(id) {
            this.listCereales = this.listCereales.filter(
                (cereales) => cereales.id !== id
            );
        },
        trierCereales(key) {
            if (this.sortKey === key) {
                this.sortOrder = this.sortOrder === "asc" ? "desc" : "asc";
            } else {
                this.sortKey = key;
                this.sortOrder = "asc";
            }
            this.listCereales.sort((a, b) => {
                let result = 0;
                if (a[key] < b[key]) result = -1;
                if (a[key] > b[key]) result = 1;
            });
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
    },
};

const vm = Vue.createApp(monApp);
vm.mount("#app");
