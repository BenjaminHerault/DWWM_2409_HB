import { InfoPopulation } from "./InfoPopulation.js";

const monApp = {
    data() {
        return {
            listPopulation: [],
        };
    },
    async created() {
        try {
            const url =
                "https://arfp.github.io/tp/web/javascript2/40-population/fr_population.json";

            let response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Erreur HTTP : ${response.status}`);
            }
            // Convertir les données JSON en objet JavaScript
            let json = await response.json();

            console.log("Données récupérées :", json); // Vérifie les données récupérées

            json.data.forEach((population) => {
                this.ajouterPopulation(population);
            });
        } catch (error) {
            console.error("Erreur lors du chargement des données :", error);
        }
    },
    methods: {
        ajouterPopulation(_LaPopulation) {
            let maPopulation = new InfoPopulation(
                _LaPopulation.annee,
                _LaPopulation.population,
                _LaPopulation.naissances
            );
            this.listPopulation.push(maPopulation);
            console.log("Population ajoutée :", maPopulation); // Vérifie les données ajoutées
        },
    },
};
const vm = Vue.createApp(monApp);
vm.mount("#app");

const ctx = document.getElementById("myChart");

new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["1950", "1960", "Yellow", "Green", "Purple", "Orange"],
        datasets: [
            {
                label: "# of Votes",
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1,
            },
        ],
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});
