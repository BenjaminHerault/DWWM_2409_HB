import { InfoPopulation } from "./InfoPopulation.js";

const monApp = {
    data() {
        return {
            listPopulation: [], // Liste des données de population
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

            json.forEach((population) => {
                this.ajouterPopulation(population);
            });

            // Une fois les données chargées, afficher le graphique
            this.afficherGraphique();
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
        },
        afficherGraphique() {
            console.log("Données de population :", this.listPopulation);

            const ctx = document.getElementById("myChart");

            // Préparer les données pour le graphique
            const labels = this.listPopulation.map((pop) => pop.annee); // Années
            const data = this.listPopulation.map((pop) => pop.population); // Populations

            console.log("Labels :", labels);
            console.log("Données :", data);

            // Créer le graphique
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels, // Années comme labels
                    datasets: [
                        {
                            label: "Population Française",
                            data: data, // Données de population
                            backgroundColor: "rgba(75, 192, 192, 0.2)", // Couleur des barres
                            borderColor: "rgba(75, 192, 192, 1)", // Couleur des bordures
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
        },
    },
};

const vm = Vue.createApp(monApp);
vm.mount("#app");

// new Chart(ctx, {
//     type: "bar",
//     data: {
//         labels: ["1950", "1960", "Yellow", "Green", "Purple", "Orange"],
//         datasets: [
//             {
//                 label: "# of Votes",
//                 data: [12, 19, 3, 5, 2, 3],
//                 borderWidth: 1,
//             },
//         ],
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true,
//             },
//         },
//     },
// });
